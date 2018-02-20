@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <h1>{{ $device->name }} triggers</h1>
            <hr>
            @if(session('success'))
                <div class="alert alert-success" role="alert"><b>Success:</b> {{ session('success') }}</div>
            @endif
            @if(count($device->fields)==0)
            No fields &ndash; add them first to create triggers.
            @else
            <form class="form-horizontal" method="POST" action="/devices/triggers/{{ $device->id }}">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Field</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="select" name="device_field_id">
                                @foreach($device->fields as $field)
                                <option value="{{ $field->id }}">{{ $field->key }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="max_value" class="col-lg-2 control-label">Max value</label>
                    <div class="col-lg-10">
                        <input type="number" class="form-control" id="max_value" name="max_value" placeholder="Max value" required>
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="min_value" class="col-lg-2 control-label">Min value</label>
                    <div class="col-lg-10">
                        <input type="number" class="form-control" id="min_value" name="min_value" placeholder="Min value" required>
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="webhook_url" class="col-lg-2 control-label">Webhook URL</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="webhook_url" name="webhook_url" placeholder="Webhook URL">
                        <br>
                        <div class="alert alert-info" role="alert">Use <strong>{field}</strong> and <strong>{value}</strong> in URL to refer to field name and value that triggered request.</div>

                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
                </form>
            @endif
            <hr>
            @if(count($triggers)==0)
            No triggers.
            @else
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Field</th>
                        <th>Max value</th>
                        <th>Min value</th>
                        <th>Email</th>
                        <th>Webhook</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @foreach($triggers as $trigger)
                    <tr>
                        <td>{{ $i }}</td>
                        <td><a href="/devices/fields/{{ $trigger->deviceField->device_id}}">{{ $trigger->deviceField->key }}</a></td>
                        <td>{{ $trigger->max_value }}</td>
                        <td>{{ $trigger->min_value }}</td>
                        <td>@if(empty($trigger->email)) n/a @else {{ $trigger->email }} @endif</td>
                        <td>@if(empty($trigger->webhook_url)) n/a @else {{ $trigger->webhook_url }} @endif</td>
                        <td>
                            <a href="/devices/triggers/edit/{{ $trigger->id }}" class="btn btn-primary">Edit</a>
                            <a href="/devices/triggers/delete/{{ $trigger->id }}" class="btn btn-danger">Delete</a>
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

