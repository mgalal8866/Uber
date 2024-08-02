<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public int $perPage = 20;

    public function render()
    {
        $query = User::where('type','user');

        $users = $query->paginate($this->perPage);

        return view('users.users-index', compact('query', 'users'));


    }

}
