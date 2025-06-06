<?php

namespace App\Livewire\Staff;

use App\Models\Repair;
use Livewire\Component;
use App\Models\Feedback;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Auth;

class FeedbackList extends Component
{
    public $repairs_ID;
    public $feedback_content;
    public $rate;

    protected $rules = [
        'repairs_ID' => 'required|exists:repairs,repair_ID',
        'feedback_content' => 'nullable|string|max:500',
        'rate' => 'required|integer|min:1|max:5',
    ];

    public function submit()
    {
        $this->validate();

        Feedback::create([
            'repairs_ID' => $this->repairs_ID,
            'submitted_by' => Auth::id(),
            'feedback_content' => $this->feedback_content,
            'rate' => $this->rate,
        ]);

        Toaster::success('Feedback Sended !');
        $this->reset(['repairs_ID', 'feedback_content', 'rate']);
    }

        public function render()
    {
        $repairOptions = Repair::select('repair_ID')->get(); // atau tambah kolom lain jika ingin ditampilkan lebih jelas

        return view('livewire.staff.menu.staff-feedback-list', [
            'repairOptions' => $repairOptions,
        ]);
    }
}
