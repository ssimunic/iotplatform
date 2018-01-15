@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <h1>Edit {{ $chart->name }}</h1>
            <hr>
            @if(session('success'))
            <div class="alert alert-success" role="alert"><b>Success:</b> {{ session('success') }}</div>
            @endif
            <form class="form-inline" method="POST" action="/charts/edit/{{ $chart->id }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" required placeholder="Chart name" value="{{ $chart->name }}">
            </div>
            <div class="form-group">
                <select class="form-control" id="public" name="type">
                    <option value="linechart" @if($chart->type=="linechart") selected @endif>Line Chart</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" id="public" name="public">
                    <option value="0" @if($chart->public==0) selected @endif>Private</option>
                    <option value="1" @if($chart->public==1) selected @endif>Public</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
            <br>
            <legend>Chart fields</legend>
            @if(count($fields)==0)
            No device fields &ndash; add them first to create chart fields.
            @else
            <form class="form-inline" method="POST" action="/charts/fields/{{ $chart->id }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" required placeholder="Name">
            </div>
            <div class="form-group">
                <select class="form-control" id="public" name="device_field_id">
                    @foreach($fields as $field)
                    <option value="{{ $field->id }}">{{ $field->device->name }}: {{ $field->key }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            </form>
            @endif
            <hr>
            @if(count($chart->fields)==0)
            No chart fields.
            @else
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Device field</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @foreach($chart->fields as $field)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $field->name }}</td>
                        <td><a href="/devices/fields/{{ $field->deviceField->device_id}}">{{ $field->deviceField->device->name }}: {{ $field->deviceField->key }}</a></td>
                        <td>
                            <a href="/charts/fields/delete/{{ $field->id }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @php
                    $i++
                    @endphp
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection