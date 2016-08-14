@extends('layouts.app')

@section('content')

    <div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">
        <h1>Student Register</h1>
    </div>
    <div id="page_content_inner">
        <div class="resultData"></div>
        <div class="ajaxLoading"></div>
        <div id="{{ $pageModule }}View"></div>
        <div id="{{ $pageModule }}Grid"></div>
    </div>

    <script>
        $(document).ready(function(){
            reloadData('#{{ $pageModule }}','{{ $pageModule }}/data');
        });
    </script>
@endsection

