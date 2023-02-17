@extends('layouts.app-horizontal')

@section('title', 'Drivers - Express Delivery PRO')

@section('content')
        <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-end">
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
                    <div class="card-body py-24">
                        <div class="px-12">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive overflow-hidden">
                            <table id="example" class="display table align-middle table-hover table-borderless">
                                <thead>
                                <tr>
                                    <th width="70">ID</th>
                                    <th width="50">Status</th>
                                    <th>Name</th>
{{--
                                    <th>Phone</th>
--}}
                                    <th>Location</th>
                                    <th>Vehicle</th>
                                    <th>Dimension</th>
                                    <th>Capacity</th>
                                    <th>Note</th>
                                    <th></th>
                                </tr>

                                <tr>
                                    <th class="input">ID</th>
                                    <th class="input" style="visibility: hidden;"></th>
                                    <th class="input">Name</th>
{{--
                                    <th class="input">Phone</th>
--}}
                                    <th class="input">Location</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                                </thead>

                                <tbody>

                                @foreach($drivers as $driver)

                                    <tr>
                                        <td>
                                            {{$driver->id}}
                                            @if($driver->dnu)
                                                <span class="badge hp-text-color-black-100 hp-bg-warning-1 px-8 border-0">
                                                    DNU
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-check form-switch text-center">
                                                <input class="form-check-input" name="service" type="checkbox"  data-id="{{$driver->id}}" id="{{$driver->id}}" {{$driver->service ? 'checked' : ''}}>
                                                <label class="form-check-label" for="{{$driver->id}}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            {{$driver->fullname}}
                                            @if($driver->owner)
                                            <br><b>Owner:</b> {{$driver->owner->id}}
                                            @endif
                                        </td>
{{--
                                        <td>{{$driver->phone}}</td>
--}}
                                        <td>{{$driver->location}}, {{$driver->zipcode}}</td>
                                        <td>{{$driver->vehicle_type->name}}</td>
                                        <td>{{$driver->dimension}}</td>
                                        <td>{{$driver->capacity}}</td>
                                        <td>
                                            {{$driver->note}}
                                        </td>
                                        <td class="text-end">
{{--                                            @if(!is_null($driver->note))
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
                                            @endif--}}
                                                <div class="btn-group">
                                                    <a href="{{route('driver.images', $driver)}}">
                                                        <i class="iconly-Light-Camera hp-cursor-pointer hp-transition hp-hover-text-color-primary-1 text-black-80" style="font-size: 24px;margin-right: 10px;"></i>
                                                    </a>
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

                    </div>
                </div>
            </div>
        </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <style>
        .dataTables_filter, .dataTables_length {
            display: none;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // $(document).ready(function () {
        //     $('#example').DataTable({
        //         "iDisplayLength": 25,
        //         "columnDefs": [
        //             { "orderable": false, "targets": [1, 3, 4, 6, 7] }
        //         ]
        //     });
        // });
    </script>

    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example thead th.input').each( function () {
                let title = $('#example thead th.input').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control" placeholder=" '+title+'" />' );
            } );

            // DataTable
            let table = $('#example').DataTable({
                        "iDisplayLength": 100,
                        "ordering": false,
                    });

            // Apply the search
            table.columns().every( function () {
                let that = this;

                $( 'input', this.header() ).on( 'keyup change', function () {
                    that
                        .search( this.value )
                        .draw();
                } );
            } );
        } );
    </script>

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