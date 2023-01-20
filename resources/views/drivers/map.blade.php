
@extends('layouts.app')

@section('title', 'Map - Express Delivery PRO')

@section('content')
    <div class="hp-main-layout-content">
        <div class="row mb-32 gy-32">
            <div class="col-12">
                <div id="wrapper">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="input-group">
                                <select id="miles" class="form-select" aria-label="Radius">
                                    <option value='50'>50 miles</option>
                                    <option value='100'>100 mile</option>
                                    <option value='150'>150 miles</option>
                                    <option value='200'>200 miles</option>
                                    <option value='300'>300 miles</option>
                                    <option value='500'>500 miles</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="input-group">
                                <input id="zipCodeInput" value="" type="text" class="form-control" placeholder="Zip code">
                                <div class="input-group-append">
                                    <button id="checkBtn" class="btn btn-primary" type="button" onclick="checkZip()" style="border-top-left-radius: 0;border-bottom-left-radius: 0;width: 120px">Drop pin</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-16 pt-24">
                        <div class="col-lg-3 col-12">
                            <span class="text-danger">red</span> - Сar in service
                        </div>
                        <div class="col-lg-3 col-12">
                            <span class="text-primary">blue</span> - Сar is available
                        </div>
                        <div class="col-lg-3 col-12">
                            <span class="text-success">green</span> - Сar in radius
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9">
                            <div id="map"></div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card hp-contact-card mb-32 rounded border border-black-40 hp-border-color-dark-80 bg-black-0 hp-bg-color-dark-100">
                                <div class="card-body">
                                    <h4>Drivers within range</h4>
                                    <table  id="myTable"></table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
<style>
    #map {
        width: 100%;
        height: 450px;
    }
</style>
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
@endpush

@push('js')
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>





    <script>
        let url = '{{url('/dashboard/drivers/getalldrivers')}}';
        let theMarker;
        let theCircle;
        let geojsonLayer;

        let map = L.map('map').setView([39.0, -98.26], 4);

        let osm = new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png',{
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'});

        // https: also suppported.
        let Esri_WorldGrayCanvas = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ',
            maxZoom: 16
        }).addTo(map);

        // https: also suppported.
        let Stamen_TopOSMFeatures = L.tileLayer('http://stamen-tiles-{s}.a.ssl.fastly.net/toposm-features/{z}/{x}/{y}.{ext}', {
            attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: 'abcd',
            minZoom: 0,
            maxZoom: 20,
            ext: 'png',
            bounds: [[22, -132], [51, -56]],
            opacity: 0.9
        });

        let OpenStreetMap_BlackAndWhite = L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });
        //OpenStreetMap_BlackAndWhite.addTo(map);

        let blue = L.layerGroup([
            Esri_WorldGrayCanvas,
            Stamen_TopOSMFeatures
        ]);

        // Set function for color ramp
        function getColor(service){
            return service ? 'red' : 'blue';
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

                    console.log(feature.properties);

                    return L.circleMarker(latlng, {
                        radius:6,
                        opacity: .5,
                        color:getColor(feature.properties.service),
                        fillColor:  getColor(feature.properties.service),
                        fillOpacity: 0.8

                    });  //.bindTooltip(feature.properties.fullname);
                },
                onEachFeature: function (feature, layer) {
                    layer._leaflet_id = feature.properties.fullname;

                    let service = '';
                    feature.properties.service ? service = '<span style="color: red">On service</span>' : service = '<span style="color: blue">Available</span>';

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

        //////////////////////////
        let baseMaps = {
            "Gray":Esri_WorldGrayCanvas,
            "OSM B&W":OpenStreetMap_BlackAndWhite,
        };

        let overlayMaps = {};
        //Add layer control
        L.control.layers(baseMaps, overlayMaps).addTo(map);

        map.on('click',function(e){
            lat = e.latlng.lat;
            lon = e.latlng.lng;
            ProcessClick(lat,lon)
        });

        function dropPin(lat, lon) {
            map.panTo([lat,lon]);
            ProcessClick(lat,lon)
        }

        function ProcessClick(lat,lon){
            console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );

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
            theMarker = L.marker([lat,lon]).addTo(map);
            SelectPoints(lat,lon);
        }

        let selPts = [];

        function SelectPoints(lat,lon){
            let dist = document.getElementById("miles").value;

            let xy = [lat,lon];  //center point of circle

            let theRadius = parseInt(dist) * 1609.34 ; //1609.34 meters in a mile
            //dist is a string so it's convered to an Interger.

            selPts.length =0;  //Reset the array if selecting new points

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
            theCircle = L.circle(xy, theRadius , {   /// Number is in Meters
                color: 'orange',
                fillOpacity: 0,
                opacity: 1
            }).addTo(map);

            //Symbolize the Selected Points
            geojsonLayer = L.geoJson(selPts, {

                pointToLayer: function(feature, latlng) {
                    console.log('point to layer');
                    return L.circleMarker(latlng, {
                        radius: 4, //expressed in pixels circle size
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
            console.log(GeoJS.features.length +" Selected features");

            // show selected GEOJSON data in console
            console.log(JSON.stringify(GeoJS));

            //////////////////////////////////////////

            //Clean up prior records
            $("#myTable tr").remove();

            let table = document.getElementById("myTable");
            //Add the header row.
            let row = table.insertRow(-1);
            // var headerCell = document.createElement("th");
            // headerCell.innerHTML = "Drivers";
            // row.appendChild(headerCell);

            //Add the data rows.
            //console.log(selPts);
            for (let i = 0; i < selPts.length; i++) {
                //console.log(selPts[i].properties.fullname);
                row = table.insertRow(-1);
                let cell = row.insertCell(-1);

                cell.innerHTML = selPts[i].properties.fullname;
            }
            //Get the Driver name in the cell.
            $('#myTable tr').click(function() {
                let theDriver = (this.getElementsByTagName("td").item(0)).innerHTML;

                map._layers[theDriver].fire('click');
                let coords = map._layers[theDriver]._latlng;

                map.setView(coords, 5);
            });

        }	//end of SelectPoints function

    </script>

    <script>
        function checkZip() {

            const api_key = '{{config('app.zipcode_key')}}';
            const zip_code = $('#zipCodeInput').val();

            $('#checkBtn')
                .attr('disabled', true)
                .html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');

            $.ajax({
                method: "GET",
                url: "https://www.zipcodeapi.com/rest/"+api_key+"/info.json/"+zip_code+"/degrees",
                success: (result) => {
                    dropPin(result['lat'], result['lng']);
                    $('#checkBtn')
                        .attr('disabled', false)
                        .html('Drop pin');
                    $('#zipCodeInput').val('');
                },
                error: (error) => {
                    $('#checkBtn')
                        .attr('disabled', false)
                        .html('Drop pin');
                    console.log(error.status);
                }
            });
        }
    </script>
@endpush