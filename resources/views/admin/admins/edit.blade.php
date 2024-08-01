@extends('layouts.admin')
@section('content')
@section('title', $pageTitle)
@section('pageName', $pageTitle)
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endpush
@push('scripts')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script>
        $(function() {
           $(window).ready(function() {
            var select2 = $('.select2');
            if (select2.length) {
                select2.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        placeholder: 'Select value',
                        dropdownParent: $this.parent()
                    });
                });
            }
           });
        });
    </script>
@endpush
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.admins.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-fullname">{{ __('cruds.admin.fields.full_name') }}</label>
                                <input type="text" value="{{ $row->full_name }}" name="full_name"
                                    class="form-control" id="basic-default-fullname"
                                    placeholder="{{ __('cruds.admin.fields.full_name') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-email">{{ __('cruds.admin.fields.email') }}</label>
                                <input type="email" name="email" value="{{ $row->email }}" class="form-control"
                                    placeholder="{{ __('cruds.admin.fields.email') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('cruds.admin.fields.password') }}</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="{{ __('cruds.admin.fields.password') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('cruds.admin.fields.confirm_password') }}</label>
                                <input type="password" name="confirm_password" class="form-control"
                                    placeholder="{{ __('cruds.admin.fields.confirm_password') }}">
                            </div>
                        </div>
                        <div class="col-lg-12 select2-primary">
                            <label class="form-label" for="multicol-roles">{{ __('cruds.admin.fields.roles') }}</label>
                            <select id="multicol-roles" name="roles[]" class="select2 form-select" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ in_array($role->id, $selected) ? 'selected' : '' }}>{{ $role->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>

            <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('global.save') }}</button>
            </form>
        </div>
    </div>
</div>




@endsection
