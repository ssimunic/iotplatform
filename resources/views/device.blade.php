@extends('layouts.app') @section('content')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCohrfFCZgG_gj6Usd48nIY6VUwSeDC9mw"></script>

<script type="text/javascript">
        var map = null;
        var marker = null;
        var infowindow = new google.maps.InfoWindow({
            size: new google.maps.Size(150,50)
        });
        function createMarker(latlng, name, html) {
            var contentString = html;
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                zIndex: Math.round(latlng.lat()*-100000)<<5
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(contentString);
                infowindow.open(map,marker);
            });
            google.maps.event.trigger(marker, 'click');
            return marker;
        }
        function initialize() {
            var myOptions = {
                @if(empty($device->location))
                zoom: 3,
                @else
                zoom: 14,
                @endif
                @if(empty($device->location))
                center: new google.maps.LatLng(45, 15),
                @else
                center: new google.maps.LatLng{{ $device->location }},
                @endif
                mapTypeControl: true,
                mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                navigationControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map_canvas"),
                    myOptions);
            google.maps.event.addListener(map, 'click', function() {
                infowindow.close();
            });
            google.maps.event.addListener(map, 'click', function(event) {
                if (marker) {
                    marker.setMap(null);
                    marker = null;
                }
                marker = createMarker(event.latLng, "name", "<b><span style='color: black'>{{ $device->name }}</span></b><br>Last checked at @if(empty($device->last_check)) <em>never</em> @else {{ $device->last_check }} @endif");
                var location = document.getElementById("location");
                location.value = event.latLng;
            });
            @if(!empty($device->location))
                var position = new google.maps.LatLng{{ $device->location }};
                marker = createMarker(position, "name", "<b><span style='color: black'>{{ $device->name }}</span></b><br>Last checked at @if(empty($device->last_check)) <em>never</em> @else {{ $device->last_check }} @endif");
            @endif
        }
        google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
                    <h1>{{ $device->name }}</h1>
                    <hr>
                    @if(session('success'))
                    <div class="alert alert-success" role="alert"><b>Success:</b> {{ session('success') }}</div>
                    @endif
                    <form action="/devices/{{ $device->id }}" method="POST" >
                        <input type="hidden" name="location" id="location" value="{{ $device->location }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <span class="form-control-plaintext" name="name" id="name">{{ $device->name }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="api_key" class="col-sm-2 col-form-label">API key</label>
                            <div class="col-sm-10">
                                <p readonly class="form-control-plaintext" id="api_key">
                                    <span class="badge badge-success">{{ $device->api_key }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mac_address" class="col-sm-2 col-form-label">MAC Address</label>
                            <div class="col-sm-10">
                                <span class="form-control-plaintext" id="mac_address">@if(empty($device->mac_address)) n/a @else {{ $device->mac_address }} @endif</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-2 col-form-label">Location</label>
                            <div class="col-sm-10">
                                <div id="map_canvas" style="height: 350px; border-radius: 5px;"></div>
                                <span class="help-block">Click on area where your device is located.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="read_time" class="col-sm-2 col-form-label">Read every seconds</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="readEvery" name="read_time" value="{{ $device->read_time }}" placeholder="Read time">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notes" class="col-sm-2 col-form-label">Notes</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="notes" id="notes" rows="3">{{ $device->notes }}</textarea>                        
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Save</button>        
                        <a href="/devices/delete/{{ $device->id }}" class="btn btn-danger" role="button">Delete</a> 
                    </form>
        </div>
    </div>
</div>
@endsection