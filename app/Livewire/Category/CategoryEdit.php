<?php

namespace App\Livewire\Category;

use Livewire\Component;

use App\Models\CategoryCar;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\MapsProcessing;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\Gate;

class CategoryEdit extends Component
{
    use ImageProcessing, MapsProcessing;
    use WithPagination, WithFileUploads;
    public  $imageorginal, $image, $chargekm, $chargemin, $name, $category;

    protected $rules = [
        'name' => 'required|string',
        'chargemin' => 'required|integer',
        'chargekm' => 'required|integer',
    ];

    public function mount(CategoryCar $categorycar)
    {
        $this->category  = $categorycar;
        $this->imageorginal  = $categorycar->imageurl;
        $this->chargekm  = $categorycar->charge_km;
        $this->chargemin  = $categorycar->charge_min;
        $this->name  = $categorycar->name;
    }
    public function fileClear($inputId)
{
    $this->$inputId = null;
}
    public function submit()
    {
        $this->validate();


        $data = [
            'charge_km' => $this->chargekm,
            'charge_min' => $this->chargemin,
            'name' => $this->name,

        ];
        if ($this->image != null) {
            $dataX = $this->saveImageAndThumbnail($this->image, false, null, 'category');
            $data['image'] = $dataX['image'];
        }
        $this->category->update($data);
        session()->flash('message', 'Category successfully Updated. ' . $this->name);
        return redirect()->route('category.index');
    }
    public function render()
    {
        // abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('category.category-edit');
    }
}
