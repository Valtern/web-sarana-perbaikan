<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportSummaryExport;
use App\Models\Report;

class ReportManagement extends Component
{
    public $searchTerm = '';
    public $startDate;
    public $endDate;
    public $reports;
    public $statusUpdates = [];
    public $summary = [];
    public $categoryScores = [];
public $mostDamagedCategory;
public $leastDamagedCategory;



public function render()
{
    $query = DB::table('report')
        ->join('users', 'report.user_ID', '=', 'users.id')
        ->select('report.*', 'users.name as reporter_name');

    if ($this->searchTerm) {
        $query->where('users.name', 'like', '%' . $this->searchTerm . '%');
    }

    if ($this->startDate && $this->endDate) {
        $query->whereBetween('report.created_at', [$this->startDate, $this->endDate]);
    }

    $this->reports = $query->orderBy('report.created_at', 'desc')->get();

    // Update status dropdowns
    foreach ($this->reports as $report) {
        $this->statusUpdates[$report->report_ID] = $report->status;
    }

    // Generate summary for the modal
    $this->summary = $this->generateSummary();

    // Get category scores
    $this->categoryScores = DB::table('report')
    ->select('category', DB::raw('COUNT(*) as score'))
    ->groupBy('category')
        ->pluck('score', 'category')
        ->toArray();

    // Get least damaged
    $this->leastDamagedCategory = collect($this->categoryScores)->sort()->keys()->first() ?? 'N/A';

    return view('livewire.admin.Menu.report.report-management', [
        'reports' => $this->reports,
        'summary' => $this->summary,
        'categoryScores' => $this->categoryScores,
        'leastDamagedCategory' => $this->leastDamagedCategory
    ]);
}


public function updateStatus($reportId)
{
    if (isset($this->statusUpdates[$reportId])) {
        DB::table('report')
            ->where('report_ID', $reportId)
            ->update(['status' => $this->statusUpdates[$reportId]]);

        session()->flash('message', "Status updated successfully for report ID: $reportId");
    }
}

public function updateStatusWithValue($reportId, $status)
{
    $this->statusUpdates[$reportId] = $status;
    $this->updateStatus($reportId);
}



public function deleteReport($reportId)
{
    DB::table('report')->where('report_ID', $reportId)->delete();
}

public function mount()
{

    $this->summary = $this->generateSummary();
    $this->categoryScores = DB::table('report')
    ->select('category', DB::raw('COUNT(*) as score'))
    ->groupBy('category')
    ->pluck('score', 'category')
    ->toArray();

$this->mostDamagedCategory = collect($this->categoryScores)->sortDesc()->keys()->first();
$this->leastDamagedCategory = collect($this->categoryScores)->sort()->keys()->first();


}


public function generateSummary(): array
{
    $totalReports = DB::table('report')->count();


    $incomingReports = DB::table('report')
        ->whereDate('created_at', today())
        ->count();

$mostFrequentReporter = DB::table('report')
    ->join('users', 'report.user_ID', '=', 'users.id')
    ->select('users.name', DB::raw('COUNT(*) as count'))
    ->groupBy('users.name')
    ->orderByDesc('count')
    ->first(); //  returns object with ->name

$mostDamagedCategory = DB::table('report')
    ->select('category', DB::raw('COUNT(*) as count'))
    ->groupBy('category')
    ->orderByDesc('count')
    ->first(); //  returns object with ->category


return [
    'total_reports' => $totalReports,
    'incoming_reports' => $incomingReports,
    'most_frequent_reporter' => $mostFrequentReporter,
    'most_damaged_category' => $mostDamagedCategory,
];

}

public function exportSummary()
{
    $summaryData = [
        ['Metric', 'Value'],
        ['Total Reports', $this->summary['total_reports']],
        ['Incoming Today', $this->summary['incoming_reports']],
        ['Most Frequent Reporter', $this->summary['most_frequent_reporter']->name ?? 'N/A'],
        ['Most Damaged Category', $this->summary['most_damaged_category']->category ?? 'N/A'],
        ['Least Damaged Category', $this->leastDamagedCategory],
    ];

    $damageScores = collect($this->categoryScores)->sortDesc()->map(function ($score, $category) {
        return [$category, $score];
    })->values()->toArray();

}

public function loadDamageSummary()
{
    $priorityWeights = [
        'Very High' => 4,
        'High' => 3,
        'Medium' => 2,
        'Low' => 1,
    ];

    $reports = Report::all();
    $scores = [];

    foreach ($reports as $report) {
        $category = $report->category;
        $priority = $report->priority_Assignment;
        $weight = $priorityWeights[$priority] ?? 0;

        if (!isset($scores[$category])) {
            $scores[$category] = 0;
        }

        $scores[$category] += $weight;
    }

    $this->categoryScores = $scores;

    arsort($scores);
    $this->mostDamagedCategory = array_key_first($scores);

    asort($scores);
    $this->leastDamagedCategory = array_key_first($scores);
}

}