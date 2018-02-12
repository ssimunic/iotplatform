@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <h1>{{ $field->device->name }}: {{ $field->key }} data</h1>
            <hr>
            @if(session('success'))
                <div class="alert alert-success" role="alert"><b>Success:</b> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert"><b>Error:</b> {{ session('error') }}</div>
            @endif
            @if(count($data)==0)
            No data.
            @else
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Value</th>
                        <th>Datetime</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $i }} </td>
                            <td>{{ $d->value }}</td>
                            <td>{{ $d->datetime }}</td>
                        </tr>
                        @php
                        $i++
                        @endphp
                    @endforeach
                </tbody>
            </table>
            @endif
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

