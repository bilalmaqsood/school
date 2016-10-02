@extends('layouts.app')
@section('content')
    <link href="{{ asset('crop/main.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('crop/main.js') }}"></script>
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><small>{{ $pageTitle }}</small></h3>
            </div>
            <div class="title_right">
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- Begin Content -->
        <div class="row">
            <div class="ajaxLoading"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                      <h2>User Profile</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        {!! Form::open(
                            array(
                            'url'=>'profile/update/'.SiteHelpers::encryptID($row->id),
                            'method' => 'post',
                             'class'=>'form-horizontal form-label-left input_mask',
                             'files' => true ,
                             'parsley-validate'=>true,
                             'novalidate'=>' ',
                             'id'=> 'customerFormAjax')
                        ) !!}
                        {!! Form::hidden('avatar', $row->avatar,array('id'=>'avatar','class'=>'form-control', 'placeholder'=>'avatar ','required'=>'required' )) !!}

                        <div class="x_content">
                            <table class="personal_details" >
                                {!! Form::hidden('password', '', array('id'=>'form-password')) !!}
                                <tr>
                                  <td><label>Last Name</label></td>
                                  <td>{!! Form::text('last_name', $row->last_name , array('class'=>'form-control', 'placeholder'=>'Last Name','required'=>'required' )) !!}</td>

                                </tr>

                                <tr>
                                  <td><label >Middle Name </label>  </td>
                                  <td>{!! Form::text('middle_name',$row->middle_name, array('class'=>'form-control', 'placeholder'=>'Middle Name','required'=>'required' )) !!}</td>

                                </tr>
                                <tr>
                                  <td><label>First Name</label></td>
                                  <td>{!! Form::text('first_name',$row->first_name, array('class'=>'form-control', 'placeholder'=>'First Name','required'=>'required' )) !!}</td>
                                  </tr>
                                <tr>
                                  <td><label>Mobile No</label></td>
                                  <td>{!! Form::text('mobile_number',$row->mobile_number,array('class'=>'form-control', 'placeholder'=>'0111-123456 ','required'=>true, 'data-parsley-pattern'=>'^(\d{4})[-]*(\d{6,7})$' )) !!}</td>
                                </tr>
                                <tr>
                                  <td><label>Phone No</label></td>
                                  <td>{!! Form::text('phone_number', $row->phone_number,array('class'=>'form-control', 'placeholder'=>'0111-123456', 'data-parsley-pattern'=>'^(\d{4})[-]*(\d{6,7})$' )) !!}</td>
                                </tr>
                                <tr>
                                  <td><label>Email</label></td>
                                  <td>{!! Form::email('email',$row->email, array('class'=>'form-control', 'placeholder'=>'Email','required'=>'required',"disabled"=>"true" )) !!}</td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Change password</button>
                                    <button type="submit" class="btn btn-success" id="submit-btn">Save Changes</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-offset-1 col-sm-offset-1 col-lg-offset-1 col-md-3 col-sm-3 col-xs-12 profile_left col-xs-offset-0 " style="margin-top: 25px;">
                        <div class="profile_img">
                            <!-- end of image cropping -->
                            <div class="container" id="crop-avatar">
                            <!-- Current avatar -->
                            <div class="avatar-view" title="Change the avatar">
                                {!! SiteHelpers::showUploadedProfileIamge($row->avatar,'/', 'md-card-head-avatar',150,150) !!}
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
                            <!-- end of image cropping -->

                        </div>
                     </div>

                    <!—- Modal For Password -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Change password</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="item col-md-3 col-sm-3 col-xs-12 form-group has-feedback text-xs-left text-sm-right">
                                        <label class="form-group ">Password *:</label>
                                    </div>
                                    <div class="item col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input id="popup-pass" type="password" name="popup-password" placeholder="password" class="form-control" value="">
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-cancel m-t-5" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success btn-save" data-dismiss="modal" id="pop-password">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
 <script>
 $(document).ready(function() {
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

        $(".btn-cancel").on("click",function(){
            $("#popup-pass").val('');
            $('#form-password').val('');
        });

     $("#pop-password").on("click",function(){
         var pass= $("#popup-pass").val();
         if(pass != '')
            $('#form-password').val(pass);
     });

        });


        function showRequest()
        {
            $('.ajaxLoading').show();
        }
        function showResponse(data)  {
            $("#popup-pass").val('');
            $('#form-password').val('');
            if(data.status == 'success')
            {
            $('.ajaxLoading').hide();
                notyMessage(data.message);
            } else {
                notyMessageError(data.message);
                $('.ajaxLoading').hide();
                return false;
            }
        }


</script>
    <!-- End Content -->
    </div>
@endsection