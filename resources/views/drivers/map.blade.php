
@extends('layouts.app-horizontal')

@section('title', 'Map - Express Delivery PRO')

@section('content')
    <div class="row mb-32 gy-32">
            <div class="col-12">
                <div id="wrapper">

                    <style>
                        .results_block {
                            height: 600px;
                            overflow-y: scroll;
                        }
                        .driver_card__title {
                            font-size: 11px;
                            font-weight: 600;
                            margin-bottom: 5px;
                        }
                        .driver_card__text {
                            font-size: 11px;
                            margin-bottom: 5px;
                        }
                    </style>

                    <div class="row">
                        <div class="col-lg-4 results_block">
                            <div class="">
                                <div class="mx-8">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="input-group">
                                                <div class="col-12">
                                                    <div id="findbox"></div>
                                                </div>

                                            </div>


                                            <div class="input-group mt-24">
                                                <div class="col-4">
                                                    <select id="miles" class="form-select mb-8" aria-label="Radius">
                                                        <option value='150'>150 miles</option>
                                                        <option value='200'>200 miles</option>
                                                        <option value='300' selected>300 miles</option>
                                                        <option value='600'>600 miles</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="drivers_list"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 p-0">
                            <div id="map"></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
@endsection
<style>
    #map {
        width: 100%;
        height: 600px;
    }
    .offcanvas-end {
        width: 40% !important;
    }
    .geocoder-control-input {
        width: 100px;
    }
</style>
@push('css')
    <link rel="stylesheet" href="{{asset('assets/css/leaflet.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/esri-leaflet-geocoder.css')}}">
@endpush

@push('js')
    <script src="{{asset('assets/js/leaflet.js')}}"></script>
    <script src="{{asset('assets/js/esri-leaflet.js')}}"></script>
    <script src="{{asset('assets/js/esri-leaflet-geocoder.js')}}"></script>


    <script>
        let url = '{{url('/dashboard/drivers/getalldrivers')}}';
        let theMarker;
        let theCircle;
        let geojsonLayer;

        let map = L.map('map').setView([39.0, -98.26], 4);

        let searchControl = L.esri.Geocoding.geosearch({
            zoomToResult: false,
            collapseAfterResult: false,
            expanded: true,
        }).addTo(map);

        document.getElementById('findbox').appendChild(
            document.querySelector(".geocoder-control")
        );

        console.log(searchControl);

        let results = L.layerGroup().addTo(map);

        searchControl.on('results', function (data) {
            results.clearLayers();

            ProcessClick(data.results[0].latlng.lat, data.results[0].latlng.lng);
            //results.addLayer(L.marker(data.results[i].latlng)); // add marker

            //console.log(L.marker(data.results[0].latlng.lat, data.results[0].latlng.lng));

            //results.addLayer(L.marker(data.results[i].latlng)); // add marker

            results.clearLayers();
        });

        //https: also suppported.
        let cartocdn = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="http://cartodb.com/attributions">CartoDB</a>',
            maxZoom: 16,
            tileSize: 512,
            zoomOffset: -1,
        }).addTo(map);

        let mapbox = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/dark-v10/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicnVzbGFuaWFzIiwiYSI6ImNsZHdzbjA1NTA5ZXkzb3AweXUzcWhmbHAifQ.XW1kq9eYfqPlM_SAfVp2Dw', {
            attribution: '&copy; <a href="http://cartodb.com/attributions">CartoDB</a>',
            maxZoom: 16,
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoicnVzbGFuaWFzIiwiYSI6ImNsZHdzbjA1NTA5ZXkzb3AweXUzcWhmbHAifQ.XW1kq9eYfqPlM_SAfVp2Dw'
        }).addTo(map);

        //////////////////////////
        var baseMaps = {
            "CartoDB Dark": cartocdn,
            "Mapbox Dark": mapbox,
        };

        var overlayMaps = {};
        //Add layer control
        L.control.layers(baseMaps, overlayMaps).addTo(map);
        //////////////////////

        // Set function for color ramp
        function getColor(service){
            return service ? '#f32424' : '#27f1ea';
        }

        // Set style function that sets fill color property
        function style(feature) {
            return {
                fillColor: setColor(feature.properties.service),
                fillOpacity: 0.5,
                weight: 2,
                opacity: 1,
                color: '#ffffff',
                dashArray: '3'
            };
        }
        let highlight = {
            'fillColor': 'yellow',
            'weight': 2,
            'opacity': 1
        };

        let carDriver;

        // Get GeoJSON data and create features.
        $.getJSON(url, function(data) {
            //console.log(data);
            carDriver = L.geoJson(data, {
                pointToLayer: function(feature, latlng) {
                    return L.circleMarker(latlng, {
                        radius:4,
                        opacity: .5,
                        color:getColor(feature.properties.service),
                        fillColor:  getColor(feature.properties.service),
                        fillOpacity: 0.8

                    });  //.bindTooltip(feature.properties.fullname);
                },
                onEachFeature: function (feature, layer) {
                    layer._leaflet_id = feature.properties.fullname;

                    let service = '';
                    feature.properties.service ? service = '<span style="color: #f32424">On service</span>' : service = '<span style="color: #27f1ea">Available</span>';

                    let popupContent = "<div style='font-size: 14px'>" +
                        "<span style='font-size:16px'><b>" + feature.properties.fullname + "</b></span>" + "</br>" +
                        "Phone: " + feature.properties.phone + "</br>" +
                        "Location: " + feature.properties.location + ', ' + feature.properties.zipcode + "</br>" +
                        "Vehicle: " + feature.properties.vehicle_type + "</br>" +
                        "Dimension: " + feature.properties.dimension + "</br>" +
                        "Capacity: " + feature.properties.capacity + "</br>" +
                        service + "</br>" +
                        "<hr>" +
                        feature.properties.note + "</br>" +
                        '</div>' ;

                    if (feature.properties && feature.properties.popupContent) {
                        popupContent += feature.properties.popupContent;
                    }
                    layer.bindPopup(popupContent);

                }
            }).addTo(map);
        });

        map.on('click',function(e){
            lat = e.latlng.lat;
            lon = e.latlng.lng;
            ProcessClick(lat,lon)
        });

        function dropPin(lat, lon) {
            map.panTo([lat,lon]);
            ProcessClick(lat,lon)
        }

        //marker icon
        let flag = L.icon({
            iconUrl: '{{asset('assets/img/flag_marker.png')}}',
            iconSize:     [48, 48], // size of the icon
            iconAnchor:   [22, 48], // point of the icon which will correspond to marker's location
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        function ProcessClick(lat,lon){
            //Clear existing marker, circle, and selected points if selecting new points
            if (theCircle !== undefined) {
                map.removeLayer(theCircle);
            }
            if (theMarker !== undefined) {
                map.removeLayer(theMarker);
            }
            if (geojsonLayer !== undefined) {
                map.removeLayer(geojsonLayer);
            }

            //Add a marker to show where you clicked.
            theMarker = L.marker([lat,lon], {icon: flag}).addTo(map);
            SelectPoints(lat,lon);
        }

        let selPts = [];

        function SelectPoints(lat,lon){
            let dist = document.getElementById("miles").value;

            let xy = [lat,lon];  //center point of circle

            let theRadius = parseInt(dist) * 1609.34 ; //1609.34 meters in a mile
            //dist is a string so it's convered to an Interger.

            selPts.length = 0;  //Reset the array if selecting new points

            carDriver.eachLayer(function (layer) {
                // Lat, long of current point as it loops through.
                let layer_lat_long = layer.getLatLng();

                // Distance from our circle marker To current point in meters
                let distance_from_centerPoint = layer_lat_long.distanceTo(xy);

                // See if meters is within radius, add the to array
                if (distance_from_centerPoint <= theRadius) {
                    selPts.push(layer.feature);
                }
            });


            // draw circle to see the selection area
            // theCircle = L.circle(xy, theRadius , {   /// Number is in Meters
            //     color: 'orange',
            //     fillOpacity: 0,
            //     opacity: 1
            // }).addTo(map);

            //Symbolize the Selected Points
            geojsonLayer = L.geoJson(selPts, {

                pointToLayer: function(feature, latlng) {
                    return L.circleMarker(latlng, {
                        radius: 2, //expressed in pixels circle size
                        color: "#39D01A",
                        stroke: true,
                        weight: 7,		//outline width  increased width to look like a filled circle.
                        fillOpcaity: 1
                    });
                }
            });
            //Add selected points back into map as green circles.
            map.addLayer(geojsonLayer);

            //Take array of features and make a GeoJSON feature collection
            let GeoJS = { type: "FeatureCollection",  features: selPts   };

            //Show number of selected features.
            //console.log(GeoJS.features.length +" Selected features");

            // show selected GEOJSON data in console
            //console.log(JSON.stringify(GeoJS));

            //////////////////////////////////////////

            //Clean up prior records
            //$("#myTable tr").remove();


            let driverList = document.querySelector('.drivers_list');


            driverList.innerHTML = '';

            for (let i = 0; i < selPts.length; i++) {

                // Distance between marker and driver in miles
                let toDriver = [parseFloat(selPts[i].properties.latitude), parseFloat(selPts[i].properties.longitude)];
                let distance = map.distance(toDriver, xy);
                let miles_to_driver = Math.round((distance.toFixed(0)/1000) / 1.609);

                let equip = '';

                for (let j = 0; j < selPts[i].properties.equipments.length; j++)
                {
                    equip += '<span class="badge hp-text-color-black-100 hp-bg-info-3 px-8 me-4 border-0">'+ selPts[i].properties.equipments[j] +'</span>';
                }

                driverList.innerHTML += '<div class="card hp-contact-card mb-16 p-16 rounded border border-black-40 hp-border-color-dark-80 bg-black-0 hp-bg-color-dark-100">\n' +
                    '<div class="c">\n' +
                    '<div class="row">\n' +
                    '<div class="col-12">\n' +
                    '<div class="row align-items-start justify-content-between">\n' +
                    '<div class="driver_card" data-id="' + selPts[i].properties.id + '" data-name="' + selPts[i].properties.fullname + '"><h5 class=" hp-cursor-pointer mb-8">'+selPts[i].properties.id + ' ' + selPts[i].properties.fullname +'</h5></div>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '\n' +
                    '<div class="col-12">\n' +
                    '<div class="row g-16 justify-content-between">\n' +
                    '<div class="col-12">\n' +
                    '<div class="row justify-content-between">\n' +
                    '<div class="col hp-flex-none w-auto">\n' +
                    '<div class="row g-8 ">\n' +
                    '<div class="col hp-flex-none w-auto">\n' +
                    '<p class="driver_card__title">Location:</p>\n' +
                    '<p class="driver_card__title">Dimensions:</p>\n' +
                    '<p class="driver_card__title">Capacity:</p>\n' +
                    '<p class="driver_card__title">Status:</p>\n' +
                    '<p class="driver_card__title">Equipment:</p>\n' +
                    '<p class="driver_card__title">Note:</p>\n' +
                    '</div>\n' +
                    '\n' +
                    '<div class="col hp-flex-none w-auto px-0">\n' +
                    '<p class="driver_card__text">'+ selPts[i].properties.location +'</p>\n' +
                    '<p class="driver_card__text">'+ selPts[i].properties.dimension +'</p>\n' +
                    '<p class="driver_card__text">'+ selPts[i].properties.capacity +'</p>\n' +
                    '<p class="driver_card__text">Resident</p>\n' +
                    '<p class="driver_card__text"><span class="text-primary">'+ equip +'</span></p>\n' +
                    '<p class="driver_card__text">'+ selPts[i].properties.note +'</p>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '\n' +
                    '<div class="col hp-flex-none w-auto text-center">\n' +
                    '<h5>'+ miles_to_driver + ' mi' +'</h5>\n' +
                    '<p class="hp-p1-body"><span class="badge hp-text-color-black-100 hp-bg-success-3 px-8 border-0">'+ selPts[i].properties.vehicle_type +'</span></p>\n' +
                    '<a href="#" class="photo-icon" data-id="' + selPts[i].properties.id + '" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">\n' +
                    '<i class="hp-text-color-dark-0 iconly-Light-Camera"></i>\n' +
                    '</a>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '\n' +
                    '</div>\n';

                $('.photo-icon').click(function () {
                    let driver = $(this).data('id');
                    let url = "{{route('driver.getImages', '')}}" + "/" + driver;
                    let photosBlock = document.querySelector('.car-photos');
                    photosBlock.innerHTML = '<div class="text-center">\n' +
                        '    <div class="spinner-border" role="status">\n' +
                        '        <span class="visually-hidden">Loading...</span>\n' +
                        '    </div>\n' +
                        '</div>';

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            photosBlock.innerHTML = '';
                            if(response.data.length > 0) {
                                for (i = 0; i < response.data.length; i++) {
                                    let filename = response.data[i]['filename'];
                                    let img = '/storage/images/drivers/' + driver + '/' + filename + '';
                                    photosBlock.innerHTML +=
                                        '<div class="col-lg-4 col-12">\n' +
                                        '<img class="my-12" src="'+ img +'">\n' +
                                        '</div>';
                                }

                            }
                        },
                        error: function(e) {

                        }
                    });

                });
            }

            //Get the Driver name in the cell.
            $('.driver_card').click(function () {
                let driver = $(this).attr('data-name');
                map._layers[driver].fire('click');
                let coords = map._layers[driver]._latlng;
                map.setView(coords, 4);
            });

        }	//end of SelectPoints function

    </script>

@endpush

@include('parts.car_photo_modal')
