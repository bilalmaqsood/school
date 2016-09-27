<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        @if(count($rows) > 0)
            <div class="x_title">
                <h2>MASTER TRANSCRIPT</h2>
                <li>
                    <a href="javascript:void(0)" class="pull-right close-link"
                       onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
                    <a style="margin-right: 15px;" href="javascript:void(0)" class="pull-right btn btn-success">Download Transcript</a>
                </li>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="apDiv1">
                    <center>
                        <p align="center">&nbsp;</p>
                        <p align="center"><strong>{{ CNF_APPNAME }}</strong><br>
                            {!! nl2br(CNF_APPADDRESS) !!}
                        </p>
                        <p align="center"><strong><u> MASTER TRANSCRIPT</u></strong></p>
                        @foreach($rows as $row)
                            <p>&nbsp;
                            <center>
                                Grade: {{ $row->class_name }}
                                Division: {{ $row->division_name }}
                                Year: {{ $row->year }}
                                <span style="color: green"> Status:
                                    @if($row->status == -1)
                                        Pass out
                                    @elseif($row->status == 0)
                                        Current
                                    @elseif($row->status == 3)
                                        Fail
                                    @elseif($row->status == 1 && $row->status == 2)
                                        Pass
                                    @endif
                                </span>
                            </center>
                            </p>
                            <table id="datatable-responsive" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                   width="100%">

                                <tr>
                                    <td width="134" rowspan="2"     valign="top"><p>&nbsp;</p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>SUBJECTS</strong></p></td>
                                    <td colspan="5" valign="top">
                                        <p><strong>
                                                <center>
                                                    FIRST SEMESTER
                                                </center>
                                            </strong></p>
                                    </td>
                                    <td colspan="5" valign="top">
                                        <p><strong>
                                                <center>
                                                    SECOND SEMESTER
                                                </center>
                                            </strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="27" height="59" valign="top"><p>1st </p></td>
                                    <td width="31" valign="top"><p>2nd  </p></td>
                                    <td width="33" valign="top"><p>3rd </p></td>
                                    <td width="35" valign="top"><p>Exam</p></td>
                                    <td width="39" valign="top"><p>Sem. Ave</p></td>
                                    <td width="27" valign="top"><p>4th </p></td>
                                    <td width="27" valign="top"><p>5th </p></td>
                                    <td width="42" valign="top"><p>6th </p></td>
                                    <td width="56" valign="top"><p>Exam</p></td>
                                    <td width="56" valign="top"><p>Sem. Ave</p></td>
                                    <td width="40" valign="top"><p>Yr. Ave </p></td>
                                </tr>
                                @if(count($row->subjects) > 0)
                                    @foreach($row->subjects as $subject)

                                        <tr>
                                            <td width="134" valign="top">{{ $subject->name  }}</td>
                                            <?php $grade = \SiteHelpers::getGradesRow($student, $row->class_id, $subject->subject_id, $row->year_id);?>
                                            @if(!empty($grade))
                                                <td width="27" valign="top"><p align="center">{{ $grade->first_term }}</p></td>
                                                <td width="31" valign="top"><p align="center">{{ $grade->second_term }}</p></td>
                                                <td width="33" valign="top"><p align="center">{{ $grade->third_term }}</p></td>
                                                <td width="35" valign="top"><p align="center">{{ $grade->first_exam }}</p></td>
                                                <td width="39" valign="top"><p align="center">{{ $grade->first_avg }}</p></td>
                                                <td width="27" valign="top"><p align="center">{{ $grade->four_term }}</p></td>
                                                <td width="27" valign="top"><p align="center">{{ $grade->fifth_term }}</p></td>
                                                <td width="42" valign="top"><p align="center">{{ $grade->sixth_term }}</p></td>
                                                <td width="56" valign="top"><p align="center">{{ $grade->second_exam }}</p></td>
                                                <td width="56" valign="top"><p align="center">{{ $grade->second_avg }}</p></td>
                                                <td width="40" valign="top"><p align="center">{{ $grade->final }}</p></td>
                                            @else
                                                <td width="27" valign="top"><p align="center">--</p></td>
                                                <td width="31" valign="top"><p align="center">--</p></td>
                                                <td width="33" valign="top"><p align="center">--</p></td>
                                                <td width="35" valign="top"><p align="center">--</p></td>
                                                <td width="39" valign="top"><p align="center">--</p></td>
                                                <td width="27" valign="top"><p align="center">--</p></td>
                                                <td width="27" valign="top"><p align="center">--</p></td>
                                                <td width="42" valign="top"><p align="center">--</p></td>
                                                <td width="56" valign="top"><p align="center">--</p></td>
                                                <td width="56" valign="top"><p align="center">--</p></td>
                                                <td width="40" valign="top"><p align="center">--</p></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td width="134" valign="top">--</td>
                                        <td width="27" valign="top"><p align="center">--</p></td>
                                        <td width="31" valign="top"><p align="center">--</p></td>
                                        <td width="33" valign="top"><p align="center">--</p></td>
                                        <td width="35" valign="top"><p align="center">--</p></td>
                                        <td width="39" valign="top"><p align="center">--</p></td>
                                        <td width="27" valign="top"><p align="center">--</p></td>
                                        <td width="27" valign="top"><p align="center">--</p></td>
                                        <td width="42" valign="top"><p align="center">--</p></td>
                                        <td width="56" valign="top"><p align="center">--</p></td>
                                        <td width="56" valign="top"><p align="center">--</p></td>
                                        <td width="40" valign="top"><p align="center">--</p></td>
                                    </tr>
                                @endif
                            </table>

                        @endforeach
                    </center>
                </div>


            </div>
        @else
            <div class="x_title">
                <a href="javascript:void(0)" class="pull-right close-link" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>

                <div class="clearfix"></div>
            </div>
            <div class="x_content bs-example-popovers">
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>Note!</strong> {{ 'Not Record Found' }}
                </div>
            </div>
        @endif
    </div>
</div>


