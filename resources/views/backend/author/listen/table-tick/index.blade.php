@extends('layouts.app-backend')

@section('header')
    <h1 class="page-header">
        Listen Table Ticks for {{$name_code}}
        <a href="{{route('backend.manager.author.listen.listen_table_ticks.create', ['ST' , $class_code])}}" target="_blank"
           class="btn btn-success btn-create-new-test" style="float:right;">
            {{trans('label.backend.author.speaking.index.add')}}
        </a>
    </h1>
@stop
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listen Table Ticks's Students Tables
                </div>
                <div class="panel-body">
                    <div class="table-responsive" id="reload_table_ans_for_students">
                        @include('backend.author.listen.table-tick.table-students-index')
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>

@stop

@section('script')
    <script>
        setTableInit('manager_listen_table_ticks_students');

    </script>
@stop
