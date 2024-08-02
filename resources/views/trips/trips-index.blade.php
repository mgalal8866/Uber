<div>
    @section('title')
        {{ env('APP_NAME') . ' - ' . __('trans.trips') }}
    @endsection
    <div class="card">
        <h5 class="card-header">{{ __('trans.trips') }}</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('trans.image') }}</th>
                        <th>{{ __('trans.name') }}</th>
                        <th>{{ __('trans.phone') }}</th>
                        <th>{{ __('trans.balance') }}</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $trips as  $trip)
                    <tr>
                        <td>
                            <span class="fw-medium">{{ $trip->image }}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $trip->name }}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $trip->phone }}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $trip->balance }}</span>
                        </td>



                        {{-- <td><span class="badge bg-label-warning me-1">Pending</span></td> --}}
                        <td>
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
                        </td>
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