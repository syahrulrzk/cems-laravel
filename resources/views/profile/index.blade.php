@extends('layouts.app')

@section('title', 'Profile - CEMS')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <img class="card-img-top img-fluid" src="{{ asset('app-assets/images/profile/user-uploads/cover.jpg') }}" alt="">
                                <div class="card-body">
                                    <div class="row" style="position: relative; z-index: 100; background-color: #fff; margin-top: -100px; border-radius: 10px;">
                                        <div class="col-lg-2 text-center" style="margin: auto;">
                                            <br>
                                            <img src="{{ \App\Helpers\CemsHelper::logo() }}" class="card-img-top img-fluid" alt="">
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <br>
                                            <h4>{{ \App\Helpers\CemsHelper::company() }}</h4>
                                            <small>
                                                <strong>Address :</strong><br>
                                                {!! nl2br(\App\Helpers\CemsHelper::address()) !!}<br>
                                                {{ \App\Helpers\CemsHelper::province_name(\App\Helpers\CemsHelper::province()) }}, {{ \App\Helpers\CemsHelper::country() }}
                                            </small>
                                            <br><br>
                                            <small><strong>Contact :</strong><br>{{ \App\Helpers\CemsHelper::phone() }}</small>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <br>
                                            <div class="card text-center {{ $bg }}" data-toggle="tooltip" data-placement="left" data-html="true" title="<h5 class='text-white'>Keterangan</h5><ul><li>A = Jika data valid lebih dari 90% dari total data</li><li>B = Jika data valid lebih dari 75% dan kurang dari 90% dari total data</li><li>C = Jika data valid kurang dari 75% dari total data</li></ul>">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <br>
                                                        <p class="text-bold-700 text-white" style="font-size: 50pt !important;">{{ $grade }}</p>
                                                        <br>
                                                        <p class="mb-0 line-ellipsis text-bold-700 text-white">Performance</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Maps</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <iframe src="https://maps.google.com/maps?q={{ \App\Helpers\CemsHelper::lt() }},{{ \App\Helpers\CemsHelper::lg() }}&hl=es;z=14&amp;output=embed" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
