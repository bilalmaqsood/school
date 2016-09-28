<?php $total = 0; $sum = 0; $marks = 0;?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        @if(count($rowData) > 0)
            <div class="x_title">
                <h2>GradeSheet: {{ ucwords($rowData[0]->student_name) }}</h2>
                <li>
                    <a href="javascript:void(0)" class="pull-right close-link" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
                    <a style="margin-right: 15px;" href="{{ URL::to($pageModule.'/download-gradesheet?student='.$id.'&class='.$class) }}" class="pull-right btn btn-success">Download Grade Sheet</a>
                </li>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="apDiv1">
                    <center>
                        <p align="center">&nbsp;</p>
                        <p align="center"><strong>{{ CNF_APPNAME }}</strong><br>
                            {!! nl2br(CNF_APPADDRESS) !!}</p>
                        <p align="center"><strong><u> MASTER GRADE SHEET</u></strong></p>
                        <p>&nbsp;
                        <center>
                            Name: {{ ucwords($rowData[0]->student_name) }} Grade: {{ $rowData[0]->class_name }} Year: {{ \SiteHelpers::getYearName() }}
                        </center>
                        </p>
                        <table id="datatable-responsive" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                            <tr>
                                <td width="134" rowspan="2" valign="top"><p>&nbsp;</p>
                                    <p><strong>&nbsp;</strong></p>
                                    <p><strong>SUBJECTS</strong></p></td>
                                <td colspan="5" valign="top"><p><strong>
                                            <center>
                                                FIRST SEMESTER
                                            </center>
                                        </strong></p></td>
                                <td colspan="6" valign="top"><p><strong>
                                            <center>
                                                SECOND SEMESTER
                                            </center>
                                        </strong></p></td>
                            </tr>
                            <tr>
                                <td width="27" height="59" valign="top"><p>1st </p></td>
                                <td width="31" valign="top"><p>2nd  </p></td>
                                <td width="33" valign="top"><p>3rd  </p></td>
                                <td width="35" valign="top"><p>Exam</p></td>
                                <td width="39" valign="top"><p>Sem. Ave</p></td>
                                <td width="27" valign="top"><p>4th </p></td>
                                <td width="27" valign="top"><p>5th </p></td>
                                <td width="42" valign="top"><p>6th </p></td>
                                <td width="56" valign="top"><p>Exam</p></td>
                                <td width="56" valign="top"><p>Sem. Ave</p></td>
                                <td width="40" valign="top"><p>Yr.   Ave </p></td>
                            </tr>
                            @foreach($rowData as $row)
                            <tr>
                                <td width="134" valign="top">{{ $row->subject_name }}</td>
                                <td width="27" valign="top"><p align="center">{{ $row->first_term }}</p></td>
                                <td width="31" valign="top"><p align="center">{{ $row->second_term }}</p></td>
                                <td width="33" valign="top"><p align="center">{{ $row->third_term }}</p></td>
                                <td width="35" valign="top"><p align="center">{{ $row->first_exam }}</p></td>
                                <td width="39" valign="top"><p align="center">{{ $row->first_avg}}</p></td>
                                <td width="27" valign="top"><p align="center">{{ $row->four_term }}</p></td>
                                <td width="27" valign="top"><p align="center">{{ $row->fifth_term }}</p></td>
                                <td width="42" valign="top"><p align="center">{{ $row->sixth_term }}</p></td>
                                <td width="56" valign="top"><p align="center">{{ $row->final }}</p></td>
                                <td width="56" valign="top"><p align="center">{{ $row->second_avg }}</p></td>
                                <td width="40" valign="top"><p align="center">{{ round(($row->first_avg + $row->second_avg)/2)  }}</p></td>
                                <?php
                                    $total++;
                                    $sum = $sum+round(($row->first_avg + $row->second_avg)/2);
                                ?>
                            </tr>
                            @endforeach
                        </table>
                        <?php
                            $marks = round($sum/$total);;
                        ?>
                        <p>Comments:  {{ \SiteHelpers::getRemarks($marks) }}</p>
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