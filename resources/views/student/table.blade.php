<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>List of Teachers</h2>
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
                    <th class="text-center">First name</th>
                    <th class="text-center">Last name</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Position</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Mobile No</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
               
                </tbody>
            </table>

        </div>
    </div>
    <script type="text/javascript">
        $('#datatable-responsive').DataTable();
    </script>
</div>
