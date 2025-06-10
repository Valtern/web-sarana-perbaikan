<?php

namespace App\Livewire\Lecturer;

use App\Models\Repair;
use App\Models\Feedback;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LecturerFeedbackList extends Component
{
    public $repairs_ID;
    public $feedback_content;
    public $rate;

    protected function rules()
    {
        return [
            'repairs_ID' => [
                'required',
                Rule::exists('repairs', 'repair_ID')->where(function ($query) {
                    $query->where('repair_status', 'Completed');
                }),
            ],
            'feedback_content' => 'nullable|string|max:500',
            'rate' => 'required|integer|min:1|max:5',
        ];
    }

    public function submit()
    {
        $this->validate();

        $userId = Auth::id();
        $repair = Repair::where('repair_ID', $this->repairs_ID)
                        ->where('repair_status', 'Completed')
                        ->whereHas('report', function ($query) use ($userId) {
                            $query->where('user_ID', $userId);
                        })->first();

        if (!$repair) {
            Toaster::error('You can only give feedback to completed repairs.');
            return;
        }

        Feedback::create([
            'repairs_ID' => $this->repairs_ID,
            'submitted_by' => $userId,
            'feedback_content' => $this->feedback_content,
            'rate' => $this->rate,
        ]);

        Toaster::success('Feedback Sent!');
        $this->reset(['repairs_ID', 'feedback_content', 'rate']);
    }

    public function render()
    {
        $userId = Auth::id();

        $repairOptions = Repair::where('repair_status', 'Completed')
            ->whereHas('report', function ($query) use ($userId) {
                $query->where('user_ID', $userId);
            })
            ->whereDoesntHave('feedback')
            ->select('repair_ID')
            ->get();

        return view('livewire.lecturer.menu.lecturer-feedback-list', [
            'repairOptions' => $repairOptions,
        ]);
    }
}
