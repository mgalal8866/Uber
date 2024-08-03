<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('permission.title') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans(' permission') }}</label>
        <input class="form-control" type="text" name="title" id="title" required wire:model.defer="permission.title">
        <div class="validation-message">
            {{ $errors->first('permission.title') }}
        </div>

    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('save') }}
        </button>
        <a href="{{ route('permissions.list') }}" class="btn btn-secondary">
            {{ trans('cancel') }}
        </a>
    </div>
</form>

