<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Backup extends Component
{
    public function render()
    {
        return view('livewire.backups.view');
    }

    public function back()
    {
        $exit  = \Artisan::call('backup:run --only-db --disable-notifications');
		
		dd( \Artisan::output());
        
    }
}
