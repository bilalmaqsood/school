@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="x_content bs-example-popovers">
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Note!</strong> {{ $pageNote }}
                </div>
            </div>
            <div class="title_left">
                <h3>{{ $pageTitle }}</h3>
            </div>
            <div class="title_right">

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Select Class</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open(array('url'=>'event/save/', 'class'=>'form-horizontal form-label-left', 'data-parsley-validate'=>true,'id'=> 'demo-form2')) !!}
                        <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                            <label for="semester">Class * :</label>
                            <select name="class"class="form-control">
                                <option value="">Select Class</option>
                                <option value="1">Class 1</option>
                                <option value="2">Class 2</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                            <label for="semester">Subject * :</label>
                            <select name="class"class="form-control">
                                <option value="">Select Subject</option>
                                <option value="1">Subject 1</option>
                                <option value="2">Subject 2</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                            <label for="semester">Semester * :</label>
                            <select name="semester"class="form-control">
                                <option value="">Select Semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                            <label for="semester">Exam * :</label>
                            <select name="class"class="form-control">
                                <option value="">Select Exam</option>
                                <option value="1">Term 1</option>
                                <option value="2">Term 2</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                            <button type="submit" class="btn btn-success">Manage Marks</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection