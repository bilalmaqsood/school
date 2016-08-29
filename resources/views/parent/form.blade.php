<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>New Teacher</h2>
            <li><a href="javascript:void(0)" class="pull-right close-link" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            </li>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            {!! Form::open(array('url'=>'parents/save/'.SiteHelpers::encryptID($row['id']), 'class'=>'form-horizontal form-label-left', 'data-parsley-validate'=>true,'id'=> 'demo-form2')) !!}
            {!! Form::hidden('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'Last Name', 'required' => true)) !!}
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">Last Name * :</label>
                {!! Form::text('last_name', $row['last_name'],array('class'=>'form-control', 'placeholder'=>'Last Name', 'required' => true)) !!}
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">Middle Name * :</label>
                {!! Form::text('middle_name', $row['middle_name'],array('class'=>'form-control', 'placeholder'=>'Middle Name', 'required' => true)) !!}
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">First Name * :</label>
                {!! Form::text('first_name', $row['first_name'],array('class'=>'form-control', 'placeholder'=>'First Name', 'required' => true)) !!}
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">Email * :</label>
                {!! Form::email('email', $row['email'],array('class'=>'form-control', 'placeholder'=>'Email', 'required' => true)) !!}
            </div>
            
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">Nationality * :</label>
                {!! Form::text('nationality', $row['nationality'],array('class'=>'form-control', 'placeholder'=>'Nationality', 'required' => true)) !!}
            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                            <label>Religion *:</label>
                    {!! Form::text('religion', "", /* $row['id'],*/ array('class'=>'form-control', 'placeholder'=>'Religion ','required'=>'required' )) !!}
                 </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">Community * :</label>
                {!! Form::text('community', $row['community'],array('class'=>'form-control', 'placeholder'=>'Community', 'required' => true)) !!}
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">City * :</label>
                {!! Form::text('city', $row['city'],array('class'=>'form-control', 'placeholder'=>'city', 'required' => true)) !!}
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">'
                <label for="fullname">County * :</label>
                {!! Form::text('country', $row['country'],array('class'=>'form-control', 'placeholder'=>'country', 'required' => true)) !!}
            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                   <label>Country of Origin *:</label>
                    {!! Form::text('county_of_origin',$row['county_of_origin'], array('class'=>'form-control', 'placeholder'=>'Country of Origin','required'=>'required' )) !!}
               </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">Phone Number * :</label>
                {!! Form::text('phone_number', $row['phone_number'],array('class'=>'form-control', 'placeholder'=>'Phone Number', 'required' => true)) !!}
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">Mobile Number * :</label>
                {!! Form::text('mobile_number', $row['mobile_number'],array('class'=>'form-control', 'placeholder'=>'Mobile Number', 'required' => true)) !!}
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label for="fullname">Occupcation * :</label>
                {!! Form::text('occupcation', $row['occupcation'],array('class'=>'form-control', 'placeholder'=>'Occupcation', 'required' => true)) !!}
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
            <div class="control-group">
            <div class="controls">
                <label for="fullname">Date of Birth * :</label>
                <div class=" xdisplay_inputx form-group has-feedback">
                {!! Form::text('date_of_birth', $row['date_of_birth'],array('id'=>'date_of_birth','class'=>'form-control has-feedback-left', 'aria-describedby' => 'inputSuccess2Status','placeholder'=>'Date of Birth', 'required' => true)) !!}
                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span><span id="inputSuccess2Status" class="sr-only">(success)</span>
            </div>
            </div>
                    </div>
                    </div>

            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                      <label>Gender *:</label>
                    <p>
                      M:
                      <input type="radio" class="flat" name="gender" id="genderM" value="M" checked="" required /> F:
                      <input type="radio" class="flat" name="gender" id="genderF" value="F" />
                    </p>

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
            


    });

    </script>
</div>

