@extends('layouts.app-horizontal')

@section('title', 'Edit Owner - Express Delivery PRO')

@section('content')
    <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-start">
                            <div class="col hp-flex-none w-auto">
                                <a href="{{route('owner.index')}}" class="btn btn-primary w-100">
                                    <i class="ri-arrow-left-s-line remix-icon"></i>
                                    <span>All owners</span>
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
                                <h4 class="mb-24">Edit "{{$owner->name}}"</h4>

                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{route('owner.update', $owner->id)}}" method="POST">
                                    @csrf

                                    <div class="row g-24">
                                        <div class="col-12 col-md-4">
                                            <label for="name" class="form-label">
                                                <span class="text-danger me-4">*</span>Name
                                            </label>
                                            <input type="text" class="form-control" value="{{$owner->name}}" name="name" id="name" required="">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="phone" class="form-label">
                                                <span class="text-danger me-4">*</span>Phone
                                            </label>
                                            <input type="text" class="form-control" value="{{$owner->phone}}" name="phone" id="phone" required="">
                                        </div>
                                    </div>


                                    <div class="row mt-16">
                                        <div class="form-check form-switch p-10">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input" name="status" value="1" type="checkbox" id="status"  {{$owner->status ? 'checked' : ''}}>
                                            <label class="form-check-label" for="status">
                                                <span class="ms-12">Status</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 pt-32">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection