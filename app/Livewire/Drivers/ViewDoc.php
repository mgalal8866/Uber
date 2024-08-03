<?php

namespace App\Livewire\Drivers;

use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Driver;
use Livewire\Component;

class ViewDoc extends Component
{
    public $models,$brands,  $edit = false, $driver;
    public $category_id, $charge_km, $charge_min, $brand_id, $model_id, $balance, $color, $release_year, $vehicle_number, $passengers_number, $national_id_number, $national_id_doc, $driving_license_doc, $birth_date, $vehicle_image, $vehicle_registration_doc, $vehicle_insurance_doc, $vehicle_serial_number, $status;
    public function mount(Driver $driver)
    {

        $this->driver = $driver;

        $this->category_id               = $this->driver->category_id;

        $this->charge_km                 = $this->driver->charge_km;
        $this->charge_min                = $this->driver->charge_min;

        $this->brand_id                  = $this->driver->brand_id;
        $this->model_id                  = $this->driver->model_id;
        $this->balance                   = $this->driver->balance;
        $this->color                     = $this->driver->color;
        $this->release_year              = $this->driver->release_year;
        $this->vehicle_number            = $this->driver->vehicle_number;
        $this->passengers_number         = $this->driver->passengers_number;

        $this->national_id_number        = $this->driver->national_id_number;
        $this->national_id_doc           = $this->driver->national_id_doc;
        $this->driving_license_doc       = $this->driver->driving_license_doc;
        $this->birth_date                = $this->driver->birth_date;

        $this->vehicle_image             = $this->driver->vehicle_image;
        $this->vehicle_registration_doc  = $this->driver->vehicle_registration_doc;
        $this->vehicle_insurance_doc     = $this->driver->vehicle_insurance_doc;
        $this->vehicle_serial_number     = $this->driver->vehicle_serial_number;
        $this->status                    = $this->driver->status;
 
        $this->brands =    CarBrand::get();
        $this->models =    CarModel::where('car_brand_id',$this->driver->brand_id)->get();
    }
    public function render()
    {
        return view('drivers.view-doc');
    }
}
