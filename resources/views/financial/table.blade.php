<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>List of Fees Payment</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    @if($access['is_add'] ==1)
                        <?php $onclick = " onclick=\"ajaxViewDetail('#" . $pageModule . "',this.href); return false; \""; ?>
                        <a href="{{URL::to($pageModule.'/update') }}"
                           class="btn btn-default btn-teacher " <?php echo $onclick; ?> >Create</a>
                    @endif
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                   cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="text-center">Receipt No</th>
                    <th class="text-center">Purpose</th>
                    <th class="text-center">Total Amount</th>
                    <th class="text-center">Paid</th>
                    <th class="text-center">Due</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rowData as $row)
                    <tr>
                        <td class="text-center ">{{ $row->no }}</td>
                        <td class="text-center ">{{ $row->purpose }}</td>
                        <td class="text-center ">{{ CNF_CURRENCY.' '.$row->amount }}</td>
                        <td class="text-center ">@if($row->status == 1){{ CNF_CURRENCY.' '.($row->amount - $row->due) }}@endif</td>
                        <td class="text-center ">@if($row->due != 0){{ CNF_CURRENCY.' '.$row->due }} @endif</td>
                        <td class="text-center ">
                            @if($row->status == 0)
                                {{ 'Pending' }}
                            @else
                                {{ 'Paid' }}
                            @endif
                        </td>
                        <td data-values="action" data-key="{{ $row->id }}" class="text-center ">
                            @if($access['is_detail'] == 1)
                                <a class="btn btn-xs btn-primary" href="{{ URL::to($pageModule.'/show/'.$row->id) }}"
                                   onclick="ajaxViewDetail('#{{ $pageModule }}',this.href); return false">
                                    <i class="fa fa-folder"></i>
                                    View
                                </a>
                            @endif
                            @if($access['is_edit'] == 1)
                                <a class="btn btn-xs btn-info" href="{{ URL::to($pageModule.'/update/'.$row->id) }}"
                                   onclick="ajaxViewDetail('#{{ $pageModule }}',this.href); return false">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                                @if($row->status == 0)
                                    <a class="btn btn-xs btn-warning" href="javascript://ajax"
                                       onclick="ajaxUpdateStatus('#{{ $pageModule }}','{{ $pageUrl }}', '{{$row->id}}', 0);">
                                        <i class="fa fa-money"></i>
                                        Paid
                                    </a>
                                @else
                                    <a class="btn btn-xs btn-warning" href="javascript://ajax"
                                       onclick="ajaxUpdateStatus('#{{ $pageModule }}','{{ $pageUrl }}', '{{$row->id}}', 1);">
                                        <i class="fa fa-money"></i>
                                        Unpaid
                                    </a>
                                @endif
                            @endif
                            @if($access['is_remove'] == 1)
                                <a onclick="ajaxRemoveRecord('#{{ $pageModule }}','{{ $pageUrl }}', '{{$row->id}}');"
                                   class="btn btn-xs btn-danger" href="javascript://ajax">
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
