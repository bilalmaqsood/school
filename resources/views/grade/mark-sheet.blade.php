<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Select Class & Student</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            {!! Form::open(array('url'=>'', 'class'=>'form-horizontal', 'data-parsley-validate'=>true,'id'=> 'gradesheet-form')) !!}
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                <label for="class">Class * :</label>
                <select id="class" name="class" class="form-control" required>
                </select>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                <label for="semester">Student * :</label>
                <select id="student" name="student" class="form-control" required>
                </select>
            </div>
            <input type="hidden" name="teacher" value="{{ Session::get('uid') }}">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group text-center">
                <button type="submit" class="btn btn-success">Show GradeSheet</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#class").jCombo("{{ URL::to('gradesheet/comboselect?filter=tb_class:id:name') }}");
            $("#student").jCombo("{{ URL::to('gradesheet/comboselect?filter=tb_students:id:first_name')}}&parent=class_id:",
                    {parent: '#class'});

            $("#student").change(function() {
                var action = $(this).val();
                $("#gradesheet-form").attr("action", "gradesheet/show/" + action);
            });

            $.listen('parsley:field:validate', function () {
                validateFront();
            });
            $('#gradesheet-form .btn').on('click', function () {
                $('#grademarks-form').parsley().validate();
                validateFront();
                if ($('#gradesheet-form').parsley().isValid() == true) {
                    var options = {
                        dataType: 'html',
                        beforeSubmit: showRequest,
                        success: showResponse
                    }
                    $('#gradesheet-form').ajaxSubmit(options);
                    return false;

                } else {
                    return false;
                }
            });
            var validateFront = function () {
                if (true === $('#gradesheet-form').parsley().isValid()) {
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
</div>