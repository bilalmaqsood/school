<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>List of Class</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    @if($access['is_add'] ==1)
                        <?php $onclick = " onclick=\"ajaxViewDetail('#".$pageModule."',this.href); return false; \"" ; ?>
                        <a href="{{URL::to($pageModule.'/update') }}" class="btn btn-default btn-teacher " <?php echo $onclick; ?> >Create</a>
                    @endif
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Division</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rowData as $row)
                    <tr>
                        <td class="text-center table_td">{{ $row->name }}</td>
                        <td class="text-center table_td">{{ $row->division_name }}</td>
                        <td data-values="action" data-key="{{ $row->id }}" class="text-center table_td">
                            @if($access['is_detail'] == 1)
                                <a class="btn btn-sm btn-primary" href="{{ URL::to($pageModule.'/show/'.$row->id) }}" onclick="ajaxViewDetail('#{{ $pageModule }}',this.href); return false">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endif
                            @if($access['is_edit'] == 1)
                                <a class="btn btn-sm btn-warning" href="{{ URL::to($pageModule.'/update/'.$row->id) }}" onclick="ajaxViewDetail('#{{ $pageModule }}',this.href); return false">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endif
                            @if($access['is_remove'] == 1)
                                <a onclick="ajaxRemoveRecord('#{{ $pageModule }}','{{ $pageUrl }}', '{{$row->id}}');" class="btn btn-sm btn-danger" href="javascript://ajax" >
                                    <i class="fa fa-trash-o"></i>
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
