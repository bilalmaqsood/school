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
        <!-- Begin Content -->
        <div class="row">
            <div class="resultData"></div>
            <div class="ajaxLoading"></div>
            <div id="{{ $pageModule }}View"></div>
            <div id="{{ $pageModule }}Grid"></div>
        </div>
        <!-- End Content -->
    </div>
    <script>
        $(document).ready(function(){
            reloadData('#{{ $pageModule }}','{{ $pageModule }}/manage-marks');
        });
    </script>
@endsection