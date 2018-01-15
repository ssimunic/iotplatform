@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <h1>{{ $device->name }} fields</h1>
            <hr>
            @if(session('success'))
                <div class="alert alert-success" role="alert"><b>Success:</b> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert"><b>Error:</b> {{ session('error') }}</div>
            @endif
            <form class="form-inline" method="POST" action="/devices/fields/{{ $device->id }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" id="key" name="key" required placeholder="Field key">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
            </form>
            <hr>
            @if(count($device->fields)==0)
            No fields.
            @else
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Key</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @foreach($device->fields as $field)
                        <tr>
                            <td>{{ $i }} </td>
                            <td>{{ $field->key }} ({{ $field->data->count() }})</td>
                            <td>
                                <a href="/devices/fields/delete/{{ $field->id }}" class="btn btn-danger">Delete</a>
                                <a href="/devices/fields/reset/{{ $field->id }}" class="btn btn-warning">Reset</a>
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

