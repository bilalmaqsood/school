<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>liberweb</title>
    <style type="text/css">
        #apDiv1 {

            top: 58px;
            font-size:15px;
            border: 20px;
            text-decoration: none;
            text-shadow: 1px 0px 0px;
            border-radius: 10px;

        }
        .table-bordered td,.table-bordered th{border:1px solid #ddd!important}
    </style>


</head>

<body>
<div id="apDiv1">
    <center>
    <h1 align="center"><strong><?php echo strtoupper(CNF_APPNAME);  ?></strong></h1>
    <p align="center"><?php echo strtoupper(CNF_APPADDRESS); ?></p>
    <p align="center"><strong><u> MASTER GRADE BOOK</u></strong></p>
    <p>&nbsp;
    <center>
        Subject: <?php echo \SiteHelpers::getSubjectName($subject); ?>
        Grade: <?php echo \SiteHelpers::getClassName($class); ?>
        Division: <?php echo \SiteHelpers::getDivisionName($class); ?> Year: <?php echo \SiteHelpers::getYearName(\Session::get('selected_year')); ?>
    </center>
    </p>
    <br>
    <table class="table table-bordered dt-responsive nowrap" cellspacing="0"
           width="100%">

        <tr>
            <td width="134" rowspan="2" valign="top"><p>&nbsp;</p>
                <p><strong>&nbsp;</strong></p>
                <p><strong>Students Name</strong></p></td>
            <td colspan="5" valign="top">
                <p><strong>
                        <center>
                            FIRST SEMESTER
                        </center>
                    </strong></p>
            </td>
            <td colspan="6" valign="top">
                <p><strong>
                        <center>
                            SECOND SEMESTER
                        </center>
                    </strong>
                </p>
            </td>
        </tr>
        <tr>
            <td width="27" height="59" valign="top"><p>1st </p></td>
            <td width="31" valign="top"><p>2nd  </p></td>
            <td width="33" valign="top"><p>3rd </p></td>
            <td width="35" valign="top"><p>Exam</p></td>
            <td width="56" valign="top"><p>Sem. Ave</p></td>
            <td width="27" valign="top"><p>4th </p></td>
            <td width="27" valign="top"><p>5th </p></td>
            <td width="42" valign="top"><p>6th </p></td>
            <td width="35" valign="top"><p>Exam</p></td>
            <td width="56" valign="top"><p>Sem. Ave</p></td>
            <td width="40" valign="top"><p>Yr. Ave </p></td>
        </tr>
        <?php foreach($rows as $row): ?>
        <tr>
            <td width="134" valign="top"><?php echo \SiteHelpers::getStudentName($row->student_id); ?></td>
            <td width="27" valign="top"><p align="center"><?php echo $row->first_term; ?></p></td>
            <td width="31" valign="top"><p align="center"><?php echo $row->second_term; ?></p></td>
            <td width="33" valign="top"><p align="center"><?php echo $row->third_term; ?></p></td>
            <td width="35" valign="top"><p align="center"><?php echo $row->first_exam; ?></p></td>
            <td width="39" valign="top"><p align="center"><?php echo $row->first_avg; ?></p></td>
            <td width="27" valign="top"><p align="center"><?php echo $row->four_term; ?></p></td>
            <td width="27" valign="top"><p align="center"><?php echo $row->fifth_term; ?></p></td>
            <td width="42" valign="top"><p align="center"><?php echo $row->sixth_term; ?></p></td>
            <td width="35" valign="top"><p align="center"><?php echo $row->second_exam; ?></p></td>
            <td width="56" valign="top"><p align="center"><?php echo $row->second_avg; ?></p></td>
            <td width="40" valign="top"><p align="center"><?php echo $row->final; ?></p></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <p align="center">Teacher Name: <?php echo \SiteHelpers::getTeacherName($teacher); ?></p>
    </center>

</div>
</body>
</html>
