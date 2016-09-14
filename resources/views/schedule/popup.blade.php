<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Class Schedule</h4>
        </div>
        {!! Form::open(array('url'=>'schedule/savedata', 'class'=>'form-horizontal', 'data-parsley-validate'=>true,'id'=> 'schedule-form')) !!}
        <div class="modal-body">
            <div id="testmodal2" style="padding: 5px 20px;">
                <div class="form-group">
                    <input type="hidden" name="class_id" value="{{ $class_id }}">
                    <input type="hidden" name="day_of_week" value="{{ $day_of_week }}">
                    <input type="hidden" name="period_id" value="{{ $period_id }}">
                    <input type="hidden" name="subject" value="">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Select Grade<span
                                class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <select id="subject" name="subject_id" class="form-control" required>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>


<script type="application/javascript">
    $(document).ready(function(){
        $("#subject").jCombo("{{ URL::to('gradebook/comboselect?filter=tb_subject:id:name')}}",
                {  selected_value : '{{ $subject_id }}' });

        $.listen('parsley:field:validate', function () {
            validateFront();
        });
        $('#schedule-form .btn').on('click', function () {
            $('#schedule-form').parsley().validate();
            validateFront();
            if ($('#schedule-form').parsley().isValid() == true) {
                var options = {
                    dataType: 'html',
                    beforeSubmit: showRequest,
                    success: showResponse
                }
                $('#schedule-form').ajaxSubmit(options);
                return false;

            } else {
                return false;
            }
        });
        var validateFront = function () {
            if (true === $('#schedule-form').parsley().isValid()) {
                $('.bs-callout-info').removeClass('hidden');
                $('.bs-callout-warning').addClass('hidden');
            } else {
                $('.bs-callout-info').addClass('hidden');
                $('.bs-callout-warning').removeClass('hidden');
            }
        };
    });
    function showRequest() {
        //$('.ajaxLoading').show();
    }
    function showResponse(data) {
        window.location.reload();
    }
</script>