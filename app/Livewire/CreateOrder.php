<?php

namespace App\Livewire;

use Livewire\Component;

class CreateOrder extends Component
{
    public $title = '';

    public function save()
    {
        dd('saved', $this->title);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
