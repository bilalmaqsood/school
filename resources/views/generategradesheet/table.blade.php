<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>List of Current Year Classes</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="text-center">Class Name</th>
                    <th class="text-center">Total Students</th>
                    <th class="text-center">Total Subjects</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rowData as $row)
                    <tr>
                        <td class="text-center table_td">{{ $row->name }}</td>
                        <td class="text-center">{{ $row->total }}</td>
                        <td class="text-center"><?php $total_subjects = \SiteHelpers::total_subjects($row->class_id); echo $total_subjects; ?></td>
                        <td data-values="action" data-key="{{ $row->id }}" class="text-center table_td">
                            @if(\Session::get('gid') == 1 && $total_subjects != 0 && $row->total != 0)
                                <a class="btn btn-xs btn-info" href="{{ URL::to($pageModule.'/create-grade-sheet/') }}"
                                   onclick="ajaxGeneric('{{$row->class_id}}',this.href); return false">
                                    <i class="fa fa-refresh"></i>
                                    Generate
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