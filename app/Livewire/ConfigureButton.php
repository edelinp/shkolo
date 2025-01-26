<?php

namespace App\Livewire;

use App\Models\DashboardButton;
use Livewire\Component;

class ConfigureButton extends Component
{
    public $button;
    public $title;
    public $hyperlink;
    public $color;

    public function mount($id)
    {
        $this->button = DashboardButton::findOrFail($id);
        $this->title = $this->button->title;
        $this->hyperlink = $this->button->hyperlink;
        $this->color = $this->button->color;
    }

    public function save()
    {
        $this->button->update([
            'title' => $this->title,
            'hyperlink' => $this->hyperlink,
            'color' => $this->color,
        ]);

        return redirect()->route('assignment');
    }

    public function render()
    {
        return view('livewire.configure-button')
            ->layout('layouts.guest');
    }
}
