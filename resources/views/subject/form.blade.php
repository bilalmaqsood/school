<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>New Class</h2>
            <li><a href="javascript:void(0)" class="pull-right close-link" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            </li>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            {!! Form::open(array('url'=>'subject/save/'.SiteHelpers::encryptID($row['id']), 'class'=>'form-horizontal form-label-left', 'data-parsley-validate'=>true,'id'=> 'demo-form2')) !!}
            {!! Form::hidden('id', $row['id'],array('class'=>'form-control','required' => true)) !!}
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="name">Name * :</label>
                {!! Form::text('name', $row['name'],array('class'=>'form-control', 'placeholder'=>'Name', 'required' => true)) !!}
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="name">Class * :</label>
            @if(!empty($row['class_id']))
                        {!! Form::select('class_id', $classes,$row['class_id'],array('class'=>'form-control', 'placeholder'=>'Select Class', 'required' => true)) !!}
                    @else
                        {!! Form::select('class_id', $classes,'',array('class'=>'form-control', 'placeholder'=>'Select Class', 'required' => true)) !!}
                    @endif
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="name">Teacher * :</label>
                @if(!empty($row['teacher_id']))
                    {!! Form::select('teacher_id', $teacher ,$row['teacher_id'],array('class'=>'form-control', 'placeholder'=>'Select Teacher', 'required' => true)) !!}
                @else
                    {!! Form::select('teacher_id', $teacher ,'',array('class'=>'form-control', 'placeholder'=>'Select Teacher', 'required' => true)) !!}
                @endif
            </div>

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

