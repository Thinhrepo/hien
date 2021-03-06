@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">Dashboard</h1>
@stop
@section('style')
    <style>
        .navbar-custom {
            padding: 10px 0;
        }

        #dashboard-index-wrap {
            padding: 100px 0 80px;
        }

        a > img {
            width: 100%;
        }

        .main-body {
            margin: 30px 15px 10px;
            overflow: hidden;
            padding: 10px 10px;
            margin-bottom: 90px;
        }

    </style>
@stop

@section('content')
    <section id="dashboard-index-wrap">
        <div class="">
            <div class="row">

                <div class="main-body">

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="{{ route('backend.author.grade', 1) }}">
                            <img src="{{asset('/imgs-dashboard/tieu-hoc.PNG')}}" alt="Tạo Đề Cấp Tiểu Học"></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="{{ route('backend.author.grade', 2) }}">
                            <img src="{{asset('/imgs-dashboard/THCS.PNG')}}" alt="Tạo Đề Cấp Trung Học Cơ Sở"></a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a href="{{ route('backend.author.grade', 3) }}">
                            <img src="{{asset('/imgs-dashboard/THPT.PNG')}}" alt="Tạo Đề Cấp Trung Học Phổ Thông"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop