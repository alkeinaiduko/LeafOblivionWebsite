@extends('layouts.app')

@section('content')
    <div class="leaf-container">
            @include('includes.header')
            <section class="hero-banner">
                <img src="{{ asset('/images/banner.png') }}" alt="">
            </section>
            <section class="main-content">
                <div class="row">
                    <div class="col-md-9" style="padding-right: 1em;">
                        <div class="section-title">
                            <h4><strong>PATCH NOTES</strong></h4>
                        </div>
                        <div class="section-content">
                            <h5 class="patch-note-title"><strong>Nov. 9, 2019 Changes Log</strong></h5>
                            <ul>
                                <li>Added new LOPD vehicle</li>
                                <li>Minor LOPD Department inventory adjusments</li>
                                <li>Added PG on OPG base</li>
                                <li>Added PG on ESLUGAW base</li>
                                <li>Added additional spawn points on Purge event</li>
                                <li>Fixed few inventory missing icons</li>
                                <li>New batch of Import vehicles!</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding-right: 1em;">
                        <div class="section-title text-center" style="justify-content: center;">
                            <h4><strong>STATUS</strong></h4>
                        </div>
                        <div class="section-content">
                                <ul class="server-status">
                                    <li>Server: <span class="server-status-online">Online</span></li>
                                    <li>Online Players: 60</li>
                                </ul>
                        </div>
                    </div>
                </div>

                <div class="quicklinks">
                    <h1 class="text-center"><strong>QUICKLINKS</strong></h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="leaf-card text-center">
                                <a href="/car-shop">
                                    <img src="{{ asset('/images/car-dealer.png') }}">
                                    <div class="leaf-card-title">Car Dealership</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="leaf-card text-center">
                                <a href="#">
                                    <img src="{{ asset('/images/car-custom.png') }}">
                                    <div class="leaf-card-title">Car Customization</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="leaf-card text-center">
                                <a href="#">
                                    <img src="{{ asset('/images/application-form.png') }}">
                                    <div class="leaf-card-title">Application forms</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="footer">
                Copyright &copy; 2019 | Leaf Oblivion PH
            </div>
    </div>
@endsection
