@extends('layouts.app')
@section('content')
    <br />
    <div class="">
        @if(\Session::get('gid') != 5 && \Session::get('gid') != 6)
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i>
                    </div>
                    <div class="count">{{ $total_students }}</div>
                    <br>
                    <h3>Total Students</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i>
                    </div>
                    <div class="count">{{ $total_teachers }}</div>
                    <br>
                    <h3>Total Teachers</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i>
                    </div>
                    <div class="count">{{ $total_female_students }}</div>
                    <br>
                    <h3>Total Female Students</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i>
                    </div>
                    <div class="count">{{ $total_male_students }}</div>
                    <br>
                    <h3>Total Male Students</h3>
                </div>
            </div>
        </div>
        @endif
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Recent News <small></small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="dashboard-widget-content">
                                @if(count($news) > 0 )
                                    @foreach($news as $new)
                                        <ul class="list-unstyled timeline widget">
                                            <li>
                                                <div class="block">
                                                    <div class="block_content">
                                                        <h2 class="title">
                                                            <a>{{ $new->title }}</a>
                                                        </h2>
                                                        <div class="byline">
                                                            <span>{{ \SiteHelpers::time_elapsed_string($new->created_at) }}</span> by <a>{{ ucwords(\SiteHelpers::getUserName($new->created_by)) }}</a>
                                                        </div>
                                                        <p class="excerpt">{{ $new->body }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    @endforeach
                                @else
                                    <h2>No Recent News Found</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>School Calender</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>School Calendar <small>Events</small></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <div id='calendar'></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div id="CalenderModalView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel2">View Event Detail</h4>
                </div>
                <div class="modal-body">

                    <div id="testmodal2" style="padding: 5px 20px;">
                        <form id="antoform2" class="form-horizontal calender" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 text-right">Title</label>
                                <div class="col-sm-9">
                                    <span id="title"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 text-right">Start Date</label>
                                <div class="col-sm-9">
                                    <span id="start_date"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 text-right">End Date</label>
                                <div class="col-sm-9">
                                    <span id="end_date"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 text-right">venue</label>
                                <div class="col-sm-9">
                                    <span id="venue"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 text-right">Description</label>
                                <div class="col-sm-9">
                                    <span id="description"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="fc_view" data-toggle="modal" data-target="#CalenderModalView"></div>
    <script>
        $(window).load(function() {
            var event="{{$events}}";
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var started;
            var categoryClass;
            var dateObj = new Date("11/21/1987 16:00:00");

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: false,
                selectHelper: false,
                eventClick: function(calEvent, jsEvent, view) {
                    $('#fc_view').click();
                    $('#title').val(calEvent.title);
                    categoryClass = $("#event_type").val();
                    $("#CalenderModalView #title").text(calEvent.title);
                    $("#CalenderModalView #description").text(calEvent.body);
                    $("#CalenderModalView #venue").text(calEvent.venue);
                    $("#CalenderModalView #start_date").text(calEvent.start);
                    $("#CalenderModalView #end_date").text(calEvent.end);
                    $(".antosubmit2").on("click", function() {
                        calEvent.title = $("#title").val();

                        calendar.fullCalendar('updateEvent', calEvent);
                        $('.antoclose2').click();
                    });
                    calendar.fullCalendar('unselect');

                },
                editable: false,
                events: JSON.parse(event.replace(/&quot;/g,'"'))
            });
        });
    </script>
@endsection