<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Student Profile</h2>
            <a href="javascript:void(0)" class="pull-right close-link"
               onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

            <div class="profile_img">

                <!-- end of image cropping -->
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    {!! SiteHelpers::showUploadedProfileIamge($row->avatar,'/', 'img-responsive avatar-view',150,150) !!}
                    <!-- Loading state -->
                    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                </div>
                <!-- end of image cropping -->

            </div>
            <h3>{{ ucwords($row->first_name.' '.$row->last_name)}} </h3>

            <ul class="list-unstyled user_data">
                <li><i class="fa fa-map-marker user-profile-icon"></i> {{$row->city}}, {{$row->country}}
                </li>

            </ul>
            @if($access['is_edit'] == 1)
                <a class="btn btn-success" href="{{ URL::to($pageModule.'/update/'.$row->student_id) }}"
                   onclick="ajaxViewDetail('#{{ $pageModule }}',this.href); return false"><i
                            class="fa fa-edit m-right-xs"></i>Edit Profile</a>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                                                                  data-toggle="tab" aria-expanded="true">Personal
                                Detail</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab"
                                                            data-toggle="tab" aria-expanded="false">Parent Details</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                             aria-labelledby="home-tab">


                            <table class="personal_details">

                                <tr>
                                    <td><label>Last Name</label></td>
                                    <td>{{ucwords($row->last_name)}}</td>
                                    <td><label>City</label></td>
                                    <td>{{ucwords($row->city)}}</td>
                                </tr>
                                <tr>
                                    <td><label>Middle Name </label></td>
                                    <td>{{ucwords($row->middle_name)}}</td>
                                    <td><label>Country/State </label></td>
                                    <td>{{ucwords($row->country)}}</td>
                                </tr>
                                <tr>
                                    <td><label>First Name</label></td>
                                    <td>{{ucwords($row->first_name)}}</td>
                                    <td><label>Phone No</label></td>
                                    <td>{{$row->phone_number}}</td>
                                </tr>
                                <tr>
                                    <td><label>Class</label></td>
                                    <td>{{ \SiteHelpers::getClassName($row->class_id) }}</td>
                                    <td><label>Mobile No</label></td>
                                    <td>{{$row->mobile_number}}</td>
                                </tr>
                                <tr>
                                    <td><label>Date of Birth</label></td>
                                    <td>{{$row->date_of_birth}}</td>
                                    <td><label>Email Address</label></td>
                                    <td>{{$row->email}}</td>
                                </tr>
                                <tr>
                                    <td><label>Religion</label></td>
                                    <td>{{ ucwords($row->religion) }}</td>
                                    <td><label>Nationality</label></td>
                                    <td>{{ ucwords($row->nationality) }}</td>
                                </tr>
                                <tr>
                                    <td><label>Gender</label></td>
                                    <td>{{ \SiteHelpers::getGender($row->gender) }}</td>
                                    <td><label>Admission Date</label></td>
                                    <td>{{ ($row->register_date) }}</td>
                                </tr>

                            </table>


                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <table class="personal_details">

                                <tr>
                                    <td><label>Last Name</label></td>
                                    <td>{{ ucwords($parent->last_name)}}</td>
                                    <td><label>City</label></td>
                                    <td>{{ ucwords($parent->city) }}</td>
                                </tr>

                                <tr>
                                    <td><label>Middle Name </label></td>
                                    <td>{{ ucwords($parent->middle_name) }}</td>
                                    <td><label>Country/State </label></td>
                                    <td>{{ ucwords($parent->country) }}</td>
                                </tr>
                                <tr>
                                    <td><label>First Name</label></td>
                                    <td>{{ ucwords($parent->first_name) }}</td>
                                    <td><label>Phone No</label></td>
                                    <td>{{ $parent->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td><label>Relationship to Student</label></td>
                                    <td>{{ $parent->relation }}</td>
                                    <td><label>Mobile No</label></td>
                                    <td>{{ $parent->mobile_number }}</td>
                                </tr>
                                <tr>
                                    <td><label>Occupation</label></td>
                                    <td>{{ $parent->occupcation }}</td>
                                    <td><label>Email Address</label></td>
                                    <td>{{ $parent->email }}</td>
                                </tr>
                                <tr>
                                    <td><label>Community</label></td>
                                    <td>{{ ucwords($parent->community) }}</td>

                                </tr>

                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

</div>

@section('js_section');
<script>
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function (e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
            submit = false;
        }

        if (submit)
            this.submit();
        return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function () {
        $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function () {
        validator.defaults.alerts = (this.checked) ? false : true;
        if (this.checked)
            $('form .alert').remove();
    }).prop('checked', false);
</script>

<script type="text/javascript">
    $(document).ready(function () {

        var cb = function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
        }

        var optionSet1 = {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
            dateLimit: {
                days: 60
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'right',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Clear',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        };

        $('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        $('#reportrange_right').daterangepicker(optionSet1, cb);

        $('#reportrange_right').on('show.daterangepicker', function () {
            console.log("show event fired");
        });
        $('#reportrange_right').on('hide.daterangepicker', function () {
            console.log("hide event fired");
        });
        $('#reportrange_right').on('apply.daterangepicker', function (ev, picker) {
            console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange_right').on('cancel.daterangepicker', function (ev, picker) {
            console.log("cancel event fired");
        });

        $('#options1').click(function () {
            $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
        });

        $('#options2').click(function () {
            $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
        });

        $('#destroy').click(function () {
            $('#reportrange_right').data('daterangepicker').remove();
        });

    });
</script>
<!-- datepicker -->
<script type="text/javascript">
    $(document).ready(function () {

        var cb = function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
        }

        var optionSet1 = {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
            dateLimit: {
                days: 60
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Clear',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function () {
            console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function () {
            console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
            console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
            console.log("cancel event fired");
        });
        $('#options1').click(function () {
            $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function () {
            $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function () {
            $('#reportrange').data('daterangepicker').remove();
        });
    });
</script>
<!-- /datepicker -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#admission_date').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_1"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

    });
</script>

<!-- /datepicker -->
<!-- input_mask -->
{{--  <script>
   $(document).ready(function() {
     $(":input").inputmask();
   });
 </script> --}}
        <!-- /input mask -->


@stop