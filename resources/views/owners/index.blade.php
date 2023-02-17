@extends('layouts.app-horizontal')

@section('title', 'Owners - Express Delivery PRO')

@section('content')
    <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-end">

                            <div class="col hp-flex-none w-auto">
                                <a href="{{route('owner.add')}}" class="btn btn-primary w-100">
                                    <i class="ri-add-line remix-icon"></i>
                                    <span>Add Owner</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card hp-contact-card mb-32">
                    <div class="card-body px-0">
                        <div class="px-12">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle table-hover table-borderless">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Drivers</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($owners as $type)
                                <tr>
                                    <td>{{$type->id}}</td>
                                    <td>{{$type->name}}</td>
                                    <td>{{$type->phone}}</td>
                                    <td>{{$type->drivers->count()}}</td>
                                    <td class="text-end">
                                        <div class="form-check form-switch text-center">
                                            <input class="form-check-input" type="checkbox"  data-id="{{$type->id}}" id="{{$type->id}}" {{$type->status ? 'checked' : ''}}>
                                            <label class="form-check-label" for="{{$type->id}}"></label>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{route('owner.edit', $type->id)}}">
                                            <i class="iconly-Light-EditSquare hp-cursor-pointer hp-transition hp-hover-text-color-warning-1 text-black-80" style="font-size: 24px;margin-right: 10px;"></i>
                                        </a>
                                        <a href="#">
                                            <i class="iconly-Light-Delete hp-cursor-pointer hp-transition hp-hover-text-color-danger-1 text-black-80" style="font-size: 24px;"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
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

            $.post('{{route('owner.status')}}', {id: this.id, status: status, _token: token});
        });
    </script>
@endpush