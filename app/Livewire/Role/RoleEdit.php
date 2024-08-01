<?php

namespace App\Livewire\Role;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class RoleEdit extends Component
{
    public Role $role;

    public array $permissions = [];

    public array $listsForFields = [];

    public function mount(Role $role)
    {
        $this->role        = $role;
        $this->permissions = $this->role->permissions()->pluck('id')->toArray();

        $this->initListsForFields();
    }

    public function render()
    {
        return view('role.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->role->save();
        $this->role->permissions()->sync($this->permissions);

        return redirect()->route('roles.list');
    }

    protected function rules(): array
    {
        return [
            'role.title' => [
                'string',
                'required',
            ],
            'permissions' => [
                'required',
                'array',
            ],
            'permissions.*.id' => [
                'integer',
                'exists:permissions,id',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['permissions'] = Permission::pluck('title', 'id')->toArray();
    }
}
