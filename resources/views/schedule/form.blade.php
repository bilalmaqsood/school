<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                @if(empty($row['id']))
                    New
                @else
                    Edit
                @endif
                    Schedule
            </h2>
            <li><a href="javascript:void(0)" class="pull-right close-link" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            </li>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            {!! Form::open(array('url'=>'schedule/save/'.SiteHelpers::encryptID($row['id']), 'class'=>'form-horizontal form-label-left', 'data-parsley-validate'=>true,'id'=> 'demo-form2')) !!}
            {!! Form::hidden('id', $row['id'],array('class'=>'form-control','required' => true)) !!}

            <div class="form-group">
                <div class="col-md-2 col-sm-4 col-xs-6 col-md-offset-2">
                    <label for="name">Days of week * :</label>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    {!! Form::select('day_of_week', $weekDays ,$row['day_of_week'],array('class'=>'form-control', 'placeholder'=>'Select Days of Week', 'required' => true)) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2 col-sm-4 col-xs-6 col-md-offset-2">
                    <label for="name">Subject * :</label>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    @if(!empty($row['subject_id']))
                        {!! Form::select('subject_id', $subjects,$row['subject_id'],array('class'=>'form-control', 'placeholder'=>'Select Subject', 'required' => true)) !!}
                    @else
                        {!! Form::select('subject_id', $subjects,'',array('class'=>'form-control', 'placeholder'=>'Select Subject', 'required' => true)) !!}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2 col-sm-4 col-xs-6 col-md-offset-2">
                    <label for="name">Period * :</label>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    @if(!empty($row['period_id']))
                        {!! Form::select('period_id', $periods ,$row['period_id'],array('class'=>'form-control', 'placeholder'=>'Select Period', 'required' => true)) !!}
                    @else
                        {!! Form::select('period_id', $periods ,'',array('class'=>'form-control', 'placeholder'=>'Select Period', 'required' => true)) !!}
                    @endif
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="ajaxViewClose('#{{ $pageModule }}')">Cancel</a>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $.listen('parsley:field:validate', function() {
                validateFront();
            });
            $('#demo-form2 .btn').on('click', function() {
                $('#demo-form2').parsley().validate();
                validateFront();
                if($('#demo-form2').parsley().isValid() == true){
                    var options = {
                        dataType:      'json',
                        beforeSubmit :  showRequest,
                        success:       showResponse
                    }
                    $('#demo-form2').ajaxSubmit(options);
                    return false;

                } else {
                    return false;
                }
            });
            var validateFront = function() {
                if (true === $('#demo-form2').parsley().isValid()) {
                    $('.bs-callout-info').removeClass('hidden');
                    $('.bs-callout-warning').addClass('hidden');
                } else {
                    $('.bs-callout-info').addClass('hidden');
                    $('.bs-callout-warning').removeClass('hidden');
                }
            };
        });


        function showRequest()
        {
            $('.ajaxLoading').show();
        }
        function showResponse(data)  {

            if(data.status == 'success')
            {
                ajaxViewClose('#{{ $pageModule }}');
                ajaxFilter('#{{ $pageModule }}','{{ $pageUrl }}/data');
                //notyMessage(data.message);
                $('#sximo-modal').modal('hide');
            } else {
                //notyMessageError(data.message);
                $('.ajaxLoading').hide();
                return false;
            }
        }
          $(document).ready(function() {

      $('#date_of_birth').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
            $('#register_date').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });


    });

    </script>
</div>

