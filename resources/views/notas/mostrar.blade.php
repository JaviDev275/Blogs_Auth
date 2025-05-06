@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $nota->nombre }}</h1>
            <p>{{ $nota->descripcion }}</p>
        </div>
    </div>
</div>
@endsection