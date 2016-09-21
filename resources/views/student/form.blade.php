<link href="{{ asset('crop/main.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('crop/main.js') }}"></script>
<div class="col-md-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            @if($row['id'] != '')
                <h2>Edit Student</h2>
            @else
                <h2>New Student</h2>
            @endif
            <a href="javascript:void(0)" class="pull-right close-link" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            <div class="clearfix"></div>
        </div>
        <div class="container" id="crop-avatar">
            <!-- Current avatar -->
            <div class="avatar-view" title="Change the avatar">
                {!! SiteHelpers::showUploadedProfileIamge($row['avatar'],'/', 'md-card-head-avatar',150,150) !!}
            </div>

            <!-- Cropping modal -->
            <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        {!! Form::open(
                            array(
                            'url'=>'imagecrop',
                            'method' => 'post',
                             'class'=>'avatar-form',
                             'files' => true ,
                             'parsley-validate'=>true,
                             'novalidate'=>' ',)
                             ) !!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="avatar-modal-label">Change Image</h4>
                        </div>
                        <div class="modal-body">
                            <div class="avatar-body">

                                <!-- Upload image and data -->
                                <div class="avatar-upload">
                                    <input type="hidden" class="avatar-src" name="avatar_src">
                                    <input type="hidden" class="avatar-data" name="avatar_data">
                                    <label for="avatarInput">Local upload</label>
                                    <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                                </div>

                                <!-- Crop and preview -->
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="avatar-wrapper"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="avatar-preview preview-lg"></div>
                                        <div class="avatar-preview preview-md"></div>
                                        <div class="avatar-preview preview-sm"></div>
                                    </div>
                                </div>

                                <div class="row avatar-btns">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div><!-- /.modal -->
        </div>
        <hr/>
        {!! Form::open(
            array(
            'url'=>'student/save/'.SiteHelpers::encryptID($row['id']),
            'method' => 'post',
             'class'=>'form-horizontal form-label-left input_mask',
             'files' => true ,
             'parsley-validate'=>true,
             'novalidate'=>' ',
             'id'=> 'customerFormAjax')
        ) !!}
        <div class="x_content">
            {!! Form::hidden('id', $row['id']) !!}
            {!! Form::hidden('user_id', $row['user_id']) !!}
            {!! Form::hidden('group_id', 6) !!}
            {!! Form::hidden('student_id', $row['student_id']) !!}
            {!! Form::hidden('status', 1) !!}
            {!! Form::hidden('avatar', $row['avatar'],array('id'=>'avatar','class'=>'form-control', 'placeholder'=>'avatar ','required'=>'required' )) !!}

            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Last name *:</label>
                {!! Form::text('last_name', $row['last_name'] , array('class'=>'form-control', 'placeholder'=>'Last Name','required'=>'required' )) !!}
            </div>
            <div class=" col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Middle name *:</label>
                {!! Form::text('middle_name',  $row['middle_name'], array('class'=>'form-control', 'placeholder'=>'Middle Name','required'=>'required' )) !!}
            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>First name *:</label>
                {!! Form::text('first_name',  $row['first_name'], array('class'=>'form-control', 'placeholder'=>'First Name','required'=>'required' )) !!}
            </div>
            <div class="clearfix"></div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Gender *:</label>
                <p>

                    Male: <input type="radio" class="flat" name="gender" id="genderM" value="1" @if($row['gender'] == 1) {{ 'checked=""' }} @endif required />
                    Female: <input type="radio" class="flat" name="gender" id="genderF" value="2" @if($row['gender'] == 2) {{ 'checked=""' }} @endif />
                </p>

            </div>
            <div class=" col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Email *:</label>
                 @if($row['email']!="")
                {!! Form::email('email',  $row['email'], array('class'=>'form-control', 'placeholder'=>'Email','disabled'=>'disabled' )) !!}
                @else
                {!! Form::email('email',  $row['email'], array('class'=>'form-control', 'placeholder'=>'Email','required'=>'required' )) !!}
                @endif

            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Password *:</label>
                {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password' )) !!}
            </div>
            <div class="clearfix"></div>
            <div class=" item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <div class="control-group">
                    <div class="controls">
                        <label>Date of Birth *:</label>
                        <div class=" xdisplay_inputx form-group has-feedback">
                            {!! Form::text('date_of_birth',  $row['date_of_birth'], array('id'=>'date_of_birth','class'=>'form-control has-feedback-left','aria-describedby' => 'inputSuccess2Status' ,'placeholder'=>'Date of Birth','required'=>'required' )) !!}<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span><span id="inputSuccess2Status" class="sr-only">(success)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Country *:</label>
                {!! Form::text('country',$row['country'], array('class'=>'form-control', 'placeholder'=>'Country','required'=>'required' )) !!}
            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>State *:</label>
                {!! Form::text('county_of_origin',$row['county_of_origin'], array('class'=>'form-control', 'placeholder'=>'State','required'=>'required' )) !!}
            </div>
            <div class="clearfix"></div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Nationality *:</label>
                {!! Form::text('nationality', $row['nationality'], array('class'=>'form-control', 'placeholder'=>'Nationality','required'=>'required' )) !!}

            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Religion *:</label>
                {!! Form::text('religion', $row['religion'], array('class'=>'form-control', 'placeholder'=>'Religion ','required'=>'required' )) !!}
            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Mobile No *:</label>
                {!! Form::text('mobile_number', $row['mobile_number'],array('class'=>'form-control contact', 'placeholder'=>'0111-123456','required'=>'required','data-parsley-pattern'=>'^(\d{4})[-]*(\d{6,7})$' )) !!}
            </div>
            <div class="clearfix"></div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Phone No :</label>
                {!! Form::text('phone_number', $row['phone_number'],array('class'=>'form-control contact', 'placeholder'=>'0111-123456', 'data-parsley-pattern'=>'^\d{10}$')) !!}
            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Community*:</label>
                {!! Form::text('community', $row['community'],array('class'=>'form-control', 'placeholder'=>'Community ','required'=>'required' )) !!}
            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>City *:</label>
                {!! Form::text('city', $row['city'],array('class'=>'form-control', 'placeholder'=>'City ','required'=>'required' )) !!}
            </div>
            <div class="clearfix"></div>
            <div class=" item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <div class="control-group">
                    <div class="controls">
                        <label>Admission Date *:</label>
                        <div class=" xdisplay_inputx form-group has-feedback">
                            {!! Form::text('register_date',  $row['register_date'], array('id'=>'register_date','class'=>'form-control has-feedback-left','aria-describedby' => 'inputSuccess2Status' ,'placeholder'=>'Admission','required'=>'required' )) !!}<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span><span id="inputSuccess2Status" class="sr-only">(success)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Parent *:</label>
                <select name="parent_id" id="parent-autocomplete" class="select2_single form-control" required>
                    <option value="">Select Parent</option>
                    @foreach($parents as $parent)
                        <option value="{{$parent->id}}" @if($parent->id == $row['parent_id']) {{'selected'}} @endif>{{ ucwords($parent->last_name.' '.$parent->first_name) }}</option>
                    @endforeach
                </select>

            </div>
            <div class="item col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <label>Class *:</label>
                @if($row['class_id'] != '')
                    <input type="hidden" name="class_id" value="{{  $row['class_id'] }}">
                @endif
                <select name="class_id" id="class-autocomplete" class="select2_single form-control" required @if($row['class_id'] != '') {{ 'disabled' }} @endif>
                    <!--<option value="">Select Class</option>-->
                    @foreach($classes as $class)
                        <option value="{{$class->id}}" @if($class->id == $row['class_id']) {{'selected'}} @endif>{{ ucwords($class->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="ajaxViewClose('#{{ $pageModule }}')">Cancel</a>
                    <button type="submit" class="btn btn-success" id="submit-btn">Submit</button>

                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $.listen('parsley:field:validate', function() {
                validateFront();
            });

            $('#submit-btn').on('click', function() {
                $('#customerFormAjax').parsley().validate();
                validateFront();
                if($('#customerFormAjax').parsley().isValid() == true){
                    var options = {
                        dataType:      'json',
                        beforeSubmit :  showRequest,
                        success:       showResponse
                    }
                    $('#customerFormAjax').ajaxSubmit(options);
                    return false;

                } else {
                    return false;
                }
            });
            var validateFront = function() {
                if (true === $('#customerFormAjax').parsley().isValid()) {
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
                notyMessage(data.message);
                $('#sximo-modal').modal('hide');
            } else {
                notyMessageError(data.message);
                $('.ajaxLoading').hide();
                return false;
            }
        }
        $(document).ready(function() {
            $("#parent-autocomplete").select2({
                placeholder: "Select Parent",
                allowClear: true
            });
            $("#class-autocomplete").select2({
                placeholder: "Select Class",
                allowClear: true
            });
            $('#date_of_birth').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_1",
                format: 'YYYY-MM-DD',
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#register_date').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_1",
                format: 'YYYY-MM-DD',
            }, function(start, end, label) {
            });

            $(".contact").on('change', function(e) {
            $(this).parsley().validate() ;
        });

        });
    </script>

</div>