<div class="row my-4">
    <div class="col">
        {{-- <h6>Collapsible Section</h6> --}}
        <div class="accordion" id="collapsibleSection">
            <!-- national_id -->
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingDeliveryAddress">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseDeliveryAddress" aria-expanded="true"
                        aria-controls="collapseDeliveryAddress">
                        {{ __('trans.driverdoc') }}
                    </button>
                </h2>
                <div id="collapseDeliveryAddress" class="accordion-collapse collapse show"
                    aria-labelledby="headingDeliveryAddress" data-bs-parent="#collapsibleSection">
                    <div class="accordion-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-fullname">national_id_number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" wire:model="national_id_number"
                                            {{ $edit == false ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-phone">national_id_doc</label>
                                    <div class="col-sm-9">
                                        <a class="form-control " href="{{ $national_id_doc }}" target="_blank">View </a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-phone">driving_license_doc</label>
                                    <div class="col-sm-9">
                                        <a class="form-control " href="{{ $driving_license_doc }}" target="_blank">View
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-address">birth_date</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" wire:model='birth_date'
                                            {{ $edit == false ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Delivery Options -->
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingDeliveryOptions">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseDeliveryOptions" aria-expanded="false"
                        aria-controls="collapseDeliveryOptions">
                        Vehicle
                    </button>
                </h2>
                <div id="collapseDeliveryOptions" class="accordion-collapse collapse"
                    aria-labelledby="headingDeliveryOptions" data-bs-parent="#collapsibleSection">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-address">release_year</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" wire:model='release_year'
                                            {{ $edit == false ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-address">vehicle_number</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" wire:model='vehicle_number'
                                            {{ $edit == false ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-address">passengers_number</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" wire:model='passengers_number'
                                            {{ $edit == false ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-address">color</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" wire:model='color'
                                            {{ $edit == false ? 'disabled' : '' }} />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-address">brand_id</label>

                                    <div class="col-sm-9">
                                        <select class="form-select" {{ $edit == false ? 'disabled' : '' }}
                                            wire:model='brand_id'>
                                            @foreach ($brands as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-address">model_id</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" {{ $edit == false ? 'disabled' : '' }}
                                            wire:model='model_id'>
                                            @foreach ($models as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingDeliveryOptions">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapselicensevehicleOptions" aria-expanded="false"
                        aria-controls="collapseDeliveryOptions">
                        License Vehicle
                    </button>
                </h2>
                <div id="collapselicensevehicleOptions" class="accordion-collapse collapse"
                    aria-labelledby="headingDeliveryOptions" data-bs-parent="#collapsibleSection">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-phone">vehicle_image</label>
                                    <div class="col-sm-9">
                                        <a class="form-control " href="{{ $vehicle_image }}" target="_blank">View
                                        </a>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-phone">vehicle_registration_doc</label>
                                    <div class="col-sm-9">
                                        <a class="form-control " href="{{ $vehicle_registration_doc }}"
                                            target="_blank">View
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-3 col-form-label text-sm-end"
                                        for="collapsible-phone">vehicle_insurance_doc</label>
                                    <div class="col-sm-9">
                                        <a class="form-control " href="{{ $vehicle_insurance_doc }}"
                                            target="_blank">View
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Payment Method -->

        </div>
    </div>
</div>
