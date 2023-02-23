@extends('layouts.app-horizontal')

@section('title', 'Users - Express Delivery PRO')

@section('content')
        <div class="row mb-32 gy-32">
            @if(auth()->user()->role == 10)
                <div class="col-12">
                    <div class="row justify-content-between gy-32">

                        <div class="col-12">
                            <div class="row g-16 align-items-center justify-content-end">
                                <div class="col hp-flex-none w-auto">
                                    <a href="{{route('user.add')}}" class="btn btn-primary w-100">
                                        <i class="ri-add-line remix-icon"></i>
                                        <span>Add New User</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <div class="card hp-contact-card mb-32">
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <div class="px-12">
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                            </div>
                            <table class="table align-middle table-hover table-borderless">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($users as $user)

                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role == 10 ? 'Admin' : 'Manager'}}</td>
                                        <td>
                                            @if(auth()->user()->role == 10 and auth()->id() != $user->id)
                                                <div class="form-check form-switch text-center">
                                                    <input class="form-check-input" name="status" type="checkbox" data-id="{{$user->id}}" id="{{$user->id}}" {{$user->status ? 'checked' : ''}}
                                                            {{auth()->user()->role == 9 ? 'disabled' : ''}}
                                                    >
                                                    <label class="form-check-label" for="{{$user->id}}"></label>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if(auth()->user()->role == 10 and auth()->id() != $user->id)
                                                <a href="{{route('user.edit', $user)}}">
                                                    <i class="iconly-Light-EditSquare hp-cursor-pointer hp-transition hp-hover-text-color-warning-1 text-black-80" style="font-size: 24px;margin-right: 10px;"></i>
                                                </a>

                                                <a href="{{route('user.delete', $user->id)}}" onclick="confirm('Are you sure?')">
                                                    <i class="iconly-Light-Delete hp-cursor-pointer hp-transition hp-hover-text-color-danger-1 text-black-80" style="font-size: 24px;"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="container">
                            {{--{{$users->links()}}--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection

@push('js')
<script>
    $(".form-check-input").change(function() {
        let token = $('meta[name="csrf-token"]').attr('content');
        let status;
        this.checked ? status = 1 : status = 0;

        $.post('{{route('user.status')}}', {id: this.id, status: status, _token: token});
    });
</script>
@endpush