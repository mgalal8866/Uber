<?php

namespace App\Livewire\Permission;

// use App\Http\Livewire\WithConfirmation;
// use App\Http\Livewire\WithSorting;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use App\Livewire\WithSorting;
use Illuminate\Http\Response;
use App\Livewire\WithConfirmation;
use Illuminate\Support\Facades\Gate;

class PermissionsIndex extends Component
{

    use WithPagination, WithSorting, WithConfirmation;
    protected $paginationTheme = 'bootstrap';
    public int $perPage;

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
        $this->orderable         = (new Permission())->orderable;
    }

    public function render()
    {
        $query = Permission::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $permissions = $query->paginate($this->perPage);

        return view('permission.index', compact('permissions', 'query'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Permission::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();
    }
}
