<div>

    <div class="card">
        <h5 class="card-header">{{ __('trans.category') }}</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('trans.image') }}</th>
                        <th>{{ __('trans.name') }}</th>
                        <th>{{ __('trans.charge_km') }}</th>
                        <th>{{ __('trans.charge_min') }}</th>


                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $categorycar as  $category)
                    <tr>
                        <td>
                            <span class="fw-medium">{{ $category->image }}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $category->name }}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $category->charge_km }}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $category->charge_min }}</span>
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

            {{ $categorycar->links() }}
        </div>
    </div>

</div>
