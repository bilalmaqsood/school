<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>View Schedule</h2>
            <li><a href="javascript:void(0)" class="pull-right close-link"
                   onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            </li>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            <div id='demo-form2' class="form-horizontal form-label-left">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Days Of Week
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ $row->day_of_week }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Subject
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ $row->subject_name }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Period
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ $row->period_no }}
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

