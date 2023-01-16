@extends('layouts.app')

@section('title', 'Add Driver - Express Delivery PRO')

@section('content')
    <div class="hp-main-layout-content">
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

            <div class="col-lg-9 col-12">
                <div class="card hp-contact-card mb-32">
                    <div class="row g-32">
                        <div class="col-12">
                            <div class="p-16 p-sm-24">
                                <h3 class="mb-24 text-black-80 hp-text-color-dark-0">Add driver</h3>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{route('driver.store')}}" method="POST">
                                    @csrf
                                    <div class="row g-24">
                                        <div class="col-12 col-md-4">
                                            <label for="fullname" class="form-label">
                                                <span class="text-danger me-4">*</span>Full Name
                                            </label>
                                            <input type="text" class="form-control" name="fullname" id="fullname" required="">
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <label for="phone" class="form-label">
                                                <span class="text-danger me-4">*</span>Phone
                                            </label>
                                            <input type="text" class="form-control" name="phone" id="phone" required="">
                                        </div>

                                    </div>

                                    <div class="row py-24">
                                        <div class="col-12 col-md-4">
                                            <label for="vehicle_type_id" class="form-label"><span class="text-danger me-4">*</span>Vehicle Type</label>
                                            <select name="vehicle_type_id" id="vehicle_type_id" class="form-select">
                                                <option value="">Choose</option>
                                                @foreach($vehicle_types as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <label for="capacity" class="form-label">
                                                Capacity
                                            </label>
                                            <input type="text" class="form-control" name="capacity" id="capacity" required="">
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <label for="dimension" class="form-label">
                                                Dimension
                                            </label>
                                            <input type="text" class="form-control" name="dimension" id="dimension" required="">
                                        </div>
                                    </div>

                                    <div class="row py-24 d-none">
                                        <div class="col-12 col-md-4">
                                            <label for="location" class="form-label">
                                                Location
                                            </label>
                                            <input type="text" class="form-control" name="location" id="location">
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <label for="latitude" class="form-label">
                                                Latitude
                                            </label>
                                            <input type="text" class="form-control" name="latitude" id="latitude">
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <label for="longitude" class="form-label">
                                                Longitude
                                            </label>
                                            <input type="text" class="form-control" name="longitude" id="longitude">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-check form-switch p-10">
                                            <input type="hidden" name="service" value="0">
                                            <input class="form-check-input" name="service" type="checkbox" value="1" id="service">
                                            <label class="form-check-label" for="service">
                                                <span class="ms-12">On service</span>
                                            </label>
                                        </div>

                                        <div class="form-check form-switch p-10">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input" name="status" type="checkbox" value="1" id="status" checked>
                                            <label class="form-check-label" for="status">
                                                <span class="ms-12">Status</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row pt-24">
                                        <div class="col-12">
                                            <label for="note" class="form-label">Note</label>
                                            <textarea class="form-control" name="note" id="note"></textarea>
                                        </div>
                                    </div>


                                    <div class="col-12 pt-32">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection