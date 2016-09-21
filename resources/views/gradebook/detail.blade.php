    <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Master GradeBook</h2>
                    <li><a href="javascript:void(0)" class="pull-right close-link" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
                    </li>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">


                    <div id="apDiv1">
                        <center>
                            <p align="center">&nbsp;</p>
                            <p align="center"><strong>SCHOOLEDGE ACADEMY</strong><br>
                                TUBMAN BOULEVARD, SINKOR<br>
                                MONROVIA, LIBERIA</p>
                            <p align="center"><strong><u> MASTER GRADE SHEET</u></strong></p>
                            <p>&nbsp;
                            <center>
                                Subject {{ \SiteHelpers::getSubjectName($subject) }} Grade:{{ \SiteHelpers::getClassName($class) }}  Division:{{ \SiteHelpers::getDivisionName($class) }} Year
                            </center>
                            </p>
                            <table id="datatable-responsive" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

                                <tr>
                                    <td width="134" rowspan="2" valign="top"><p>&nbsp;</p>
                                        <p><strong>&nbsp;</strong></p>
                                        <p><strong>Students Name</strong></p></td>
                                    <td colspan="5" valign="top"><p><strong>
                                                <center>
                                                    FIRST SEMESTER
                                                </center>
                                            </strong></p></td>
                                    <td colspan="5" valign="top"><p><strong>
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
                                @foreach($rows as $row)
                                    <tr>
                                        <td width="134" valign="top">{{ $row->student_id }}</td>
                                        <td width="27" valign="top"><p align="center">{{ $row->first_term }}</p></td>
                                        <td width="31" valign="top"><p align="center">{{ $row->second_term }}</p></td>
                                        <td width="33" valign="top"><p align="center">{{ $row->third_term }}</p></td>
                                        <td width="35" valign="top"><p align="center">{{ $row->first_exam }}</p></td>
                                        <td width="39" valign="top"><p align="center">{{ $row->first_avg }}</p></td>
                                        <td width="27" valign="top"><p align="center">{{ $row->four_term }}</p></td>
                                        <td width="27" valign="top"><p align="center">{{ $row->fifth_term }}</p></td>
                                        <td width="42" valign="top"><p align="center">{{ $row->sixth_term }}</p></td>
                                        <td width="56" valign="top"><p align="center">{{ $row->second_exam }}</p></td>
                                        <td width="56" valign="top"><p align="center">{{ $row->second_avg }}</p></td>
                                        <td width="40" valign="top"><p align="center">{{ $row->final }}</p></td>
                                    </tr>
                                @endforeach
                            </table>


                            <p>Teacher Name: {{ \SiteHelpers::getTeacherName($teacher) }}</p>
                        </center>
                    </div>


                </div>
            </div>
        </div>


