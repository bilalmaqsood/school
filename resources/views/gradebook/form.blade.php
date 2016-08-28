<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Add Marks</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            {!! Form::open(array('url'=>'gradebook/save/', 'class'=>'form-horizontal form-label-left', 'data-parsley-validate'=>true,'id'=> 'demo-form2')) !!}
            {!! Form::hidden('id', '2',array('class'=>'form-control', 'placeholder'=>'Last Name', 'required' => true)) !!}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Student Names<span
                            class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <center>Marks</center>

                </div>
            </div>
            @foreach($rows as $row)
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ ucwords($row->name) }}<span
                                class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('marks[]', '',array('class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'1st term Marks', 'required' => true)) !!}
                    </div>
                </div>
            @endforeach
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
                ajaxFilter('#{{ $pageModule }}', '{{ $pageUrl }}/manage-marks');
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

