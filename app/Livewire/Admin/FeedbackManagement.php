<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Feedback;
use Masmerise\Toaster\Toaster;

class FeedbackManagement extends Component
{
    public $repairs_ID;
    public $submitted_by;
    public $feedback_content;
    public $rate;

    public $editing = true;
    public $editingId;
    public $showModal = false;

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate([
            'repairs_ID' => 'required|exists:repairs,repair_ID',
            'submitted_by' => 'required|exists:users,id',
            'feedback_content' => 'nullable|string|max:500',
            'rate' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'repairs_ID' => $this->repairs_ID,
            'submitted_by' => $this->submitted_by,
            'feedback_content' => $this->feedback_content,
            'rate' => $this->rate,
        ]);

        $this->reset('repairs_ID', 'submitted_by', 'feedback_content', 'rate');
        Toaster::success('Feedback submitted!');
        $this->closeModal();
    }


        public function delete($id)
        {
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();

            Toaster::success('Feedback deleted successfully!');
        }

    public function render()
    {
        $feedbacks = Feedback::orderBy('feedback_ID', 'desc')->get();
        return view('livewire.admin.menu.feedback.feedback-management', compact('feedbacks'));
    }
}
