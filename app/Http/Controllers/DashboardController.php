<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['count_user'] = User::where('type', 'user')->count();
        $data['count_driver'] = User::where('type', 'driver')->count();
        $data['count_trip'] = Trip::count();
        $data['count_trip_live'] = Trip::whereIn('status', ['searching', 'accepted', 'started'])->count();
        $data['top_driver_has_trip'] = User::where('type', 'driver')
            ->withCount('trips_driver')
            ->orderBy('trips_driver_count', 'desc')
            ->limit(5)
            ->get();
        $data['top_user_has_trip'] =  User::where('type', 'user')
            ->withCount('trips_user')
            ->orderBy('trips_user_count', 'desc')
            ->limit(5)
            ->get();
        $data['top_driver_rating'] =  User::where('type', 'driver')
            ->with('rating')
            ->whereHas('rating')
            ->get()
            ->sortByDesc('rating.value')
            ->take(5);



        $today = Carbon::now();
        $startOfWeek = $today->copy()->startOfWeek()->subWeek(); // Start of the previous week
        $endOfWeek = $today->copy()->endOfWeek()->subWeek();     // End of the previous week
        $data['trip_charts_period'] = 'last7';
        $tripData = Trip::select(DB::raw('DATE(is_completed) as date'), DB::raw('sum(final_amount) as final_amount'))
            ->where('status', 'completed')
            ->whereBetween('is_completed', [$startOfWeek, $endOfWeek])
            ->groupBy(DB::raw('DATE(is_completed)'))
            ->get();

            $data['trip_charts_date']= $tripData->pluck('date')->toArray();
            $data['trip_charts_final_amount']= $tripData->pluck('final_amount')->toArray();
            // dd($data['trip_charts_final_amount'], $data['trip_charts_date']);
        return view('dashboard', compact('data'));
    }
}
