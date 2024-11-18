<?php

namespace Kv\MyCrm\Http\Livewire;

use Livewire\Component;

class NotifyToast extends Component
{
    public $level = 'success';
    public $message;

    public function render()
    {
        return view('my-crm::livewire.notify-toast');
    }
}
