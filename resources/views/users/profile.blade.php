@extends('layouts.app')

@section('title', 'Profile | Express Delivery PRO' )

@section('content')
    <div class="hp-main-layout-content">
        <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-start">
                            <div class="col hp-flex-none w-auto">
                                <a href="{{route('dashboard.index')}}" class="btn btn-primary w-100">
                                    <i class="ri-arrow-left-s-line remix-icon"></i>
                                    <span>Dashboard</span>
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

                                <div class="col-12">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-12 col-md-6">
                                            <h3>Information</h3>
                                        </div>

                                        <div class="col-12 col-md-6 hp-profile-action-btn text-end">
                                            <a href="#" class="btn btn-ghost btn-primary">Edit</a>
                                        </div>

                                        <div class="col-12 hp-profile-content-list mt-8 pb-0">
                                            <ul>
                                                <li>
                                                    <span class="hp-p1-body">Full Name:</span>
                                                    <span class="mt-0 mt-sm-4 hp-p1-body text-black-100 hp-text-color-dark-0">{{auth()->user()->name}}</span>
                                                </li>
                                                <li class="mt-18">
                                                    <span class="hp-p1-body">Email:</span>
                                                    <span class="mt-0 mt-sm-4 hp-p1-body text-black-100 hp-text-color-dark-0">{{auth()->user()->email}}</span>
                                                </li>
                                                <li class="mt-18">
                                                    <span class="hp-p1-body">Created at:</span>
                                                    <span class="mt-0 mt-sm-4 hp-p1-body text-black-100 hp-text-color-dark-0">{{auth()->user()->created_at->toFormattedDateString()}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection