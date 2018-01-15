@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="jumbotron jumbo-moviedb">
                <h1 class="display-3">{{ config('app.name') }}</h1>
                <p class="lead">Internet of Things data platform.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="/devices" role="button">Get started &raquo;</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection