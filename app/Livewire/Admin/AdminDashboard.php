<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Repair;
use App\Models\Report;
use Livewire\Component;
use App\Models\Building;
use App\Models\Facility;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Component
{
    public $totalBuildings;
    public $totalReports;
    public $totalUsers;
    public $totalFacilities;
    public $totalFeedbacks;
    public $totalRepairs;
    public $ratingAvg;
    public $categories;
    public $feedbackCount;

    public function mount()
    {
       $data = DB::table('report')
        ->leftJoin('feedback', 'report.report_ID', '=', 'feedback.repairs_ID')
        ->select(
            'report.category',
            DB::raw('AVG(feedback.rate) as avg_rating'),
            DB::raw('COUNT(feedback.feedback_ID) as total_feedback')
        )
        ->groupBy('report.category')
        ->get();

        $this->categories = $data->pluck('category');
        $this->ratingAvg = $data->pluck('avg_rating');
        $this->feedbackCount = $data->pluck('total_feedback');

        $this->totalBuildings = Building::count();
        $this->totalReports = Report::count();
        $this->totalUsers = User::count();
        $this->totalFacilities = Facility::count();
        $this->totalFeedbacks = Feedback::count();
        $this->totalRepairs = Repair::count();

    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}

