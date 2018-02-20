@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <h1>Charts</h1>
            <hr>
            @if(session('success'))
            <div class="alert alert-success" role="alert"><b>Success:</b> {{ session('success') }}</div>
            @endif
            <form class="form-inline" method="POST" action="{{ route('addChart') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" required placeholder="Chart name">
            </div>
            <div class="form-group">
                <select class="form-control" id="public" name="type">
                    <option value="linechart">Line Chart</option>
                    <option value="scatter">Scatter</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" id="public" name="public">
                    <option value="0">Private</option>
                    <option value="1">Public</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            </form>
            <hr>
            @if(count($charts)==0) 
            No charts.
            @else
            @php
            $i = 1
            @endphp
            @foreach($charts as $chart)
                    @if ($i % 3 == 0)
                    <div class="row">
                    @endif
                    <div class="col-sm-4 col-md-4" style="padding-left: 0px;">
                        <div class="thumbnail">
                            <div class="caption">
                                <h3>{{ $chart->name }}</h3>
                                <p>
                                @if($chart->type=="linechart") Line Chart, @endif
                                @if($chart->type=="scatter") Scatter, @endif
                                {{ count($chart->fields) }} dataset(s)
                                </p>
                                <p>
                                <a href="/charts/{{ $chart->id }}" class="btn btn-primary">View</a>
                                <a href="/charts/edit/{{ $chart->id }}" class="btn btn-default">Edit</a>
                                <a href="/charts/delete/{{ $chart->id }}" class="btn btn-danger">Delete</a>
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
            <br>
            @endif
        </div>
    </div>
</div>
@endsection