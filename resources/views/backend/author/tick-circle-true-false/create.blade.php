@extends('layouts.app-backend')

@section('style')
    @include('backend.author.tick-circle-true-false.style')
    @include('backend.author.style-common')
@stop

@section('header')
    <h1 class="page-header">
        @if($code_user == 'ST')
            Add exam 'tick-circle-true-false' for Student test online
        @elseif($code_user == 'TC')
            Add exam 'tick-circle-true-false' for Teacher
        @endif
    </h1>
@stop

@section('content')

    {{ Form::open(['route' => 'backend.manager.author.tick-circle-true-false.store', 'method' => 'post']) }}

    <div class="row">
        @if($code_user == 'ST')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="level_id" class="form-control" id="add-tick-true-false-level">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->title}} - {{$level->point}}  </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="tick-true-false-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @elseif($code_user == 'TC')
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="class_id" class="form-control" id="tick-true-false-class">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">

                    <select name="exam_type_id" class="form-control" id="tick-true-false-examtype">
                        @foreach($exam_types as $types)
                            <option value="{{$types->id}}" code="{{$types->code}}">{{$types->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3" id="wrap_bookmap_form">

                <select name="book_map_id" class="form-control" id="tick-true-false-bookmap">
                    @foreach($book_maps as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select>

            </div>
        @endif

        <input type="hidden" value="{{$code_user}}" name="code_user">
        <input type="hidden" value="{{$class_code}}" name="class_code">
    </div>
    <div class="row" id="wrap_add_tick_true_false">
        <div class="col-lg-12 col_add_tick_true_false">

            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="wrap-content-exam-1">

                        <div class="col-lg-10" style="padding-left: 0;">
                            <div class="form-group">
                                <input type="text" name="tick_true_false[1][title-tick-true-false]"
                                       class="form-control" required>
                            </div>
                        </div>
                        {{--<div class="col-lg-2" style=" padding-right: 0;">--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="lable-point">Point: </label>--}}
                                {{--<input type="number" name="tick_true_false[1][point]"--}}
                                       {{--class="form-control input-point" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                                <textarea type="text" class="form-control"
                                          name="tick_true_false[1][content-tick-true-false]"
                                          placeholder="enter content" required></textarea>
                        </div>
                        <div class="form-group" style="width:100%; float:left;">
                            <div class="span-numb-question" id="id-numb-question-1">
                                1
                                <input type="hidden" name="tick_true_false[1][content-choose-ans-question][1][id]" value="1">
                            </div>
                            <div class="span-text-question">
                                    <textarea type="text" class="form-control"
                                              name="tick_true_false[1][content-choose-ans-question][1][content]"
                                              placeholder="enter content" required></textarea>
                            </div>
                            <div class="span-choose-tick-true-false">
                                <span>
                                    <input type="radio" id="check-answer_1_1_T"
                                           name="tick_true_false[1][content-choose-ans-question][1][answer]" value="T"
                                           class="ans-true">
                                    <label for="check-answer_1_1_T" style="cursor: pointer">T</label>
                                </span>
                                <span>
                                     <input type="radio" id="check-answer_1_1_F"
                                            name="tick_true_false[1][content-choose-ans-question][1][answer]" value="F"
                                            class="ans-false">
                                    <label for="check-answer_1_1_F" style="cursor: pointer">F</label>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <span id="add_item_question_1" item_this="1" item="1"
                           class="add-question" onclick="add_item_question_TF(this.id)" title="Add">+</span>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <spam class="add-item">+</spam>
        </div>
        <div class="col-lg-12 col-md-12">
            <button class="save-tick-true-false btn style-save" title="Save" type="submit">
                <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
    </div>

    {!! Form::close() !!}

@stop

@section('script')
    @include('backend.author.tick-circle-true-false.scritp')
    @include('backend.author.script-common')
@stop
