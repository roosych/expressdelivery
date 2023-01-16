@extends('layouts.app')

@section('title', 'Drivers - Express Delivery PRO')

@section('content')
    <div class="hp-main-layout-content">
        <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-end">
{{--                            <div class="col-12 col-md-6 col-xl-4">--}}
{{--                                <div class="input-group align-items-center">--}}
{{--                                            <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">--}}
{{--                                                <i class="iconly-Curved-User text-black-80" style="font-size: 16px;"></i>--}}
{{--                                            </span>--}}
{{--                                    <input type="text" class="form-control border-start-0 ps-8" placeholder="Search">--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="col hp-flex-none w-auto">
                                <a href="{{route('driver.add')}}" class="btn btn-primary w-100">
                                    <i class="ri-add-line remix-icon"></i>
                                    <span>Add New Driver</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card hp-contact-card mb-32">
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover table-borderless">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Vehicle</th>
                                    <th>Dimension</th>
                                    <th>Capacity</th>
                                    <th>Service</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($drivers as $driver)
                                <tr>
                                    <td>{{$driver->fullname}}</td>
                                    <td>{{$driver->phone}}</td>
                                    <td>{{$driver->vehicle_type->name}}</td>
                                    <td>{{$driver->dimension}}</td>
                                    <td>{{$driver->capacity}}</td>
                                    <td>
                                        <div class="form-check form-switch text-center">
                                            <input class="form-check-input" name="service" type="checkbox"  data-id="{{$driver->id}}" id="{{$driver->id}}" {{$driver->service ? 'checked' : ''}}>
                                            <label class="form-check-label" for="{{$driver->id}}"></label>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        @if(!is_null($driver->note))
                                            <div class="btn-group">
                                                <a  tabindex="0"
                                                    data-container="body"
                                                    data-toggle="popover"
                                                    data-placement="top"
                                                    data-trigger="focus"
                                                    title="{{$driver->note}}"
                                                >
                                                    <i class="iconly-Bold-Paper hp-cursor-pointer hp-transition hp-hover-text-color-warning-1 text-warning" style="font-size: 24px;margin-right: 10px;"></i>
                                                </a>
                                            @endif

                                                <a href="{{route('driver.edit', $driver)}}">
                                                    <i class="iconly-Light-EditSquare hp-cursor-pointer hp-transition hp-hover-text-color-primary-1 text-black-80" style="font-size: 24px;margin-right: 10px;"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="iconly-Light-Delete hp-cursor-pointer hp-transition hp-hover-text-color-danger-1 text-black-80" style="font-size: 24px;"></i>
                                                </a>
                                            </div>
                                    </td>
                                </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="container">
                            {{$drivers->links()}}
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('[data-toggle="popover"]').popover()
        });

        $(".form-check-input").change(function() {
            let token = $('meta[name="csrf-token"]').attr('content');
            let service;
            this.checked ? service = 1 : service = 0;

            $.post('{{route('driver.status')}}', {id: this.id, service: service, _token: token});
        });
    </script>
@endpush