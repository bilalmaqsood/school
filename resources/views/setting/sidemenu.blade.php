@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Side Menu Permission</h3>
            </div>
            <div class="title_right">

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Side Menu Permission</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                                                                          data-toggle="tab" aria-expanded="true">Side
                                        Menu Module</a>
                                </li>

                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                     aria-labelledby="home-tab">

                                    {!! Form::open(array('url'=>'setting/save-side-menu-data/', 'class'=>'form-horizontal form-label-left', 'id'=> 'demo-form2')) !!}
                                    <div data-example-id="bordered-table" class="bs-example">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Modules</th>
                                                <th>Principal</th>
                                                <th>Registrar</th>
                                                <th>Finance Officer</th>
                                                <th>Teacher</th>
                                                <th>Student</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for($index = 0; $index < count($modules); $index++)
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>{{ $modules[$index] }}</td>
                                                    <td><input name="principal[{{$index}}]" type="checkbox" @if($principal[$index] == '1') {{ 'checked' }} @endif></td>
                                                    <td><input name="registrar[{{$index}}]" type="checkbox" @if($registrar[$index] == '1') {{ 'checked' }} @endif></td>
                                                    <td><input name="finance[{{$index}}]" type="checkbox" @if($finance[$index] == '1') {{ 'checked' }} @endif></td>
                                                    <td><input name="teacher[{{$index}}]" type="checkbox" @if($teacher[$index] == '1') {{ 'checked' }} @endif></td>
                                                    <td><input name="student[{{$index}}]" type="checkbox" @if($student[$index] == '1') {{ 'checked' }} @endif></td>
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                        <button id="save_changes" class="btn btn-success pull-right">Save Changes</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#demo-form2 #save_changes').on('click', function () {
                var this_master = $("#demo-form2");
                this_master.find('input[type="checkbox"]').each( function () {
                    var checkbox_this = $(this);
                    console.log(checkbox_this);

                    if( checkbox_this.is(":checked") == true ) {
                        checkbox_this.attr('value','1');
                    } else {
                        //checkbox_this.prop('checked',true);
                        //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA
                        checkbox_this.attr('value','2');
                    }
                })
                var options = {
                    dataType: 'json',
                    beforeSubmit: showRequest,
                    success: showResponse
                }
                $('#demo-form2').ajaxSubmit(options);
                return false;
            });
        });

        function showRequest() {
            //$('.ajaxLoading').show();
        }
        function showResponse(data) {

            if (data.status == 'success') {
                window.location.reload();
            } else {
                //notyMessageError(data.message);
                $('.ajaxLoading').hide();
                return false;
            }
        }
    </script>
@endsection