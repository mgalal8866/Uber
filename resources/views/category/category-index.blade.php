<div>

    <div class="card">
        <div>

            @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <span class="alert-icon text-success me-2">
                  <i class="ti ti-check ti-xs"></i>
                </span>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
        </div>
        <div class="card-header border-bottom  ">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">
                    {{ __('trans.category') }}
                </h6>
                <a class="btn btn-primary" href="{{ route('category.create') }}">
                    {{ trans('trans.add') }} {{ trans('trans.category') }}
                </a>

            </div>
        </div>

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
                    @foreach ($categorycar as $category)
                        <tr>
                            <td >
                                <div class="avatar avatar-lg me-2">
                                <img src="{{ $category->imageurl }}" alt="user-avatar"
                                    class="rounded-circle" >
                                </div>
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
                                        <a class="dropdown-item" href="{{ route('category.edit',['categorycar'=> $category->id]) }}"><i
                                                class="ti ti-pencil me-1"></i> Edit</a>
                                        {{-- <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-trash me-1"></i> Delete</a> --}}
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
