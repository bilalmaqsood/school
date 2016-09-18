<link href="{{ asset('css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/bootstrap-timepicker.js') }}"></script>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>New Event</h2>
            <li><a href="javascript:void(0)" class="pull-right close-link"
                   onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            </li>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            {!! Form::open(array('url'=>'period/save/'.SiteHelpers::encryptID($row['id']), 'class'=>'form-horizontal form-label-left', 'data-parsley-validate'=>true,'id'=> 'demo-form2')) !!}
            {!! Form::hidden('id', $row['id'],array('class'=>'form-control', 'required' => true)) !!}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Period No<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('name', $row['name'],array('class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Period No', 'required' => true)) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Break<span
                            class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 7px;">
                        <input name="break" type="checkbox" value="1" @if($row['break'] == 1) {{ 'checked' }} @endif>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Start Time<span
                            class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 col-xs-6 calender-width">
                    <input name="start_time" value="{{$row['start_time']}}" type="text"
                           class="form-control has-feedback-left" id="start_time" placeholder="Start Time"
                           aria-describedby="inputSuccess2Status2" required="required">
                    <span class="fa fa-calendar-o form-control-feedback left calender-icon" aria-hidden="true"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">End Time<span
                            class="required"></span>
                </label>
                <div class="col-md-3 col-sm-3 col-xs-6 calender-width">
                    <input name="end_time" value="{{$row['end_time']}}" type="text"
                           class="form-control has-feedback-left" id="end_time" placeholder="End Time"
                           aria-describedby="inputSuccess2Status2" required="required">
                    <span class="fa fa-calendar-o form-control-feedback left calender-icon" aria-hidden="true"></span>
                </div>
            </div>


            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="ajaxViewClose('#{{ $pageModule }}')">Cancel</a>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <script type="text/javascript">
        $('#start_time').timepicker();
        $('#end_time').timepicker();
        $(document).ready(function () {
            $.listen('parsley:field:validate', function () {
                validateFront();
            });
            $('#demo-form2 .btn').on('click', function () {
                $('#demo-form2').parsley().validate();
                validateFront();
                if ($('#demo-form2').parsley().isValid() == true) {
                    var options = {
                        dataType: 'json',
                        beforeSubmit: showRequest,
                        success: showResponse
                    }
                    $('#demo-form2').ajaxSubmit(options);
                    return false;

                } else {
                    return false;
                }
            });
            var validateFront = function () {
                if (true === $('#demo-form2').parsley().isValid()) {
                    $('.bs-callout-info').removeClass('hidden');
                    $('.bs-callout-warning').addClass('hidden');
                } else {
                    $('.bs-callout-info').addClass('hidden');
                    $('.bs-callout-warning').removeClass('hidden');
                }
            };
        });


        function showRequest() {
            $('.ajaxLoading').show();
        }
        function showResponse(data) {

            if (data.status == 'success') {
                ajaxViewClose('#{{ $pageModule }}');
                ajaxFilter('#{{ $pageModule }}', '{{ $pageUrl }}/data');
                //notyMessage(data.message);
                $('#sximo-modal').modal('hide');
            } else {
                //notyMessageError(data.message);
                $('.ajaxLoading').hide();
                return false;
            }
        }
        $(document).ready(function () {
            $("#start_datetime").datetimepicker({
                todayBtn:  1,
                format: 'yyyy-mm-dd hh:ii:ss',
                autoclose: true,
                startDate: new Date()
            }).on('changeDate', function (selected) {
                console.log(selected.date);
                var minDate = new Date(selected.date.valueOf());
                $('#end_datetime').datetimepicker('setStartDate', minDate);
            });

            $("#end_datetime").datetimepicker({
                        format: 'yyyy-mm-dd hh:ii:ss',
            })
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                        $('#start_datetime').datetimepicker('setEndDate', minDate);
                    });
        });

    </script>
</div>

