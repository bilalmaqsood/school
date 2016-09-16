<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>View Event</h2>
            <li><a href="javascript:void(0)" class="pull-right close-link"
                   onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            </li>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            <div id='demo-form2' class="form-horizontal form-label-left">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 p-t-0" for="first-name">Title
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ $row->title }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 p-t-0" for="description">Description
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ $row->body }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 p-t-0" for="first-name">Venue
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ $row->venue }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 p-t-0" for="first-name">Start Date & Time
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        
                        {{ date(CNF_DATEFORMAT,strtotime($row->start_datetime)) }}  {{date(CNF_TIMEFORMAT,strtotime($row->start_datetime))}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 p-t-0" for="first-name">End Date & Time
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        
                        {{ date(CNF_DATEFORMAT,strtotime($row->end_datetime)) }}  {{date(CNF_TIMEFORMAT,strtotime($row->end_datetime))}}
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

