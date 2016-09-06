<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>New Fees Payment</h2>
            <li><a href="javascript:void(0)" class="pull-right close-link"
                   onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            </li>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            {!! Form::open(array('url'=>'finance/save/'.SiteHelpers::encryptID($row['id']), 'class'=>'form-horizontal form-label-left', 'data-parsley-validate'=>true,'id'=> 'demo-form2')) !!}
            {!! Form::hidden('id', $row['id']) !!}
            {!! Form::hidden('no', $row['no']) !!}
            {!! Form::hidden('created_at', $row['created_at']) !!}
            {!! Form::hidden('updated_at', $row['updated_at']) !!}
            {!! Form::hidden('created_by', $row['created_by']) !!}
            {!! Form::hidden('updated_by', $row['updated_by']) !!}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Student<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="student" name="student_id" class="form-control  col-md-7 col-xs-12" required>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Purpose<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('purpose', $row['purpose'],array('class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Purpose', 'required' => true)) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Amount in Words<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('amount_in_words', $row['amount_in_words'],array('class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Amount in Words', 'required' => true)) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount in Number<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('amount', $row['amount'],array('class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Amount in Number', 'required' => true)) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Due Amount<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('due', $row['due'],array('class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Due Amount')) !!}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="ajaxViewClose('#{{ $pageModule }}')">Cancel</a>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#student").jCombo("{{ URL::to('finance/comboselect?filter=tb_users:id:last_name')}}",
                    {  selected_value : '{{ $row["student_id"] }}' });
            $.listen('parsley:field:validate', function () {
                validateFront();
            });
            $('#demo-form2 .btn').on('click', function () {
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


        function showRequest() {
            $('.ajaxLoading').show();
        }
        function showResponse(data) {

            if (data.status == 'success') {
                ajaxViewClose('#{{ $pageModule }}');
                ajaxFilter('#{{ $pageModule }}', '{{ $pageUrl }}/data');
                //notyMessage(data.message);
                $('#sximo-modal').modal('hide');
            } else {
                //notyMessageError(data.message);
                $('.ajaxLoading').hide();
                return false;
            }
        }

    </script>
</div>

