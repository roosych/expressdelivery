@extends('layouts.app-horizontal')

@section('title', 'Add Driver - Express Delivery PRO')

@section('content')
        <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-start">
                            <div class="col hp-flex-none w-auto">
                                <a href="{{route('drivers.index')}}" class="btn btn-primary w-100">
                                    <i class="ri-arrow-left-s-line remix-icon"></i>
                                    <span>All drivers</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <form action="{{route('driver.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-9 col-12">
                        <div class="card hp-contact-card mb-32 p-24 rounded border border-black-40 hp-border-color-dark-80 bg-black-0 hp-bg-color-dark-100">
                            <div class="row g-32">
                                <div class="col-12">
                                        <h4 class="mb-24">Personal Info</h4>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row g-24">
                                            <div class="col-12 col-md-3">
                                                <label for="fullname" class="form-label">
                                                    <span class="text-danger me-4">*</span>Full Name
                                                </label>
                                                <input type="text" class="form-control" value="{{ old('fullname') }}" name="fullname" id="fullname" required="">
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label for="phone" class="form-label">
                                                    <span class="text-danger me-4">*</span>Phone
                                                </label>
                                                <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" id="phone" required="">
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label for="owner_id" class="form-label">
                                                    Owner
                                                </label>
                                                <select name="owner_id" id="owner_id" class="form-select">
                                                    <option value="">Without owner</option>
                                                    @foreach($owners as $owner)
                                                        <option value="{{$owner->id}}">{{$owner->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label for="citizenship" class="form-label">
                                                    Status
                                                </label>
                                                <select name="citizenship" id="citizenship" class="form-select">
                                                    <option value="">Choose</option>
                                                    <option value="Resident" {{ old('citizenship') == 'Resident' ? "selected" : "" }}>Resident</option>
                                                    <option value="Citizen" {{ old('citizenship') == 'Citizen' ? "selected" : "" }}>Citizen</option>
                                                    <option value="NL (illegal)" {{ old('citizenship') == 'NL (illegal)' ? "selected" : "" }}>NL (illegal)</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="row py-24">
                                            <div class="col-12 col-md-4">
                                                <label for="vehicle_type_id" class="form-label"><span class="text-danger me-4">*</span>Vehicle Type</label>
                                                <select name="vehicle_type_id" id="vehicle_type_id" class="form-select">
                                                    <option value="">Choose</option>
                                                    @foreach($vehicle_types as $type)
                                                        <option value="{{$type->id}}" {{ old('vehicle_type_id') == $type->id ? "selected" : "" }}>{{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="capacity" class="form-label">
                                                    Capacity
                                                </label>
                                                <input type="text" class="form-control" value="{{ old('capacity') }}" name="capacity" id="capacity" required="">
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="dimension" class="form-label">
                                                    Dimension
                                                </label>
                                                <input type="text" class="form-control" value="{{ old('dimension') }}" name="dimension" id="dimension" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-check form-switch p-10">
                                                <input type="hidden" name="service" value="0">
                                                <input class="form-check-input" name="service" type="checkbox" value="1" id="service"{{ old('service') == 1 ? "checked" : "" }}>
                                                <label class="form-check-label" for="service">
                                                    <span class="ms-12">Availability</span>
                                                </label>
                                            </div>

                                            <div class="form-check form-switch p-10">
                                                <input type="hidden" name="status" value="0">
                                                <input class="form-check-input" name="status" type="checkbox" value="1" id="status" {{ old('status') == 1 ? "checked" : "" }} checked>
                                                <label class="form-check-label" for="status">
                                                    <span class="ms-12">Show on map</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                        <div class="form-check form-switch p-10">
                                            <input type="hidden" name="dnu" value="0">
                                            <input class="form-check-input" name="dnu" type="checkbox" value="1" id="dnu" {{ old('dnu') == 1 ? "checked" : "" }}>
                                            <label class="form-check-label" for="dnu">
                                                <span class="ms-12">DNU</span>
                                            </label>
                                        </div>
                                    </div>

                                        <div class="row">
                                            <h4 class="mt-16">Equipment</h4>
                                            <div class="col-12">

                                                @foreach($equipment as $item)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="equipment_{{$item->id}}" name="equipment[]" value="{{$item->id}}">
                                                        <label class="form-check-label" for="equipment_{{$item->id}}">{{$item->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="row pt-24">
                                            <div class="col-12">
                                                <label for="note" class="form-label">Note</label>
                                                <textarea class="form-control" name="note" id="note">{{old('note')}}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-12 pt-32">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="p-24 rounded border border-black-40 hp-border-color-dark-80 bg-black-0 hp-bg-color-dark-100">
                            <h4 class="mb-0">Current Location</h4>

                            <div class="row mt-24">
                                <div class="col-12">
                                    <label for="zipcode" class="form-label">
                                        Zip Code
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('zipcode') }}" name="zipcode" id="zipcode">
                                </div>
                            </div>

                            <div class="col-12 mt-24">
                                <label for="location" class="form-label">
                                    Location
                                </label>
                                <input type="text" class="form-control" value="{{ old('location') }}" name="location" id="location" readonly>
                            </div>

                            <div class="col-12 mt-24">
                                <label for="latitude" class="form-label">
                                    Latitude
                                </label>
                                <input type="text" class="form-control" value="{{ old('latitude') }}" name="latitude" id="latitude" readonly>
                            </div>

                            <div class="col-12 mt-24">
                                <label for="longitude" class="form-label">
                                    Longitude
                                </label>
                                <input type="text" class="form-control" value="{{ old('longitude') }}" name="longitude" id="longitude" readonly>
                            </div>

                            <div id="errorMsg" class="alert alert-danger mt-16 p-8" hidden></div>

                            <div class="row mt-16">
                                <div class="col-12 mt-16">
                                    <button id="checkBtn" class="btn btn-primary w-100" onclick="checkZip()">Fill coords</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
@endsection

@push('js')
    <script>
        function checkZip() {

            const api_key = '{{config('app.zipcode_key')}}';
            const zip_code = $('#zipcode').val();

            $('#checkBtn')
                .attr('disabled', true)
                .html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');

            $.ajax({
                method: "GET",
                url: "https://www.zipcodeapi.com/rest/"+api_key+"/info.json/"+zip_code+"/degrees",
                success: (result) => {
                    $('#errorMsg').attr('hidden', 'hidden');
                    $('#location').val(result['city'] + ', ' + result['state']);
                    $('#longitude').val(result['lng']);
                    $('#latitude').val(result['lat']);
                    $('#checkBtn')
                        .attr('disabled', false)
                        .html('Fill coords');
                },
                error: (error) => {
                    $('#location').val('');
                    $('#longitude').val('');
                    $('#latitude').val('');
                    $('#errorMsg')
                        .removeAttr('hidden')
                        .html('Something went wrong...');
                    $('#checkBtn')
                        .attr('disabled', false)
                        .html('Fill coords');
                }
            });
        }

    </script>
@endpush