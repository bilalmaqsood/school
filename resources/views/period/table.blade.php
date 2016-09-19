<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>List of Periods</h2>
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
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Start Time</th>
                    <th class="text-center">End Time</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rowData as $index => $row)
                    <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td class="text-center">{{ $row->name }}</td>
                        <td class="text-center">@if($row->start_time != '00:00:00'){{date(CNF_TIMEFORMAT,strtotime($row->start_time))}} @endif</td>
                        <td class="text-center">@if($row->start_time != '00:00:00'){{date(CNF_TIMEFORMAT,strtotime($row->end_time))}} @endif</td>
                        <td data-values="action" data-key="{{ $row->id }}" class="text-center">
                            @if($access['is_edit'] == 1)
                                <a class="btn btn-xs btn-info" href="{{ URL::to($pageModule.'/update/'.$row->id) }}" onclick="ajaxViewDetail('#{{ $pageModule }}',this.href); return false">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                            @endif
                            @if($access['is_remove'] == 1)
                                <a onclick="ajaxRemoveRecord('#{{ $pageModule }}','{{ $pageUrl }}', '{{$row->id}}');" class="btn btn-xs btn-danger" href="javascript://ajax" >
                                    <i class="fa fa-trash-o"></i>
                                    Delete
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
