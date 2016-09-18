@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    School Calendar
                    <small>
                        Click to view events
                    </small>
                </h3>
            </div>

            <div class="title_right">
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
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
    <!-- Start Calendar modal -->
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

    <!-- End Calendar modal -->

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
                    //alert(calEvent.title, jsEvent, view);

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
@stop