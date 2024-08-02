<div>

    <div class="card mb-4">
        <h5 class="card-header">{{ __('trans.add') }} {{ __('trans.category') }}</h5>
        <!-- Account -->
        <form  wire:submit.prevent="submit" >
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="{{ $image?->temporaryUrl() ?? '../../assets/img/no-image.png' }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded"
                    id="uploadedAvatar" />
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                        <span class="d-none d-sm-block">Upload</span>
                        <i class="ti ti-upload d-block d-sm-none"></i>
                        <input type="file"  wire:model="image"  id="upload" class="account-file-input" hidden
                            accept="image/png, image/jpeg" required/>
                    </label>

                    <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>

                    <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                    @error('image') <span class="error">{{ $message }}</span> @enderror
                    <div wire:loading wire:target="image">Uploading...</div>

                </div>
            </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="category" class="form-label">{{ __('trans.name') }}  {{ __('trans.category') }}</label>
                        <input class="form-control" type="text" wire:model="name"   />
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="charge_km" class="form-label">{{ __('trans.charge_km') }}</label>
                        <input class="form-control" type="number" wire:model="chargekm"   step="0.01"  required/>
                        @error('chargekm') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="charge_min" class="form-label">{{ __('trans.charge_min') }}</label>
                        <input class="form-control" type="number"  wire:model="chargemin" step="0.01"    required />
                        @error('chargemin') <span class="error">{{ $message }}</span> @enderror
                    </div>



                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <a type="reset" href="{{ route('category.index') }}" class="btn btn-label-secondary">Cancel</a>
                </div>

        </div>
    </form>
        <!-- /Account -->
    </div>

</div>
