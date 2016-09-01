<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                Semester: {{ \SiteHelpers::getSemester($exam) }} Subject: {{ \SiteHelpers::getSubjectName($subject) }}   Class: {{ \SiteHelpers::getClassName($class) }}   Division: {{ \SiteHelpers::getDivisionName($class) }} Period: {{ \SiteHelpers::getExamType($exam) }}
            </h2>
            <li>
                <a href="javascript:void(0)" class="pull-right close-link" onclick="ajaxViewClosed('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            </li>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                {!! Form::open(array('url'=>'gradebook/save/'.SiteHelpers::encryptID($id), 'class'=>'form-horizontal form-label-left', 'data-parsley-validate'=>true,'id'=> 'demo-form2')) !!}
                {!! Form::hidden('id', $id) !!}
                {!! Form::hidden('class', $class) !!}
                {!! Form::hidden('subject', $subject) !!}
                {!! Form::hidden('exam', $exam) !!}
                    <table class="table marks-table .table-bordered">
                        <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Marks Obtained</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $index => $row)
                            {!! Form::hidden('ids[]', $row->id,array('class'=>'form-control', 'placeholder'=>'Last Name', 'required' => true)) !!}
                            <tr>
                                <th scope="row">{{ ++$index }}</th>
                                <td>{{ ucwords($row->name) }}</td>
                                <td>
                                    {!! Form::text('marks[]', $row->marks,array('class'=>'form-control', 'required' => true)) !!}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                <div class="clearfix"></div>
                <div class="ln_solid"></div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="ajaxViewClosed('#{{ $pageModule }}')">Cancel</a>
                        <button type="submit" id="save_changes" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>


        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $.listen('parsley:field:validate', function () {
                validateFront();
            });
            $('#demo-form2 #save_changes').on('click', function () {
                $('#demo-form2').parsley().validate();
                validateFront();
                if ($('#demo-form2').parsley().isValid() == true) {
                    var options = {
                        dataType: 'json',
                        beforeSubmit: showRequest,
                        success: showResponse
                    }
                    $('#demo-form2').ajaxSubmit(options);
                    return false;

                } else {
                    return false;
                }
            });
            var validateFront = function () {
                if (true === $('#demo-form2').parsley().isValid()) {
                    $('.bs-callout-info').removeClass('hidden');
                    $('.bs-callout-warning').addClass('hidden');
                } else {
                    $('.bs-callout-info').addClass('hidden');
                    $('.bs-callout-warning').removeClass('hidden');
                }
            };
        });

        function ajaxViewClosed(id)
        {
            window.location.reload();
        }
        function showRequest() {
            //$('.ajaxLoading').show();
        }
        function showResponse(data) {

            if (data.status == 'success') {
                window.location.reload();
            } else {
                //notyMessageError(data.message);
                $('.ajaxLoading').hide();
                return false;
            }
        }
    </script>
</div>