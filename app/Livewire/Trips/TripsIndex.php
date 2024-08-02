<?php

namespace App\Livewire\Trips;

use App\Models\Trip;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\WithSorting;
use App\Livewire\WithConfirmation;

class TripsIndex extends Component
{
    use WithPagination, WithSorting, WithConfirmation;
    protected $paginationTheme = 'bootstrap';
    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];
    public  $tripstatus = 'all';

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Trip())->orderable;
    }
    public function render()
    {

        $query = Trip::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        if ($this->tripstatus != 'all') {
            $query=  $query->where('status',$this->tripstatus );
        }
        $trips = $query->paginate($this->perPage);
        return view('trips.trips-index', compact('query', 'trips'));
    }
}
