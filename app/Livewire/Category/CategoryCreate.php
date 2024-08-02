<?php

namespace App\Livewire\Category;

use Livewire\Component;

use App\Models\CategoryCar;
use Livewire\WithPagination;
use Illuminate\Http\Response;
use Livewire\WithFileUploads;
use App\Traits\MapsProcessing;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\Gate;

class CategoryCreate extends Component
{
    use ImageProcessing, MapsProcessing;
    use WithPagination, WithFileUploads;
    public $image, $chargekm, $chargemin, $name;

    protected $rules = [
        'name' => 'required|string',
        'chargemin' => 'required|integer',
        'chargekm' => 'required|integer',
    ];

    public function submit()
    {
        $this->validate();

        $dataX = $this->saveImageAndThumbnail($this->image, false, null, 'category');
        CategoryCar::create([
            'charge_km' => $this->chargekm,
            'charge_min' => $this->chargemin,
            'name' => $this->name,
            'image' => $dataX['image']
        ]);
        session()->flash('message', 'Category successfully Created.');
        return redirect()->route('category.index');
    }
    public function render()
    {
        // abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('category.category-create');
    }
}
