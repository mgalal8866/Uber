<div>

    <div class="card">

        <div class="card-header border-bottom  ">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">
                    {{ trans('trans.drivers') }}

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

                    @can('role_delete')
                        <button class="btn btn-danger ms-3" type="button" wire:click="confirm('deleteSelected')"
                            wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                            {{ __('Delete Selected') }}
                        </button>
                    @endcan

                    @if (file_exists(app_path('Livewire/ExcelExport.php')))
                        <livewire:excel-export model="User" format="csv" />
                        <livewire:excel-export model="User" format="xlsx" />
                        <livewire:excel-export model="User" format="pdf" />
                    @endif
                </div>
                <div class="w-100 text-end">
                    Search:
                    <input type="text" wire:model.debounce.300ms="search" class="form-control w-50 d-inline-block" />
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('trans.image') }}</th>
                        <th>{{ __('trans.name') }}</th>
                        <th>{{ __('trans.phone') }}</th>
                        <th>{{ __('trans.balance') }}</th>
                        <th>{{ __('trans.account') }}</th>
                        <th>{{ __('trans.driver') }}</th>
                        <th>{{ __('trans.action') }}</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ( $drivers as  $driver)
                    <tr>
                        <td>
                            <img src="{{ $driver->imageurl }}" alt="user-avatar" class="d-block w-px-50 h-px-50 rounded" id="uploadedAvatar">
                        </td>
                        <td>
                            <span class="fw-medium">{{ $driver->name }}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $driver->phone }}</span>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $driver->balance }}</span>
                        </td>

                        <td>
                            <span class="badge badge-center rounded-pill bg-{{ $driver->status == 'accept' ? 'success' : ( $driver->status == 'block' ? 'danger' : 'warning')}}"><i class="ti ti-{{ $driver->status == 'accept'?'check':($driver->status == 'block'?'close' :'clock')}}"></i></span>
                        </td>
                        <td>
                            @if( $driver?->driver)

                            <span class="badge badge-center rounded-pill bg-{{ $driver?->driver?->status == 'accept' ? 'success' : ( $driver?->driver?->status == 'block' ? 'danger' : 'warning')}}"><i class="ti ti-{{ $driver?->driver?->status == 'accept'?'check':($driver?->driver?->status == 'block'?'close' :'clock')}}"></i></span>
                            @endif

                        </td>


                        {{-- <td><span class="badge bg-label-warning me-1">Pending</span></td> --}}
                        <td>
                            <a class="btn btn-success btn-sm" href="javascript:void(0);">  View Doc</a>
                            {{-- <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="ti ti-pencil me-1"></i> View Doc</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="ti ti-trash me-1"></i> Delete</a>
                                </div>
                            </div> --}}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="row mx-2">

            {{ $drivers->links() }}
        </div>
    </div>

</div>
