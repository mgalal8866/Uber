<div>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endpush
@push('scripts')
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endpush
    <div class="row">
        <div class="card   ">
            <div class="card-header">
                <div class="card-header-container">
                    <h6 class="card-title">
                        {{ trans('trans.create') }}
                        {{ trans('cruds.role.title_singular') }}
                    </h6>
                </div>
            </div>

            <div class="card-body">
                <form wire:submit.prevent="submit" class="pt-3">

                    <div class="mb-3 {{ $errors->has('role.title') ? 'is-invalid' : '' }}">
                        <label class="form-label required" for="title">{{ trans('trans.role.fields.title') }}</label>
                        <input class="form-control" type="text" name="title" id="title"  wire:model="role.title" required >
                        @if ($errors->has('role.title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('role.title') }}
                            </div>
                        @endif
                        {{-- <div class="form-text">
                            {{ trans('trans.role.fields.title_helper') }}
                        </div> --}}
                    </div>

                    <div class="mb-3 {{ $errors->has('permissions') ? 'is-invalid' : '' }}">
                        <label class="form-label required"
                            for="permissions">{{ trans('trans.role.fields.permissions') }}</label>

                        <x-select-list class="form-control" required id="permissions" name="permissions"
                            wire:model="permissions" :options="$this->listsForFields['permissions']" multiple />
                        @if ($errors->has('permissions'))
                            <div class="invalid-feedback">
                                {{ $errors->first('permissions') }}
                            </div>
                        @endif
                        {{-- <div class="form-text">
                            {{ trans('trans.role.fields.permissions_helper') }}
                        </div> --}}
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary me-2" type="submit">
                            {{ trans('trans.save') }}
                        </button>
                        <a href="{{ route('roles.list') }}" class="btn btn-secondary">
                            {{ trans('trans.cancel') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
