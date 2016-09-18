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
                    <?php $marks = \SiteHelpers::getGrades($row->student_id);    ?>
                    <tr>
                        <td class="text-center table_td">{{ $row->class_name }}</td>
                        <td class="text-center">{{ $row->student_name }}</td>
                        <td class="text-center">@if($marks[0]->semester_one != 0) {{ $marks[0]->semester_one }} @endif</td>
                        <td class="text-center">@if($marks[0]->semester_two != 0) {{ $marks[0]->semester_two }} @endif</td>
                        <td class="text-center">@if($marks[0]->final != 0) {{ $marks[0]->final }} @endif</td>
                        <td data-values="action" data-key="{{ $row->id }}" class="text-center table_td">
                            @if(\Session::get('gid') == 1 && $row->status == 0)
                                @if($marks[0]->semester_one != 0 && $marks[0]->final > 50 && $row->class_name == 20)
                                <a class="btn btn-xs btn-success" href="{{ URL::to($pageModule.'/create-grade-sheet/') }}"
                                   onclick="ajaxGeneric('{{$row->id}}',this.href); return false">
                                    <i class="fa fa-refresh"></i>
                                    Pass out
                                </a>
                                @elseif($marks[0]->semester_one != 0 && $marks[0]->final == 0)
                                    <a class="btn btn-xs btn-success" href="{{ URL::to($pageModule.'/create-grade-sheet/') }}"
                                       onclick="ajaxGeneric('{{$row->id}}',this.href); return false">
                                        <i class="fa fa-refresh"></i>
                                        Promote grade & same year
                                    </a>
                                @elseif($marks[0]->final != 0 && $marks[0]->final > 50)
                                    <a class="btn btn-xs btn-info" href="{{ URL::to($pageModule.'/create-grade-sheet/') }}"
                                       onclick="ajaxGeneric('{{$row->id}}',this.href); return false">
                                        <i class="fa fa-refresh"></i>
                                        Promote next grade & year
                                    </a>
                                @elseif($marks[0]->final != 0 && $marks[0]->final < 50)
                                    <a class="btn btn-xs btn-warning" href="{{ URL::to($pageModule.'/create-grade-sheet/') }}"
                                       onclick="ajaxGeneric('{{$row->id}}',this.href); return false">
                                        <i class="fa fa-refresh"></i>
                                        Promote next year
                                    </a>
                                @endif
                            @endif
                            @if(\Session::get('gid') == 1 && $row->status == 2)
                                    <a class="btn btn-xs btn-info" href="{{ URL::to($pageModule.'/create-grade-sheet/') }}"
                                       onclick="ajaxGeneric('{{$row->id}}',this.href); return false">
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
<script type="text/javascript">
    $('#datatable-responsive').DataTable();
</script>
</div>