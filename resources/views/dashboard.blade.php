@extends('layout.main')

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Statistics</h5>
                {{-- <small class="text-muted">Updated 1 month ago</small> --}}
            </div>
            <div class="card-body pt-2">
                <div class="row gy-3">

                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-user ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $data['count_user'] }}</h5>
                                <small>Total Users</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-users ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $data['count_driver'] }}</h5>
                                <small>Total Drivers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                <i class="ti ti-car ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $data['count_trip'] }}</h5>
                                <small>Total Trips</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                <i class="ti ti-car ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ $data['count_trip_live'] }}</h5>
                                <small>Live Trips</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 col-xl-4 mb-4 col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Top Drivers Trips</h5>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                            <tr>
                                <th>Driver</th>
                                <th class="text-end">Total Trip</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['top_driver_has_trip'] as $trip_driver)
                                <tr>
                                    <td class="pt-2">
                                        <div class="d-flex justify-content-start align-items-center mt-lg-4">
                                            <div class="avatar me-3 avatar-sm">
                                                <img src="{{ $trip_driver->imageurl ?? asset('assets/img/default_avatar.png') }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0">{{ $trip_driver->name }}</h6>
                                                {{-- <small class="text-truncate text-muted">Business Intelligence</small> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pt-2">
                                        <div class="user-progress mt-lg-4">
                                            <p class="mb-0 fw-medium">{{ $trip_driver->trips_driver->count() ?? 0 }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 mb-4 col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Top Users Trips</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                            <tr>
                                <th>User</th>
                                <th class="text-end">Total Trip</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['top_user_has_trip'] as $trip_user)
                                <tr>
                                    <td class="pt-2">
                                        <div class="d-flex justify-content-start align-items-center mt-lg-4">
                                            <div class="avatar me-3 avatar-sm">
                                                <img src="{{ $trip_user->imageurl ?? asset('assets/img/default_avatar.png') }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0">{{ $trip_user->name }}</h6>
                                                {{-- <small class="text-truncate text-muted">Business Intelligence</small> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pt-2">
                                        <div class="user-progress mt-lg-4">
                                            <p class="mb-0 fw-medium">{{ $trip_user->trips_user->count() ?? 0 }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 mb-4 col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Top 5 Rating Driver</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless border-top">
                        <thead class="border-bottom">
                            <tr>
                                <th>Driver</th>
                                <th class="text-end">Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['top_driver_rating'] as $top_rating)
                                <tr>
                                    <td class="pt-2">
                                        <div class="d-flex justify-content-start align-items-center mt-lg-4">
                                            <div class="avatar me-3 avatar-sm">
                                                <img src="{{ $top_rating->imageurl ?? asset('assets/img/default_avatar.png') }}"
                                                    alt="Avatar" class="rounded-circle" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0">{{ $top_rating->name }}</h6>
                                                {{-- <small class="text-truncate text-muted">Business Intelligence</small> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pt-2">
                                        <div class="user-progress mt-lg-4">
                                            <p class="mb-0 fw-medium">{{ $top_rating->rating->sum('stars') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-12 mb-4">
            <div class="card">
                <div class="card-header header-elements">
                    <h5 class="card-title mb-0">Latest Statistics</h5>
                    <div class="card-action-element ms-auto py-0">
                       Last 7 Days
                        {{-- <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ti ti-calendar"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center {{ $data['trip_charts_period'] == 'today' ? 'active' : '' }}">Today</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center  {{ $data['trip_charts_period'] == 'yesterday' ? 'active' : '' }}">Yesterday</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center {{ $data['trip_charts_period'] == 'last7' ? 'active' : '' }}">Last
                                        7
                                        Days</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center {{ $data['trip_charts_period'] == 'last30' ? 'active' : '' }}">Last
                                        30
                                        Days</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center {{ $data['trip_charts_period'] == 'current_month' ? 'active' : '' }}">Current
                                        Month</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center {{ $data['trip_charts_period'] == 'last_month' ? 'active' : '' }}">Last
                                        Month</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="barChart" class="chartjs" data-height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    {{-- <script src="{{ asset('assets/js/charts-chartjs.js') }}"></script> --}}
    <script>
        (function() {
            // Color Variables
            const purpleColor = '#836AF9',
                yellowColor = '#ffe800',
                cyanColor = '#28dac6',
                orangeColor = '#FF8132',
                orangeLightColor = '#FDAC34',
                oceanBlueColor = '#299AFF',
                greyColor = '#4F5D70',
                greyLightColor = '#EDF1F4',
                blueColor = '#2B9AFF',
                blueLightColor = '#84D0FF';

            let cardColor, headingColor, labelColor, borderColor, legendColor;
            const tripChartsFinalAmount = @json($data['trip_charts_final_amount']);
            const tripChartsDate = @json($data['trip_charts_date']);
            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                headingColor = config.colors_dark.headingColor;
                labelColor = config.colors_dark.textMuted;
                legendColor = config.colors_dark.bodyColor;
                borderColor = config.colors_dark.borderColor;
            } else {
                cardColor = config.colors.cardColor;
                headingColor = config.colors.headingColor;
                labelColor = config.colors.textMuted;
                legendColor = config.colors.bodyColor;
                borderColor = config.colors.borderColor;
            }

            // Set height according to their data-height
            // --------------------------------------------------------------------
            const chartList = document.querySelectorAll('.chartjs');
            chartList.forEach(function(chartListItem) {
                chartListItem.height = chartListItem.dataset.height;
            });

            // Bar Chart
            // --------------------------------------------------------------------

            const barChart = document.getElementById('barChart');
            if (barChart) {
                const barChartVar = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: tripChartsDate,
                        datasets: [{
                            data: tripChartsFinalAmount,
                            backgroundColor: cyanColor,
                            borderColor: 'transparent',
                            maxBarThickness: 15,
                            borderRadius: {
                                topRight: 15,
                                topLeft: 15
                            }
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 500
                        },
                        plugins: {
                            tooltip: {
                                rtl: isRtl,
                                backgroundColor: cardColor,
                                titleColor: headingColor,
                                bodyColor: legendColor,
                                borderWidth: 1,
                                borderColor: borderColor
                            },
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: borderColor,
                                    drawBorder: false,
                                    borderColor: borderColor
                                },
                                ticks: {
                                    color: labelColor
                                }
                            },
                            y: {
                                min: 0,
                                max: 400,
                                grid: {
                                    color: borderColor,
                                    drawBorder: false,
                                    borderColor: borderColor
                                },
                                ticks: {
                                    stepSize: 100,
                                    color: labelColor
                                }
                            }
                        }
                    }
                });
            }

        })();
    </script>
@endpush
