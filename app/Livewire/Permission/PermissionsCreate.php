<?php

namespace App\Livewire\Permission;

use App\Models\Permission;
use Livewire\Component;

class PermissionsCreate extends Component
{
    public Permission $permission;

    public function mount(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function render()
    {
        return view('permission.create');
    }

    public function submit()
    {
        $this->validate();

        $this->permission->save();

        return redirect()->route('permissions.list');
    }

    protected function rules(): array
    {
        return [
            'permission.title' => [
                'string',
                'required',
            ],
        ];
    }
}
