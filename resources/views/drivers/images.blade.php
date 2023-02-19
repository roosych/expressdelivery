@extends('layouts.app-horizontal')

@section('title', 'Car Images - Express Delivery PRO')

@section('content')
    <div class="row mb-32 gy-32">
            <div class="col-12">
                <div class="row justify-content-between gy-32">

                    <div class="col-12">
                        <div class="row g-16 align-items-center justify-content-start">
                            <div class="col hp-flex-none w-auto">
                                <a href="{{ url()->previous() }}" class="btn btn-primary w-100">
                                    <i class="ri-arrow-left-s-line remix-icon"></i>
                                    <span>Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{route('image.store', $driver)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card hp-contact-card mb-32 rounded border border-black-40 hp-border-color-dark-80 bg-black-0 hp-bg-color-dark-100">
                            <div class="row g-32">
                                <div class="col-12">
                                    <div class="p-16 p-sm-24">
                                        <h4 class="mb-24">"{{$driver->fullname}}" car photos</h4>

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

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <input type="file" name="images[]" class="form-control" multiple>
                                                <p class="mt-10 mb-32">max: 2 MB (jpg, jpeg, png)</p>
                                            </div>

                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </div>


                                        <div class="row">
                                            @foreach($driver->images as $image)
                                                <div class="col-lg-2">
                                                    <div class="card rounded-1">
                                                        <img src="/storage/images/drivers/{{$driver->id}}/{{$image->filename}}" alt="" class="img-fluid">
                                                        <div class="text-center mb-8 mt-8">
                                                            <a href="{{route('image.delete', [$driver, $image])}}" onclick="confirm('Are you sure?')" class="btn btn-sm btn-danger delete_image" data-id="{{$image->id}}">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
@endsection

{{--@foreach($equipment as $item)

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="equipment_{{$item->id}}" name="equipment[]" value="{{$item->id}}"
                {{
                is_array($driver->equipment->pluck('id')->toArray())

                 &&

                 in_array($item->id, $driver->equipment->pluck('id')->toArray())

                  ? 'checked' : ''}}
        >
        <label class="form-check-label" for="equipment_{{$item->id}}">{{$item->name}}</label>
    </div>
@endforeach--}}
@push('js')
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
                },
                error: (error) => {
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
@endpush
