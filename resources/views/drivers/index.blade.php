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
                                    <th width="100">Availability</th>
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
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="service" type="checkbox"  data-id="{{$driver->id}}" id="{{$driver->id}}" {{$driver->service ? 'checked' : ''}}>
                                                <label class="form-check-label" for="{{$driver->id}}"></label>
                                            </div>
                                            @if($driver->service == 0 and $driver->future_datetime > now())
                                                <span class="badge_{{$driver->id}} badge hp-text-color-black-100 hp-bg-danger-3 mt-4 px-8 border-0">
                                                    {{ \Carbon\Carbon::parse($driver->future_datetime)->format('M d,')}}<br>
                                                    {{ \Carbon\Carbon::parse($driver->future_datetime)->format('g:i A')}}
                                                </span>

                                            @endif
                                        </td>
                                        <td>
                                            {{$driver->fullname}}
                                            @if($driver->owner)
                                            <br><b>Owner:</b> {{$driver->owner->id}} - {{$driver->owner->name}}
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
                                                <div class="btn-group">
                                                    <a href="{{route('driver.images', $driver)}}">
                                                        <i class="iconly-Light-Camera hp-cursor-pointer hp-transition hp-hover-text-color-primary-1 text-black-80" style="font-size: 24px;margin-right: 10px;"></i>
                                                    </a>
                                                    <a href="{{route('driver.edit', $driver)}}">
                                                        <i class="iconly-Light-EditSquare hp-cursor-pointer hp-transition hp-hover-text-color-primary-1 text-black-80" style="font-size: 24px;margin-right: 10px;"></i>
                                                    </a>
                                                    {{--<a href="#">
                                                        <i class="iconly-Light-Delete hp-cursor-pointer hp-transition hp-hover-text-color-danger-1 text-black-80" style="font-size: 24px;"></i>
                                                    </a>--}}
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

@include('parts.future_available_modal')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.datetimepicker.css')}}">
    <style>
        .dataTables_filter, .dataTables_length {
            display: none;
        }
    </style>

@endpush

@push('js')
    <script type="text/javascript" src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.datetimepicker.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#example thead th.input').each( function () {
                let title = $('#example thead th.input').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control" placeholder=" '+title+'" />' );
            } );

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
        $("#future_date").datetimepicker({
            minDate: 0,
            inline: true,
            format: 'Y-m-d H:i:s',
            defaultDate: new Date(),
        });
    </script>
    <script>
        function checkZip() {

            const api_key = '{{config('app.zipcode_key')}}';
            const zip_code = $('#zipcode').val();

            $('#checkBtn')
                .attr('disabled', true)
                .html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');

            $.ajax({
                method: "GET",
                url: "https://www.zipcodeapi.com/rest/"+api_key+"/info.json/"+zip_code+"/degrees",
                success: (result) => {
                    $('#location').val(result['city'] + ', ' + result['state']);
                    $('#longitude').val(result['lng']);
                    $('#latitude').val(result['lat']);
                    $('#checkBtn')
                        .attr('disabled', false)
                        .html('Fill coords');
                    $('#errorMsg')
                        .attr('hidden', 'hidden')
                    $('#setFutureAvaBtn').removeAttr('hidden',);
                },
                error: (error) => {
                    $('#location').val('');
                    $('#longitude').val('');
                    $('#latitude').val('');
                    $('#setFutureAvaBtn').attr('hidden', 'hidden');
                    $('#errorMsg')
                        .removeAttr('hidden')
                        .html('Something went wrong...');
                    $('#checkBtn')
                        .attr('disabled', false)
                        .html('Fill coords');
                }
            });
        }
    </script>
    <script>
        $(".form-check-input").change(function() {

            let token = $('meta[name="csrf-token"]').attr('content');
            let id = this.id;
            let url = "{{route('driver.status')}}";

            if (this.checked) {
                //set status true if switch on
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {_token: token, id: id, service: 1,},
                    success: (response) => {
                        if (response.msg === 'success'){
                            $('.badge_' + id).html('');
                        }
                    }
                });
            } else {
                let modal = $('#future_ava_modal');
                modal.modal('show');

                // let data = new FormData();
                // console.log(data);

                $('#setFutureAvaBtn').click(function () {
                    let form = $('#futureAvaForm');
                    $(this)
                        .attr('disabled', true)
                        .html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');

                    // convert serializeArray to object
                    let data = {'_token': token};
                    form.serializeArray().map(function(x){data[x.name] = x.value;});

                    //console.log(data);

                    $.ajax({
                        method: 'POST',
                        url: '{{route('driver.availability', '')}}' + "/" + id,
                        data: data,
                        success: (response) => {
                            console.log(response);
                            modal.modal('hide');
                            location.reload();

                            $(this)
                                .attr('disabled', false)
                                .html('Save future availability data');
                        },
                        error: (response) => {
                            console.log(response);
                            $('#setFutureAvaBtn')
                                .attr('disabled', false)
                                .html('Save future availability data');
                            $('#avaFormError').removeAttr('hidden');
                        }
                    });
                });

                // set status false when modal closed
                modal.on('hidden.bs.modal', function () {
                    $.ajax({
                        method: 'POST',
                        url: url,
                        data: {_token: token, id: id, service: 0,},
                        success: (response) => {
                            //console.log(response);
                            if (response.msg === 'success'){
                                console.log('modal close and status = 0')
                            }
                        }
                    });
                })
            }


        });
    </script>
@endpush
