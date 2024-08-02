<div>
     
    <div class="card">
        <div class="card-header border-bottom  ">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">
                    {{ trans('trans.permission.title_singular') }}
                    {{ trans('trans.list') }}
                </h6>
                {{--
                    @can('permission_create') --}}
                <a class="btn btn-primary" href="{{ route('permissions.create') }}">
                    {{ trans('trans.add') }} {{ trans('trans.permission.title_singular') }}
                </a>
                {{-- @endcan --}}
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

                    @if (file_exists(app_path('Http/Livewire/ExcelExport.php')))
                        <livewire:excel-export model="Role" format="csv" />
                        <livewire:excel-export model="Role" format="xlsx" />
                        <livewire:excel-export model="Role" format="pdf" />
                    @endif
                </div>
                <div class="w-100 text-end">
                    Search:
                    <input type="text" wire:model.debounce.300ms="search" class="form-control w-50 d-inline-block" />
                </div>
            </div>
        </div>






        <div class="card-body">
            <div wire:loading.delay>
                Loading...
            </div>

            <div class="table-responsive">
                <table class="table table-index w-100">
                    <thead>
                        <tr>
                            {{-- <th class="w-9"></th> --}}
                            <th class="w-28">
                                {{ trans('trans.permission.fields.id') }}
                                @include('components.table.sort', ['field' => 'id'])
                            </th>
                            <th>
                                {{ trans('trans.permission.fields.title') }}
                                @include('components.table.sort', ['field' => 'title'])
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                {{-- <td>
                                            <input type="checkbox" value="{{ $permission->id }}" wire:model="selected">
                                        </td> --}}
                                <td>
                                    {{ $permission->id }}
                                </td>
                                <td>
                                    {{ $permission->title }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        @can('permission_show')
                                            <a class="btn btn-sm btn-info me-2"
                                                href="{{ route('permissions.show', $permission) }}">
                                                {{ trans('trans.view') }}
                                            </a>
                                        @endcan
                                        {{-- @can('permission_edit') --}}
                                        <a class="btn btn-sm btn-success me-2"
                                            href="{{ route('permissions.edit', $permission) }}">
                                            {{ trans('trans.edit') }}
                                        </a>
                                        {{-- @endcan --}}
                                        {{-- @can('permission_delete') --}}
                                        <button class="btn btn-sm btn-danger me-2" type="button"
                                            wire:click="confirm('delete', {{ $permission->id }})"
                                            wire:loading.attr="disabled">
                                            {{ trans('trans.delete') }}
                                        </button>
                                        {{-- @endcan --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">No entries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pt-3">
                @if ($this->selectedCount)
                    <p class="text-sm leading-5">
                        <span class="fw-bold">
                            {{ $this->selectedCount }}
                        </span>
                        {{ __('Entries selected') }}
                    </p>
                @endif
                {{ $permissions->links() }}
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
            if (!confirm("{{ trans('trans.areYouSure') }}")) {
                return
            }
            @this[e.callback](...e.argv)
        })
    </script>
@endpush
