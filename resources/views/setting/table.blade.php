<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>List of Years</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    @if(\Session::get('gid') == 1)
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
                    <th class="text-center" style="width:40%">Name</th>
                    <th class="text-center" style="width:40%">Year</th>
                    <th class="text-center" style="width:20%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rowData as $row)
                    <tr>
                        <td class="text-center ">{{ $row->name }}</td>
                        <td class="text-center ">{{ $row->year }}</td>
                        <td data-values="action" data-key="{{ $row->id }}" class="text-center ">
                            @if(\Session::get('gid') == 1)
                                <a class="btn btn-xs btn-info" href="{{ URL::to($pageModule.'/update/'.$row->id) }}" onclick="ajaxViewDetail('#{{ $pageModule }}',this.href); return false">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                            @endif
                            @if(\Session::get('gid') == 1)
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
