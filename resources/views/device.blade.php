@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
                    <h1>{{ $device->name }}</h1>
                    <hr>
                    @if(session('success'))
                    <div class="alert alert-success" role="alert"><b>Success:</b> {{ session('success') }}</div>
                    @endif
                    <form action="/devices/{{ $device->id }}" method="POST" >
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
                                <span class="form-control-plaintext" name="location" id="location">@if(empty($device->location)) n/a @else {{ $device->location }} @endif</span>
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