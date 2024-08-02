<?php

namespace App\Livewire\Trips;

use App\Models\Trip;
use Livewire\Component;
use Livewire\WithPagination;

class TripsIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public int $perPage = 20;
    public function render()
    {
        $query = Trip::query();

        $trips = $query->paginate($this->perPage);
        return view('trips.trips-index',compact('query', 'trips'));
    }
}
