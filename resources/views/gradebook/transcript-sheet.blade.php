<style type="text/css">
    #apDiv1 {
        padding: 30px;
        left: 140px !important;
        top: 58px !important;
        margin: 4% !important;
        color: black;
        width: 90% !important;
        height: 100% !important;
        font-size:15px !important;
        border: 20px solid black !important;
        background-color: #928c83 !important;
        text-decoration: none !important;
        text-shadow: 1px 1px 0px orange !important;
        border-radius: 10px !important;

    }
</style>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Transcript</h2>
            <li><a href="javascript:void(0)" class="pull-right close-link" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            </li>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div id="apDiv1">
                <center>
                    <h1><strong> SCHOOLEDGE ACADEMY</strong></h1>
                    <p> TUBMAN BOULEVARD, SINKOR</p>
                    <p> MONROVIA, LIBERIA</p>
                    <p><strong> OFFICIAL TRANSCRIPT</strong></p>
                    <p></p>
                    <p>NAME: {{ strtoupper($student->last_name.' '.$student->middle_name.' '.$student->first_name) }}</p>
                    <p>GENDER: @if($student->last_name == 1) {{ 'M' }} @else {{ 'F' }} @endif</p>
                    <p></p>
                    <p> PRRIOD ATTENDANCE:  THRU: GRADE: </p>
                </center>
                </br>
                    <p style="padding-left:10%; padding-right: 10%;">
                        <span style="float: left">YEAR &nbsp;&nbsp;</span>
                        <span style="float: right">
                        @foreach($student_previous_classes as $index => $student_previous_class)
                            @if($index == count($student_previous_classes) - 1)
                                {{$student_previous_class->year}}
                            @else
                                <?php echo $student_previous_class->year.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?>
                            @endif
                        @endforeach
                        </span>
                    </p>
                </br>
                <p style="padding-left:10%; padding-right: 10%;">
                    <span style="float: left">SUBJECTS &nbsp;&nbsp;</span>
                    <span style="float: right">
                    @foreach($student_previous_classes as $index => $student_previous_class)
                        @if($index == count($student_previous_classes) - 1)
                            {{strtoupper(\SiteHelpers::getClassName($student_previous_class->class_id))}}
                        @else
                            {{strtoupper(\SiteHelpers::getClassName($student_previous_class->class_id))}}
                        @endif
                    @endforeach
                    </span>
                </p>
                </br>
                @foreach($transcript_matrix_sheet as $i => $transcript_marks)
                    <p style="padding-left:10%; padding-right: 10%;">
                        <span style="float: left">{{ strtoupper($student_subjects[$i]->name) }} </span>
                        <span style="float: right">
                            @foreach($transcript_marks as $index => $transcript_mark)
                                @if($index == count($transcript_marks))
                                    {{$transcript_mark}}
                                @else
                                    {{$transcript_mark.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'}}
                                @endif
                            @endforeach
                        </span>
                    </p>
                    </br>
                @endforeach
                <br>
                <br>
                <br>
                <p style="padding-left:10%; padding-right: 10%;">
                    <span style="float: left">DATE {{ date(CNF_DATEFORMAT) }}</span>
                    <span style="float: right">SIGNED  hehis</span>
                </p>
                </br>
                </br>
                <p style="padding-left:10%; padding-right: 10%;">
                    <span style="float: left">APPROVED    shs</span>
                </p>
                </br>
                </br>
            </div>

        </div>
    </div>
</div>


