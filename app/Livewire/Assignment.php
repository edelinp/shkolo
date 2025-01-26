<?php

namespace App\Livewire;

use App\Models\DashboardButton;
use Livewire\Component;

class Assignment extends Component
{
    public $buttons;

    public function mount()
    {
        $this->buttons = DashboardButton::all();
    }

    public function clearButton($id)
    {
        $button = DashboardButton::find($id);

        if ($button) {
            // Clear the button's data
            $button->update([
                'title' => null,
                'hyperlink' => null,
                'color' => null,
            ]);
        }

        // Refresh the buttons list
        $this->buttons = DashboardButton::all();
    }
    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.guest');
    }
}
