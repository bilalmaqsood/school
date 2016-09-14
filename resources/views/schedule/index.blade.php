@extends('layouts.app')
@section('content')
    <style>
        table tr th{
            width: 10%;
            text-align: center;
        }
        table tr td {
            width: 10%;
            height: 100px;
            text-align: center;
            vertical-align: middle !important;
        }
    </style>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
            </div>
            <div class="title_right">

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Class Time Table</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="monday-tab" role="tab" data-toggle="tab" aria-expanded="true">Monday</a></li>
                                <li role="presentation"><a href="#tab_content2" id="tuesday-tab" role="tab" data-toggle="tab" aria-expanded="false">Tuesday</a></li>
                                <li role="presentation"><a href="#tab_content3" id="wednesday-tab" role="tab" data-toggle="tab" aria-expanded="false">Wednesday</a></li>
                                <li role="presentation"><a href="#tab_content4" id="thursday-tab" role="tab" data-toggle="tab" aria-expanded="false">Thursday</a></li>
                                <li role="presentation"><a href="#tab_content5" id="friday-tab" role="tab" data-toggle="tab" aria-expanded="false">Friday</a></li>

                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="monday-tab">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        @foreach($periods as $period)
                                                            <th>{{ ucwords($period->name) }}</br>{{$period->start_time.' - '.$period->end_time}}</th>
                                                        @endforeach
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for($cindex = 0; $cindex < count($classes); $cindex++)
                                                        <tr>
                                                            <td>{{ ucwords($classes[$cindex]->name) }}</td>
                                                            @for($dindex=0; $dindex < count($periods); $dindex++)
                                                                <td class="add_class">
                                                                    <input type="hidden" name="day_of_week" value="{{ $monday[$cindex][$dindex]['day_of_week'] }}"/>
                                                                    <input type="hidden" name="class_id" value="{{ $monday[$cindex][$dindex]['class_id'] }}"/>
                                                                    <input type="hidden" name="period_id" value="{{ $monday[$cindex][$dindex]['period_id'] }}"/>
                                                                    <input type="hidden" name="subject_id" value="{{ $monday[$cindex][$dindex]['subject_id'] }}"/>
                                                                    <input type="hidden" name="id" value="{{ $monday[$cindex][$dindex]['id'] }}"/>
                                                                    @if($monday[$cindex][$dindex]['subject_id'] != '')
                                                                        <span class="selectedSpan">{{ \SiteHelpers::getSubjectName($monday[$cindex][$dindex]['subject_id']) }}</span>
                                                                    @else
                                                                        <span class="selectedSpan"></span>
                                                                    @endif
                                                                </td>
                                                            @endfor
                                                        </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>

                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="tuesday-tab">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                @foreach($periods as $period)
                                                    <th>{{ ucwords($period->name) }}</br>{{$period->start_time.' - '.$period->end_time}}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for($cindex = 0; $cindex < count($classes); $cindex++)
                                                <tr>
                                                    <td>{{ ucwords($classes[$cindex]->name) }}</td>
                                                    @for($dindex=0; $dindex < count($periods); $dindex++)
                                                        <td class="add_class">
                                                            <input type="hidden" name="day_of_week" value="{{ $tuesday[$cindex][$dindex]['day_of_week'] }}"/>
                                                            <input type="hidden" name="class_id" value="{{ $tuesday[$cindex][$dindex]['class_id'] }}"/>
                                                            <input type="hidden" name="period_id" value="{{ $tuesday[$cindex][$dindex]['period_id'] }}"/>
                                                            <input type="hidden" name="subject_id" value="{{ $tuesday[$cindex][$dindex]['subject_id'] }}"/>
                                                            <input type="hidden" name="id" value="{{ $tuesday[$cindex][$dindex]['id'] }}"/>
                                                            @if($tuesday[$cindex][$dindex]['subject_id'] != '')
                                                                <span class="selectedSpan">{{ \SiteHelpers::getSubjectName($tuesday[$cindex][$dindex]['subject_id']) }}</span>
                                                            @else
                                                                <span class="selectedSpan"></span>
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="wednesday-tab">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                @foreach($periods as $period)
                                                    <th>{{ ucwords($period->name) }}</br>{{$period->start_time.' - '.$period->end_time}}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for($cindex = 0; $cindex < count($classes); $cindex++)
                                                <tr>
                                                    <td>{{ ucwords($classes[$cindex]->name) }}</td>
                                                    @for($dindex=0; $dindex < count($periods); $dindex++)
                                                        <td class="add_class">
                                                            <input type="hidden" name="day_of_week" value="{{ $wednesday[$cindex][$dindex]['day_of_week'] }}"/>
                                                            <input type="hidden" name="class_id" value="{{ $wednesday[$cindex][$dindex]['class_id'] }}"/>
                                                            <input type="hidden" name="period_id" value="{{ $wednesday[$cindex][$dindex]['period_id'] }}"/>
                                                            <input type="hidden" name="subject_id" value="{{ $wednesday[$cindex][$dindex]['subject_id'] }}"/>
                                                            <input type="hidden" name="id" value="{{ $wednesday[$cindex][$dindex]['id'] }}"/>
                                                            @if($wednesday[$cindex][$dindex]['subject_id'] != '')
                                                                <span class="selectedSpan">{{ \SiteHelpers::getSubjectName($wednesday[$cindex][$dindex]['subject_id']) }}</span>
                                                            @else
                                                                <span class="selectedSpan"></span>
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="thursday-tab">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                @foreach($periods as $period)
                                                    <th>{{ ucwords($period->name) }}</br>{{$period->start_time.' - '.$period->end_time}}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for($cindex = 0; $cindex < count($classes); $cindex++)
                                                <tr>
                                                    <td>{{ ucwords($classes[$cindex]->name) }}</td>
                                                    @for($dindex=0; $dindex < count($periods); $dindex++)
                                                        <td class="add_class">
                                                            <input type="hidden" name="day_of_week" value="{{ $thursday[$cindex][$dindex]['day_of_week'] }}"/>
                                                            <input type="hidden" name="class_id" value="{{ $thursday[$cindex][$dindex]['class_id'] }}"/>
                                                            <input type="hidden" name="period_id" value="{{ $thursday[$cindex][$dindex]['period_id'] }}"/>
                                                            <input type="hidden" name="subject_id" value="{{ $thursday[$cindex][$dindex]['subject_id'] }}"/>
                                                            <input type="hidden" name="id" value="{{ $thursday[$cindex][$dindex]['id'] }}"/>
                                                            @if($thursday[$cindex][$dindex]['subject_id'] != '')
                                                                <span class="selectedSpan">{{ \SiteHelpers::getSubjectName($thursday[$cindex][$dindex]['subject_id']) }}</span>
                                                            @else
                                                                <span class="selectedSpan"></span>
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="friday-tab">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                @foreach($periods as $period)
                                                    <th>{{ ucwords($period->name) }}</br>{{$period->start_time.' - '.$period->end_time}}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for($cindex = 0; $cindex < count($classes); $cindex++)
                                                <tr>
                                                    <td>{{ ucwords($classes[$cindex]->name) }}</td>
                                                    @for($dindex=0; $dindex < count($periods); $dindex++)
                                                        <td class="add_class">
                                                            <input type="hidden" name="day_of_week" value="{{ $friday[$cindex][$dindex]['day_of_week'] }}"/>
                                                            <input type="hidden" name="class_id" value="{{ $friday[$cindex][$dindex]['class_id'] }}"/>
                                                            <input type="hidden" name="period_id" value="{{ $friday[$cindex][$dindex]['period_id'] }}"/>
                                                            <input type="hidden" name="subject_id" value="{{ $friday[$cindex][$dindex]['subject_id'] }}"/>
                                                            <input type="hidden" name="id" value="{{ $friday[$cindex][$dindex]['id'] }}"/>
                                                            @if($friday[$cindex][$dindex]['subject_id'] != '')
                                                                <span class="selectedSpan">{{ \SiteHelpers::getSubjectName($friday[$cindex][$dindex]['subject_id']) }}</span>
                                                            @else
                                                                <span class="selectedSpan"></span>
                                                            @endif
                                                        </td>
                                                    @endfor
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="classScheduleModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    </div>
    <script type="application/javascript">
        $(document).ready(function(){
            $('.add_class').on('click', function () {

                var datas = {
                    day_of_week: $(this).find('input[name*="day_of_week"]').val(),
                    class_id: $(this).find('input[name*="class_id"]').val(),
                    period_id: $(this).find('input[name*="period_id"]').val(),
                    subject_id: $(this).find('input[name*="subject_id"]').val(),
                    id: $(this).find('input[name*="id"]').val(),
                };

                $.get( 'schedule/popup', datas, function( data ) {
                    $('#classScheduleModel').html(data);
                    $('#classScheduleModel').modal('show');
                });

            });
        });
    </script>
@endsection