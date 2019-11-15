@extends('layouts.app')

@section('content')
    @include('includes.admin-controls')
    <section class="admin-main-content">
        <div class="admin-container">
            <h3 class="content-title">Car Dealership</h3>
            <admin-car-dealer :cars="{{ $cars }}" />
        </div>
    </section>
@endsection
