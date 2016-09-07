@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Module Permission</h3>
            </div>
            <div class="title_right"></div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Module Permission Managment</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {!! Form::open(array('url'=>'setting/save-dataaccess/', 'class'=>'', 'id'=> 'demo-form2')) !!}

                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                @foreach($groups as $group)
                                    <li role="presentation">
                                        <a href="#tab_content{{ $group->id }}" id="tab-{{ $group->id }}" role="tab" data-toggle="tab" aria-expanded="false">
                                            {{ $group->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <button id="save_changes" class="btn btn-success pull-right">Save Changes</button>

                            <div id="myTabContent" class="tab-content">
                                @foreach($groups as $group)
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content{{ $group->id }}" aria-labelledby="tab-{{ $group->id }}">
                                        <div data-example-id="bordered-table" class="bs-example">
                                            <div data-example-id="bordered-table" class="bs-example">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Modules</th>
                                                        <th>Global</th>
                                                        <th>Listing</th>
                                                        <th>View</th>
                                                        <th>Edit</th>
                                                        <th>Remove</th>
                                                        <th>Add</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(is_array(json_decode($group->data_access)))
                                                        <?php $availableModule = json_decode($group->data_access); ?>
                                                        @for($index = 0; $index < count($modules); $index++)
                                                            @if($availableModule[$index]==1)
                                                            <tr>
                                                                <th scope="row">{{ $index + 1 }}</th>
                                                                <td>{{ $modules[$index] }}</td>

                                                                <?php //echo $group->id[$index]['is_global']; die('here3'); ?>
                                                                <td><input name="permission[{{$group->id}}][{{$index}}][is_global]" type="checkbox" @if($principal[$index] == '1') {{ 'checked' }} @endif></td>
                                                                <td><input name="permission[{{$group->id}}][{{$index}}][is_list]" type="checkbox" @if($registrar[$index] == '1') {{ 'checked' }} @endif></td>
                                                                <td><input name="permission[{{$group->id}}][{{$index}}][is_detail]" type="checkbox" @if($finance[$index] == '1') {{ 'checked' }} @endif></td>
                                                                <td><input name="permission[{{$group->id}}][{{$index}}][is_edit] " type="checkbox" @if($teacher[$index] == '1') {{ 'checked' }} @endif></td>
                                                                <td><input name="permission[{{$group->id}}][{{$index}}][is_remove] " type="checkbox" @if($student[$index] == '1') {{ 'checked' }} @endif></td>
                                                                <td><input name="permission[{{$group->id}}][{{$index}}][is_add] " type="checkbox" @if($student[$index] == '1') {{ 'checked' }} @endif></td>
                                                            </tr>
                                                            @endif
                                                        @endfor
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                        {!! Form::close() !!}
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