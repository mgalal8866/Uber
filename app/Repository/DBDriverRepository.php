<?php

namespace App\Repository;


use App\Models\User;
use App\Models\Driver;

use App\Models\DriverArea;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\ExtraServices;

use App\Traits\MapsProcessing;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ServicesResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\DriverAreaResource;
use App\Repositoryinterface\DriverRepositoryinterface;

class DBDriverRepository implements DriverRepositoryinterface
{
    use ImageProcessing, MapsProcessing;

    protected Model $user, $driver, $services, $driver_area;
    protected $request;

    public function __construct(User $user, Driver $driver, ExtraServices $services, DriverArea $driver_area, Request $request)
    {
        $this->user = $user;
        $this->driver = $driver;
        $this->driver_area = $driver_area;
        $this->services = $services;
        $this->request = $request;
    }
    public function registration()
    {
        dd($this->request->all());
        try {
            $validator = Validator::make($this->request->all(), [
                'phone'                    => 'required',
                'brand_id'                 => 'required|exists:car_brands,id',
                'model_id'                 => 'required|exists:car_models,id',
                'color'                    => 'required|string|max:255',
                'release_year'             => 'required|integer|min:1900|max:' . date('Y'),
                'vehicle_number'           => 'required',
                'passengers_number'        => 'required|integer|min:1',
                'national_id_number'       => 'required|string|max:255',
                'vehicle_serial_number'    => 'required|string|max:255',
                'national_id_doc'          => 'required|file|mimes:jpeg,png,jpg,pdf',
                'driving_license_doc'      => 'required|file|mimes:jpeg,png,jpg,pdf',
                'vehicle_insurance_doc'    => 'required|file|mimes:jpeg,png,jpg,pdf',
                'vehicle_registration_doc' => 'required|file|mimes:jpeg,png,jpg,pdf',
                'driver_image'             => 'file|mimes:jpeg,png,jpg,pdf',
                'vehicle_image'            => 'required|file|mimes:jpeg,png,jpg,pdf',
                'birth_date'               => 'required|date',

            ]);
            DB::beginTransaction();
            $datauser = [
                'name'          => $this->request->name,
                'email'         => $this->request->email ?? null,
                'phone'         => $this->request->phone,
            ];
            $user =  User::firstOrCreate(['phone' => $this->request->phone], $datauser);


            $data = $validator->validated();
            $publicPath                  = 'public/documents/' . $user->id;
            $nationalIdDocName           =   Str::random(10) . '.' . $data['national_id_doc']->getClientOriginalExtension();
            $drivingLicenseDocName       =   Str::random(10) . '.' . $data['driving_license_doc']->getClientOriginalExtension();
            $vehicleInsuranceDocName     =   Str::random(10) . '.' . $data['vehicle_insurance_doc']->getClientOriginalExtension();
            $vehicleRegistrationDocName  =   Str::random(10) . '.' . $data['vehicle_registration_doc']->getClientOriginalExtension();
            $driver_image                =   Str::random(10) . '.' . $data['driver_image']->getClientOriginalExtension();
            $vehicle_image               =   Str::random(10) . '.' . $data['vehicle_image']->getClientOriginalExtension();

            $user->type  = 'driver';
            if ($data['driver_image'] != null) {
                $data['driver_image']->storeAs($publicPath, $driver_image);
                $user->image = $driver_image;
            }
            $user->save();
            $data['national_id_doc']->storeAs($publicPath, $nationalIdDocName);
            $data['driving_license_doc']->storeAs($publicPath, $drivingLicenseDocName);
            $data['vehicle_insurance_doc']->storeAs($publicPath, $vehicleInsuranceDocName);
            $data['vehicle_registration_doc']->storeAs($publicPath, $vehicleRegistrationDocName);
            $data['vehicle_image']->storeAs($publicPath, $vehicle_image);
            Driver::updateOrCreate(['user_id'  => $user->id], [
                'user_id'                  => $user->id,
                'birth_date'               => $data['birth_date'],
                'brand_id'                 => $data['brand_id'],
                'model_id'                 => $data['model_id'],
                'color'                    => $data['color'],
                'release_year'             => $data['release_year'],
                'vehicle_number'           => $data['vehicle_number'],
                'passengers_number'        => $data['passengers_number'],
                'national_id_number'       => $data['national_id_number'],
                'vehicle_serial_number'    => $data['vehicle_serial_number'],
                'national_id_doc'          =>  $nationalIdDocName,
                'driving_license_doc'      =>  $drivingLicenseDocName,
                'vehicle_insurance_doc'    =>  $vehicleInsuranceDocName,
                'vehicle_registration_doc' =>  $vehicleRegistrationDocName,
                'vehicle_image'            =>  $vehicle_image,
            ]);


            DB::commit();
            if ($user != null) {
                $user->token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
                return Resp(new UserResource($user), __('messages.success_login'), 200, true);
            } else {
                return Resp('', __('messages.notfound'), 200, false);
            }
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return response()->json(['errors' => $ex->errors()], 422);
        } catch (\Exception $ex) {
            DB::rollback();
            return Resp([], $ex->getMessage(), 404, false);
        }
    }
    public function services()
    {
        $services = $this->services::active()->where(['isuser' => 1])->with(['myservice' => function ($q) {
            if (Auth::check()) {
                $q->where('user_id', Auth::user()->id);
            }
        }])->get();
        if ($services != null) {
            return Resp(ServicesResource::collection($services), __('messages.success'), 200, true);
        }
    }
    public function status_online()
    {
        $user =  user::find(Auth::user()->id);
        $user  = $user->update(['is_online' => $this->request->online]);
        if ($user != null) {
            return Resp([], __('messages.success'), 200, true);
        }
    }
    public function new_driver_area()
    {
        $validator = Validator::make($this->request->all(), [
            'lat'                    => 'required',
            'long'                   => 'required',
            'area_name'              => 'required',
            'address'                => 'required',
            'radius'                 => 'required',
        ]);
        try {
            $datauser = $validator->validated();
            DB::beginTransaction();
            $datauser['driver_id'] =   Auth::user()->id;
            $driver_area = $this->driver_area::create($datauser);
            DB::commit();
            return Resp(new DriverAreaResource($driver_area), __('messages.success'), 200, true);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return response()->json(['errors' => $ex->errors()], 422);
        } catch (\Exception $ex) {
            DB::rollback();
            return Resp([], $ex->getMessage(), 404, false);
        }
    }
    public function get_driver_area()
    {
        $driver_area = $this->driver_area->where('driver_id', Auth::user()->id)->get();
        return Resp(DriverAreaResource::collection($driver_area), __('messages.success'), 200, true);
    }
}
