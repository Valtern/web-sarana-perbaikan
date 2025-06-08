<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Report;

class ReportManagement extends Component
{
    public $searchTerm = '';
    public $startDate;
    public $endDate;
    public $reports;
    public $statusUpdates = [];
    public $categoryScores = [];
    public $mostDamagedCategory;
    public $leastDamagedCategory;
    public $selectedReport;

    // We no longer need $showDeleteModal
    // public $showDeleteModal = false;
    public $reportIdToDelete;
    public $deleteMessage;

    public function mount()
    {
        $this->loadReports();

        $this->categoryScores = DB::table('report')
            ->select('category', DB::raw('COUNT(*) as score'))
            ->groupBy('category')
            ->pluck('score', 'category')
            ->toArray();

        $this->mostDamagedCategory = collect($this->categoryScores)->sortDesc()->keys()->first() ?? 'N/A';
        $this->leastDamagedCategory = collect($this->categoryScores)->sort()->keys()->first() ?? 'N/A';
    }

    public function updatedSearchTerm()
    {
        $this->loadReports();
    }

    public function updatedStartDate()
    {
        $this->loadReports();
    }

    public function updatedEndDate()
    {
        $this->loadReports();
    }

    public function loadReports()
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

        foreach ($this->reports as $report) {
            $this->statusUpdates[$report->report_ID] = $report->status;
        }
    }

    public function render()
    {
        return view('livewire.admin.Menu.report.report-management', [
            'reports' => $this->reports,
            'categoryScores' => $this->categoryScores,
            'leastDamagedCategory' => $this->leastDamagedCategory
        ]);
    }

    public function viewReport($reportId)
    {
        $this->selectedReport = $this->reports->firstWhere('report_ID', $reportId);
    }

    public function updateStatusWithValue($reportId, $status)
    {
        $currentStatus = DB::table('report')->where('report_ID', $reportId)->value('status');
        if ($currentStatus !== $status) {
            DB::table('report')->where('report_ID', $reportId)->update(['status' => $status]);
            session()->flash('message', "Status updated for report ID: $reportId");
        }
    }

    public function confirmDelete($reportId)
    {
        $this->reportIdToDelete = $reportId;
        $report = Report::find($reportId);

        $hasFeedback = $report->repairs()->whereHas('feedback')->exists();

        if ($hasFeedback) {
            $this->deleteMessage = 'This report has associated feedback. Deleting the report will also delete all related repairs and feedback. Are you sure?';
        } else {
            $this->deleteMessage = 'Are you sure you want to delete this report?';
        }

        // We no longer need to manually manage the modal's visibility
        // $this->showDeleteModal = true;
    }

 public function destroyReport()
{
    $report = Report::find($this->reportIdToDelete);
    if ($report) {
        $report->delete();
        session()->flash('message', 'Report deleted successfully.');
    }

    // This line is correct. It sends an event to the browser.
    $this->dispatch('close-delete-modal');

    // This line is correct. It refreshes the data.
    $this->loadReports();
}

    public function cancelDelete()
    {
        // Simply reset the ID to delete. The modal is closed by Preline's data attributes.
        $this->reportIdToDelete = null;
    }
}
