<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Select Student</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            {!! Form::open(array('url'=>'gradebook/transcript-sheet/', 'class'=>'form-horizontal', 'data-parsley-validate'=>true,'id'=> 'grademarks-form')) !!}
            <div class="col-md-6 col-sm-9 col-xs-12 form-group">
                <label for="class">Class * :</label>
                <select id="class" name="class" class="form-control" required>
                </select>
            </div>
            <div class="col-md-6 col-sm-9 col-xs-12 form-group">
                <label for="semester">Student * :</label>
                <select id="student" name="student" class="form-control" required>
                </select>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                <button type="submit" class="btn btn-success">View Transcript</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#class").jCombo("{{ URL::to('gradebook/comboselect?filter=tb_class:id:name') }}");
        $("#student").jCombo("{{ URL::to('gradebook/comboselectstudent?filter=tb_students:student_id:name')}}&parent=class_id:",
                { parent: '#class'});
        $.listen('parsley:field:validate', function () {
            validateFront();
        });
        $('#grademarks-form .btn').on('click', function () {
            $('#grademarks-form').parsley().validate();
            validateFront();
            if ($('#grademarks-form').parsley().isValid() == true) {
                var options = {
                    dataType: 'html',
                    beforeSubmit: showRequest,
                    success: showResponse
                }
                $('#grademarks-form').ajaxSubmit(options);
                return false;

            } else {
                return false;
            }
        });
        var validateFront = function () {
            if (true === $('#grademarks-form').parsley().isValid()) {
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
        $('#{{$pageModule}}View').html( data );
        $('#{{$pageModule}}Grid').hide( );
    }

</script>
