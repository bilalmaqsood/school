<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>List of receipts</h2>
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
                    @if($row->status != 0)
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
                                <a class="btn btn-xs btn-primary" href="javascript://ajax">
                                <i class="fa fa-download"></i>
                                    Download
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $('#datatable-responsive').DataTable();
    </script>
</div>
