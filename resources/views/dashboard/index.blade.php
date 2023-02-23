@extends('layouts.app-horizontal')

@section('title', 'Dashboard - Express Delivery PRO')

@section('content')
    <div class="col-12">
        <div class="row align-items-center justify-content-between g-24">
            <div class="col-12 col-md-6">
                <h3>Welcome back, {{auth()->user()->name}} 👋</h3>
                <p class="hp-p1-body mb-0">Your current analytics are here</p>
            </div>

        </div>
    </div>

    <div class="col-12">
        <div class="row g-32 mb-32">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-16">
                            <div class="col-6 hp-flex-none w-auto">
                                <div class="avatar-item d-flex align-items-center justify-content-center avatar-lg hp-bg-dark-80 rounded-3">
                                    <i class="hp-text-color-dark-0 ri-2x ri-steering-2-line" style="font-size: 24px;"></i>
                                </div>
                            </div>

                            <div class="col">
                                <h3 class="mb-4 mt-8">{{$drivers->count()}}</h3>
                                <p class="hp-p1-body mb-0 text-black-80 hp-text-color-dark-30">Total drivers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-16">
                            <div class="col-6 hp-flex-none w-auto">
                                <div class="avatar-item d-flex align-items-center justify-content-center avatar-lg hp-bg-dark-80 rounded-3">
                                    <i class="hp-text-color-dark-0 ri-2x ri-emotion-line" style="font-size: 24px;"></i>
                                </div>
                            </div>

                            <div class="col">
                                <h3 class="mb-4 mt-8">{{$available_now}}</h3>
                                <p class="hp-p1-body mb-0 text-black-80 hp-text-color-dark-30">Available now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-16">
                            <div class="col-6 hp-flex-none w-auto">
                                <div class="avatar-item d-flex align-items-center justify-content-center avatar-lg hp-bg-dark-80 rounded-3">
                                    <i class="hp-text-color-dark-0 ri-2x ri-user-3-line" style="font-size: 24px;"></i>
                                </div>
                            </div>

                            <div class="col">
                                <h3 class="mb-4 mt-8">{{$users}}</h3>
                                <p class="hp-p1-body mb-0 text-black-80 hp-text-color-dark-30">Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-16">
                            <div class="col-6 hp-flex-none w-auto">
                                <div class="avatar-item d-flex align-items-center justify-content-center avatar-lg hp-bg-dark-80 rounded-3">
                                    <i class="hp-text-color-dark-0 ri-2x ri-truck-line" style="font-size: 24px;"></i>
                                </div>
                            </div>

                            <div class="col">
                                <h3 class="mb-4 mt-8">{{$vehicle_types}}</h3>
                                <p class="hp-p1-body mb-0 text-black-80 hp-text-color-dark-30">Vehicle types</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection