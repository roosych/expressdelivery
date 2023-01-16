@extends('layouts.app')

@section('title', 'Add Vehicle type - Express Delivery PRO')

@section('content')
    <div class="hp-main-layout-content">
        <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-start">
                            <div class="col hp-flex-none w-auto">
                                <a href="{{route('vehicles.index')}}" class="btn btn-primary w-100">
                                    <i class="ri-arrow-left-s-line remix-icon"></i>
                                    <span>All types</span>
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
                                <h3 class="mb-24 text-black-80 hp-text-color-dark-0">Add Vehicle Type</h3>

                                <form action="{{route('vehicles.store')}}" method="POST">
                                    @csrf
                                    <div class="row g-24">
                                        <div class="col-12 col-md-5">
                                            <label for="name" class="form-label">
                                                <span class="text-danger me-4">*</span>Name
                                            </label>
                                            <input type="text" class="form-control" name="name" id="name" required="">
                                        </div>
                                    </div>


                                    <div class="row mt-16">
{{--                                        <div class="form-check form-switch p-10">--}}
{{--                                            <input type="hidden" name="status" value="0">--}}
{{--                                            <input class="form-check-input" name="status" value="1" type="checkbox" id="status" checked>--}}
{{--                                            <label class="form-check-label" for="status">--}}
{{--                                                <span class="ms-12">Status</span>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
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