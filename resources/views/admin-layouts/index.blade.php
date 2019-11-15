@extends('layouts.app')

@section('content')
    @include('includes.admin-controls')
    <section class="admin-main-content">
        <div class="admin-container">
            <h3 class="content-title">Admins</h3>
            <admin-admins :roles="{{ $roles }}" :admins="{{ $admins }}" />
        </div>
    </section>
@endsection
