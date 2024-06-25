<?php

namespace App\Repository;


use App\Models\User;
use App\Models\Driver;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\MapsProcessing;

use App\Traits\ImageProcessing;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Repositoryinterface\DriverRepositoryinterface;

class DBDriverRepository implements DriverRepositoryinterface
{
    use ImageProcessing, MapsProcessing;

    protected Model $user, $driver;
    protected $request;

    public function __construct(User $user, Driver $driver, Request $request)
    {
        $this->user = $user;
        $this->driver = $driver;
        $this->request = $request;
    }
    public function registration()
    {


        $user = Auth::user();

        try {
            $validator = Validator::make($this->request->all(), [
                'brand_id'                 => 'required|integer',
                'model_id'                 => 'required|integer',
                'color'                    => 'required|string|max:255',
                'release_year'             => 'required|integer|min:1900|max:' . date('Y'),
                'passengers_number'        => 'required|integer|min:1',
                'national_id_number'       => 'required|string|max:255',
                'vehicle_serial_number'    => 'required|string|max:255',
                'national_id_doc'          => 'required|file|mimes:jpeg,png,jpg,pdf',
                'driving_license_doc'      => 'required|file|mimes:jpeg,png,jpg,pdf',
                'vehicle_insurance_doc'    => 'required|file|mimes:jpeg,png,jpg,pdf',
                'vehicle_registration_doc' => 'required|file|mimes:jpeg,png,jpg,pdf',
            ]);
            DB::beginTransaction();
            $data = $validator->validated();
            $publicPath = 'documents/' . $user->id;
            $nationalIdDocName = 'national_id_' . Str::random(10) . '.' . $data['national_id_doc']->getClientOriginalExtension();
            $drivingLicenseDocName = 'driving_license_' . Str::random(10) . '.' . $data['driving_license_doc']->getClientOriginalExtension();
            $vehicleInsuranceDocName = 'vehicle_insurance_' . Str::random(10) . '.' . $data['vehicle_insurance_doc']->getClientOriginalExtension();
            $vehicleRegistrationDocName = 'vehicle_registration_' . Str::random(10) . '.' . $data['vehicle_registration_doc']->getClientOriginalExtension();

            Driver::create([
                'user_id'                  => $user->id,
                'brand_id'                 => $data['brand_id'],
                'model_id'                 => $data['model_id'],
                'color'                    => $data['color'],
                'release_year'             => $data['release_year'],
                'passengers_number'        => $data['passengers_number'],
                'national_id_number'       => $data['national_id_number'],
                'vehicle_serial_number'    => $data['vehicle_serial_number'],
                'national_id_doc'          => $data['national_id_doc']->storeAs('public/' . $publicPath, $nationalIdDocName),
                'driving_license_doc'      => $data['driving_license_doc']->storeAs('public/' . $publicPath, $drivingLicenseDocName),
                'vehicle_insurance_doc'    => $data['vehicle_insurance_doc']->storeAs('public/' . $publicPath, $vehicleInsuranceDocName),
                'vehicle_registration_doc' => $data['vehicle_registration_doc']->storeAs('public/' . $publicPath, $vehicleRegistrationDocName),
            ]);

            DB::commit();
            return Resp([], __('messages.success'), 200, true);
        } catch (\Illuminate\Validation\ValidationException $ex) {
            return response()->json(['errors' => $ex->errors()], 422);
        } catch (\Exception $ex) {
            DB::rollback();
            return Resp([], $ex->getMessage(), 404, false);
        }
    }
}
