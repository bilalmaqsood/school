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
        #main{
            margin-left: 50px;
            margin-right: 50px;
        }
    </style>


</head>

<body>
<div id="apDiv1">
    <h1 align="center"><strong><?php echo strtoupper(CNF_APPNAME);  ?></strong></h1>
    <p align="center"><?php echo strtoupper(CNF_APPADDRESS); ?></p>
    <p align="center"><strong>OFFICIAL TRANSCRIPT</strong></p>
    <p>&nbsp;</p>
    <p align="center" style="text-align: center;">NAME: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($student->first_name); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo strtoupper($student->middle_name); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo strtoupper($student->last_name); ?>,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; GENDER : <?php if($student->gender == 1) echo 'MALE'; else echo 'FEMALE'; ?> </p><!--A check box here-->
    <div id="main">
        <p align="center" style="text-align: center;"> PERIOD ATTENDANCE: <?php $start = explode('/', $last_three_classes[2]->year); echo $start[0]; ?> &nbsp;&nbsp;THRU: <?php $end = explode('/', $last_three_classes[0]->year); if(isset($end[1]))echo $end[1]; else $end[0]; ?>&nbsp;&nbsp; GRADE: 10 - 12 </p>
        <table style="width: 100%">
            <tr>
                <td style="width: 33.3%">YEAR</td>
                <td style="width: 33.3%; text-align: right"><?php echo $last_three_classes[2]->year; ?></td>
                <td style="width: 33.3%; text-align: right""><?php echo $last_three_classes[1]->year; ?></td>
                <td style="width: 33.3%; text-align: right""><?php echo $last_three_classes[0]->year; ?></td>
            </tr>
            <tr>
                <td style="width: 33.3%">SUBJECTS</td>
                <td style="width: 33.3%; text-align: right">GRADE: 10</td>
                <td style="width: 33.3%; text-align: right"">GRADE: 11</td>
                <td style="width: 33.3%; text-align: right"">GRADE: 12</td>
            </tr>
            <?php $grade10Sum= 0; $grade10Count= 0;  $grade11Sum= 0; $grade11Count= 0; $grade12Sum= 0; $grade12Count= 0;?>
            <?php foreach($subject_list as $subject): ?>
            <tr>
                <td style="width: 33.3%"><?php echo $subject->subject_name; ?></td>
                <td style="width: 33.3%; text-align: right"><?php $result = \SiteHelpers::getGradeForTranscript($last_three_classes[2]->class_id, $id, $subject->subject_name, $last_three_classes[2]->year_id); echo $result; if($result != '--') { $grade10Sum = $grade10Sum + $result; $grade10Count++; }?></td>
                <td style="width: 33.3%; text-align: right""><?php $result = \SiteHelpers::getGradeForTranscript($last_three_classes[1]->class_id, $id, $subject->subject_name, $last_three_classes[1]->year_id); echo $result; if($result != '--') { $grade11Sum = $grade11Sum + $result; $grade11Count++; }?></td>
                <td style="width: 33.3%; text-align: right""><?php $result =  \SiteHelpers::getGradeForTranscript($last_three_classes[0]->class_id, $id, $subject->subject_name, $last_three_classes[0]->year_id); echo $result; if($result != '--') { $grade12Sum = $grade12Sum + $result; $grade12Count++; }?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td style="width: 33.3%">AVGRATE</td>
                <td style="width: 33.3%; text-align: right"><?php echo round($grade10Sum/$grade10Count); ?></td>
                <td style="width: 33.3%; text-align: right""><?php echo round($grade11Sum/$grade11Count); ?></td>
                <td style="width: 33.3%; text-align: right""><?php echo round($grade12Sum/$grade12Count); ?></td>
            </tr>
        </table>
        <br>
    <p align="left" style="text-align: left;">DATE: <?php echo date(CNF_DATEFORMAT) ?></p>
    <p align="right" style="text-align: right;">SIGNED: <?php  echo $registrar; ?></p>
    <p align="left" style="text-align: left;">APPROVED: <?php echo $principal; ?></p>
    </div>
</div>
</body>
</html>
