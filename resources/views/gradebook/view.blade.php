@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
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
            reloadData('#{{ $pageModule }}','manage-gradebook');
        });
    </script>
@endsection