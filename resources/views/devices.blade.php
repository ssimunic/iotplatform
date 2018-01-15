@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
                    <h1>Devices</h1>
                    <hr>
                    @if(session('success'))
                    <div class="alert alert-success" role="alert"><b>Success:</b> {{ session('success') }}</div>
                    @endif
                    <form class="form-inline" method="POST" action="{{ route('addDevice') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Device name">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <hr>
                    @if(count($devices)==0) 
                    No devices.
                    @else
                    @php
                    $i = 1
                    @endphp
                    @foreach($devices as $device)
                    @if ($i % 3 == 0)
                    <div class="row">
                    @endif
                    <div class="col-sm-4 col-md-4" style="padding-left: 0px;">
                        <div class="thumbnail">
                            <div class="caption">
                                <h3>{{ $device->name }}</h3>
                                <p>Last checked at @if(empty($device->last_check)) <em>never</em> @else {{ $device->last_check }} @endif</p>
                                <p>
                                    <a href="/devices/{{ $device->id }}" class="btn btn-default" role="button">Settings</a> 
                                    <a href="/devices/fields/{{ $device->id }}" class="btn btn-primary" role="button">Fields</a>
                                    <a href="/devices/triggers/{{ $device->id }}" class="btn btn-danger" role="button">Triggers</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @if ($i % 3 == 0)
                    </div>
                    @endif
                    @php
                    $i++
                    @endphp
                    @endforeach
                    @endif

        </div>
    </div>
</div>
@endsection