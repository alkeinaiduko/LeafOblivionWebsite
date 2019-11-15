@extends('layouts.app')

@section('content')
    @include('includes.admin-controls')
    <section class="admin-main-content">
        <div class="admin-container">
            <h3 class="content-title">Page Roles</h3>
            <admin-roles :roles="{{ $all_roles }}" />
        </div>
    </section>
@endsection
