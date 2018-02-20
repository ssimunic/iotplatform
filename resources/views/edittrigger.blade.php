@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <h1>Edit trigger</h1>
            <hr>
            <form class="form-horizontal" method="POST" action="/devices/triggers/edit/{{ $trigger->id }}">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Field</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="select" name="device_field_id">
                                @foreach($trigger->deviceField->device->fields as $field)
                                <option value="{{ $field->id }}" @if($trigger->device_field_id==$field->id) selected @endif>{{ $field->key }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="max_value" class="col-lg-2 control-label">Max value</label>
                    <div class="col-lg-10">
                        <input type="number" class="form-control" id="max_value" name="max_value" placeholder="Max value" required value="{{ $trigger->max_value }}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="min_value" class="col-lg-2 control-label">Min value</label>
                    <div class="col-lg-10">
                        <input type="number" class="form-control" id="min_value" name="min_value" placeholder="Min value" required value="{{ $trigger->min_value }}"> 
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $trigger->email }}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="webhook_url" class="col-lg-2 control-label">Webhook URL</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="webhook_url" name="webhook_url" placeholder="Webhook URL" value="{{ $trigger->webhook_url }}">
                        <br>
                        <div class="alert alert-info" role="alert">Use <strong>{field}</strong> and <strong>{value}</strong> in URL to refer to field name and value that triggered request.</div>                   
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection

