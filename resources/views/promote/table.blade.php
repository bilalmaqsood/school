<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>List of Current Year Result</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="text-center">Class Name</th>
                    <th class="text-center">Student Name</th>
                    <th class="text-center">First Semester Avg</th>
                    <th class="text-center">Second Semester Avg</th>
                    <th class="text-center">Year Avg</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rowData as $row)
                    <?php $marks = \SiteHelpers::getGrades($row->student_id, $row->class_id );    ?>
                    <tr>
                        <td class="text-center table_td">{{ $row->class_name }}</td>
                        <td class="text-center">{{ $row->student_name }}</td>
                        <td class="text-center">@if($marks[0]->semester_one != 0) {{ round($marks[0]->semester_one) }} @endif</td>
                        <td class="text-center">@if($marks[0]->semester_two != 0) {{ round($marks[0]->semester_two) }} @endif</td>
                        <td class="text-center">@if($marks[0]->final != 0) {{ round($marks[0]->final) }} @endif</td>
                        <td data-values="action" id="{{$row->id}}" data-key="{{ $row->id }}" class="text-center table_td">
                            @if(\Session::get('gid') == 1 && $row->status == 0)
                                @if($marks[0]->semester_one != 0 && $marks[0]->final > 50 && $row->class_status == 1)
                                <a class="btn btn-xs btn-success" href="javascript://ajax"
                                   onclick="ajaxPromote('{{ $pageUrl }}', '#{{ $pageModule }}', '{{$row->id}}', '{{ $row->class_id }}', '-1'); return false">
                                    <i class="fa fa-refresh"></i>
                                    Pass out
                                </a>
                                @elseif($marks[0]->semester_one != 0 && $row->class_status != 1 && $marks[0]->final == 0 && $marks[0]->semester_one > 50)
                                    <span id="current-class-{{ $row->id }}" style="display: none">{{$row->class_id}}</span>
                                    <span id="status-{{ $row->id }}" style="display: none">1</span>
                                    <a class="btn btn-xs btn-info promote" href="javascript://ajax">
                                        <i class="fa fa-refresh"></i>
                                        Promote grade & same year</a>
                                @elseif($marks[0]->final != 0 && $marks[0]->final > 50)
                                    <span id="current-class-{{ $row->id }}" style="display: none">{{$row->class_id}}</span>
                                    <span id="status-{{ $row->id }}" style="display: none">2</span>
                                    <a class="btn btn-xs btn-info promote" href="javascript://ajax">
                                        <i class="fa fa-refresh"></i>
                                        Promote next grade & year</a>
                                @elseif($marks[0]->final != 0 && $marks[0]->final < 50)
                                    <a class="btn btn-xs btn-warning" href="javascript://ajax"
                                       onclick="ajaxPromote('{{ $pageUrl }}', '#{{ $pageModule }}', '{{$row->id}}', '{{ $row->class_id }}', '3'); return false">
                                        <i class="fa fa-refresh"></i>
                                        Promote next year
                                    </a>
                                @endif
                            @endif
                            @if(\Session::get('gid') == 1 && $row->status == -1)
                                    <a class="btn btn-xs btn-info" href="{{ URL::to('gradebook/download-transcript/'.$row->student_id) }}">
                                        <i class="fa fa-refresh"></i>
                                        Download Transcript
                                    </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div id="promoteModalView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel2">Promote Student to next Classs</h4>
                </div>

                {!! Form::open(array('url'=>'promote/promote-student', 'class'=>'form-horizontal', 'data-parsley-validate'=>true,'id'=> 'promote-form')) !!}
                <div class="modal-body">
                    <div id="testmodal2" style="padding: 5px 20px;">
                        <input id="hidden_class" type="hidden" name="class_id" value="">
                        <input id="hidden_status" type="hidden" name="status" value="">
                        <input id="hidden_id" type="hidden" name="id" value="">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Select Class<span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select id="class" name="promote_class" class="form-control" required>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-success" id="promote-class">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
<script type="text/javascript">
    $('#datatable-responsive').DataTable();
    $('.promote').on('click', (function(){
        var rowID = $(this).parent("td").attr("id");
        var currentClass = $('#current-class-'+rowID).text();
        var status = $('#status-'+rowID).text();
        $("#hidden_class").val(currentClass);
        $("#hidden_status").val(status);
        $("#hidden_id").val(rowID);
        $("#class").jCombo("{{ URL::to('gradebook/comboselect?filter=tb_class:id:name') }}");
        $('#promoteModalView').modal('show');
    }));

    $(document).ready(function() {
        $.listen('parsley:field:validate', function () {
            validateFront();
        });
        $('#promote-form #promote-class').on('click', function () {
            $('#promote-form').parsley().validate();
            validateFront();
            if ($('#promote-form').parsley().isValid() == true) {
                var options = {
                    dataType: 'json',
                    beforeSubmit: showRequest,
                    success: showResponse
                }
                $('#promote-form').ajaxSubmit(options);
                return false;

            } else {
                return false;
            }
        });
        var validateFront = function () {
            if (true === $('#promote-form').parsley().isValid()) {
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
        if(data.status == 'success' )
        {
            $('.ajaxLoading').hide();
            $('#promoteModalView').modal('hide');
            notyMessage(data.message);
            ajaxFilter( '#{{ $pageModule }}' ,'{{ $pageModule }}/data' );
        } else {
            $('.ajaxLoading').hide();
            $('#promoteModalVie').modal('hide');
            notyMessageError(data.message);
        }
    }
</script>
</div>