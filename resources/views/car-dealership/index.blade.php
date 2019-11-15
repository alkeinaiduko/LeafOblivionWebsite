@extends('layouts.app')

@section('content')
    <div class="leaf-container">
        @include('includes.header')
        <car-dealership :cars="{{ $cars }}" />
    </div>
@endsection
