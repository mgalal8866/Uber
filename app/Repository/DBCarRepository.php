<?php

namespace App\Repository;

use App\Http\Resources\BrandsResource;
use App\Models\Otp;
use App\Models\User;

use Illuminate\Http\Request;
use App\Traits\MapsProcessing;
use App\Traits\ImageProcessing;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\LoginUserResource;
use App\Http\Resources\ModelResource;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Repositoryinterface\CarRepositoryinterface;


class DBCarRepository implements CarRepositoryinterface
{
    use ImageProcessing, MapsProcessing;

    protected Model $brand, $carmodel;

    protected $request;

    public function __construct(CarBrand $brand, CarModel $carmodel, Request $request)
    {
        $this->brand = $brand;
        $this->carmodel = $carmodel;
        $this->request = $request;
    }
    public function brands()
    {
        $brand =      $this->brand->get();

        return Resp(BrandsResource::collection($brand), __('messages.success'), 200, true);
    }
    public function model()
    {
        $carmodel = $this->carmodel::where(['car_brand_id' =>   $this->request->brand_id])->get();
        return Resp(ModelResource::collection($carmodel), __('messages.success'), 200, true);
    }
}
