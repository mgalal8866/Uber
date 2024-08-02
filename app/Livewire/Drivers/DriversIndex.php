<?php

namespace App\Livewire\Drivers;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\WithSorting;
use App\Livewire\WithConfirmation;

class DriversIndex extends Component
{
    use WithPagination, WithSorting, WithConfirmation;
    protected $paginationTheme = 'bootstrap';   public int $perPage  ;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

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
        $this->orderable         = (new User())->orderable;

    }
    public function render()
    {


        $query = User::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);



        $drivers = $query->where('type','driver')->paginate($this->perPage);

        return view('drivers.drivers-index',compact('query', 'drivers'));
    }
}
