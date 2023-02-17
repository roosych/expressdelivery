@extends('layouts.app-horizontal')

@section('title', 'Add Equipment - Express Delivery PRO')

@section('content')
    <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-start">
                            <div class="col hp-flex-none w-auto">
                                <a href="{{route('equipment.index')}}" class="btn btn-primary w-100">
                                    <i class="ri-arrow-left-s-line remix-icon"></i>
                                    <span>All equipment</span>
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
                                <h4 class="mb-24">Add Equipment</h4>

                                <form action="{{route('equipment.store')}}" method="POST">
                                    @csrf
                                    <div class="row g-24">
                                        <div class="col-12 col-md-5">
                                            <label for="name" class="form-label">
                                                <span class="text-danger me-4">*</span>Name
                                            </label>
                                            <input type="text" class="form-control" name="name" id="name" required="">
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
@endsection