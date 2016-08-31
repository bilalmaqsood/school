@extends('layouts.app')
@section('content')

    <div class="">
            <div class="page-title"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Student GradeSheet</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="apDiv1">
                            <center>
                                <p align="center">&nbsp;</p>
                                <p align="center"><strong>ST. MARY CATHOLIC SCHOOL</strong><br>
                                    DUALA, BUSHROD ISLAND<br>
                                    MONROVIA, LIBERIA</p>
                                <p align="center"><strong><u> MASTER GRADE SHEET</u></strong></p>
                                <p>&nbsp;
                                <center>
                                    Name:________{{ $rowData[0]->student_name }}_______________________Grade:____{{ $rowData[0]->class_name }}__ Year:__________
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
                                    @foreach($rowData as $row)
                                    <tr>
                                        <td width="134" valign="top">{{ $row->subject_name }}</td>
                                        <td width="27" valign="top"><p align="center">{{ $row->first_term }}</p></td>
                                        <td width="31" valign="top"><p align="center">{{ $row->second_term }}</p></td>
                                        <td width="33" valign="top"><p align="center">{{ $row->third_term }}</p></td>
                                        <td width="35" valign="top"><p align="center">{{ $row->second_exam }}</p></td>
                                        <td width="39" valign="top"><p align="center">{{ $semAve1 = ($row->first_term+$row->second_term+$row->third_term+$row->second_exam)/4 }}</p></td>
                                        <td width="27" valign="top"><p align="center">{{ $row->four_term }}</p></td>
                                        <td width="27" valign="top"><p align="center">{{ $row->fifth_term }}</p></td>
                                        <td width="42" valign="top"><p align="center">{{ $row->sixth_term }}</p></td>
                                        <td width="56" valign="top"><p align="center">{{ $row->final }}</p></td>
                                        <td width="56" valign="top"><p align="center">{{ $semAve2 = ($row->four_term+$row->fifth_term+$row->sixth_term+$row->final)/4 }}</p></td>
                                        <td width="40" valign="top"><p align="center">{{ ($semAve1+$semAve2)/2 }}</p></td>
                                    </tr>
                                    @endforeach

                                </table>
                                <p>Comments:  ___________________________________________________________________________</p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop