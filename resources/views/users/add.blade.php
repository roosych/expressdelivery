@extends('layouts.app')

@section('title', 'Add User - Express Delivery PRO')

@section('content')
    <div class="hp-main-layout-content">
        <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-start">
                            <div class="col hp-flex-none w-auto">
                                <a href="{{route('users.index')}}" class="btn btn-primary w-100">
                                    <i class="ri-arrow-left-s-line remix-icon"></i>
                                    <span>All users</span>
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
                                <h3 class="mb-24 text-black-80 hp-text-color-dark-0">Add User</h3>

                                <form action="{{route('user.store')}}" method="POST">
                                    @csrf
                                    <div class="row g-24">
                                        <div class="col-12 col-md-4">
                                            <label for="name" class="form-label">
                                                <span class="text-danger me-4">*</span>Name
                                            </label>
                                            <input type="text" class="form-control" name="name" id="name" required="">
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <label for="email" class="form-label">
                                                <span class="text-danger me-4">*</span>Email
                                            </label>
                                            <input type="text" class="form-control" name="email" id="email" required="">
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <label for="role" class="form-label"><span class="text-danger me-4">*</span>Role</label>
                                            <select name="role" id="role" class="form-select">
                                                //не из базы приходит поэтому используем ключ - значение
                                                @foreach($roles as $id => $role)
                                                    <option value="{{$id}}">{{$role}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row py-24">
                                        <div class="col-12 col-md-4">
                                            <label for="password" class="form-label">
                                                <span class="text-danger me-4">*</span>Password
                                            </label>
                                            <input type="password" class="form-control" name="password" id="password" required="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-check form-switch p-10">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input" name="status" type="checkbox" value="1" id="status" checked>
                                            <label class="form-check-label" for="status">
                                                <span class="ms-12">Status</span>
                                            </label>
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