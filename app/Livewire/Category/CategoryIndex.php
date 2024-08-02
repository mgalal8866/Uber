<?php

namespace App\Livewire\Category;

use Livewire\Component;

use App\Models\CategoryCar;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public int $perPage = 20;

    public function render()
    {
        $query = CategoryCar::query();

        $categorycar = $query->paginate($this->perPage);

        return view('category.category-index', compact('query', 'categorycar'));


    }
}
