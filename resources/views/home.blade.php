@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Dashboard</h1>
        <hr>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
    </div>
</div>
@endsection
