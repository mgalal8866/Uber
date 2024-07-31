<?php

namespace App\Livewire\Drivers;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DriversIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public int $perPage = 1;
    public function render()
    {
        $query = User::where('type','driver');

        $drivers = $query->paginate($this->perPage);
        return view('drivers.drivers-index',compact('query', 'drivers'));
    }
}
