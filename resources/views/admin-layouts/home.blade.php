@extends('layouts.app')

@section('content')
    @include('includes.admin-controls')
    <section class="admin-main-content">
        <div class="admin-container">
            <h3 class="content-title">Dashboard</h3>
            <admin-dashboard />
        </div>
    </section>
@endsection
