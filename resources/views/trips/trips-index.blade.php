<div>
    @section('title')
        {{ env('APP_NAME') . ' - ' . __('trans.trips') }}
    @endsection
    <div class="card">

        <div class="card-header border-bottom  ">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">
                    {{ trans('trans.trips') }}

                </h6>

            </div>
            <div class="d-flex justify-content-between my-3  ">
                <div class="w-100">
                    Per page:
                    <select wire:model="perPage" class="form-select w-25 d-inline">
                        @foreach ($paginationOptions as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>

                    Status:
                    <select wire:model="tripstatus" class="form-select w-25 d-inline">
                        <option value="all">All</option>
                        <option value="searching">searching</option>
                        <option value="accepted">accepted</option>
                        <option value="started">started</option>
                        <option value="complete">complete</option>
                        <option value="canceled">canceled</option>


                    </select>



                    @if (file_exists(app_path('Livewire/ExcelExport.php')))
                        <livewire:excel-export model="Trip" format="csv" />
                        <livewire:excel-export model="Trip" format="xlsx" />
                        <livewire:excel-export model="Trip" format="pdf" />
                    @endif
                </div>

            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('trans.user') }}</th>
                        <th>{{ __('trans.driver') }}</th>
                        <th>{{ __('trans.distance') }} (Km)</th>
                        <th>{{ __('trans.min') }}</th>
                        <th>{{ __('trans.status') }}</th>
                        <th>{{ __('trans.amount') }}</th>
                        <th>{{ __('trans.lastupdate') }}</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($trips as $trip)
                        <tr>
                            <td>
                                <span class="fw-medium">{{ $trip->user?->name }}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $trip->driver?->name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ number_format($trip->distance,1) }}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ number_format($trip->min)  }}</span>
                            </td>
                            <td>
                                <span class="badge  rounded-pill bg-{{ match($trip->status) {'searching' => 'dark',
                                    'accepted' => 'warning',
                                    'started' => 'info',
                                    'completed  ' => 'success',
                                    'canceled' => 'danger',
                                    default => 'secondary',} }}">
                                    {{ $trip->status }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">{{  number_format($trip->final_amount,2) }}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $trip->updated_at }}</span>
                            </td>


                            {{-- <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-pencil me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="row mx-2">

            {{ $trips->links() }}
        </div>
    </div>

</div>
