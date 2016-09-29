<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Liberweb Recept</title>
    <style type="text/css">


        p.MsoNoSpacing {
            margin:0in;
            margin-bottom:.0001pt;
            font-size:11.0pt;
            font-family:"Calibri","sans-serif";
        }
        #apDiv1 {
            position: absolute;
            top: 174px;
            width: 732px;
            height: 339px;
            border: 10px solid black;
            background-color:#DADBD7;
            text-decoration:none;
            font-weight:400;
            text-shadow:0px 1px 0px black;
            border-radius:10px;
            z-index: 1;
        }

    </style>
</head>

<body leftmargin="300" topmargin="60" marginwidth="3" marginheight="3">
<div id="apDiv1">
    <p class="MsoNoSpacing" align="center" style="text-align:center;">&nbsp;</p>
    <p class="MsoNoSpacing" align="center" style="text-align:center;"><?php echo strtoupper(CNF_APPNAME);  ?></p>
    <p class="MsoNoSpacing" align="center" style="text-align:center;"><?php echo strtoupper(CNF_APPADDRESS); ?></p>
    <p class="MsoNoSpacing" align="center" style="text-align:center;">CELL: <?php echo CNF_APPNO; ?></p>
    <p class="MsoNoSpacing" align="center" style="text-align:center;">&nbsp;</p>
    <p class="MsoNoSpacing" align="center" style="text-align:center;"><strong><span style="font-size:15.0pt; ">                                           </span></strong><strong><span style="font-family:Aharoni; font-size:25.0pt; ">RECEIPT</span></strong><span style="font-family:Aharoni; font-size:25.0pt; ">  </span><span style="font-size:25.0pt; ">  </span><span style="font-size:26.0pt; ">                   </span><strong><span style="font-size:14.0pt; ">No</span></strong>.<?php echo $no; ?></p>
    <blockquote>
        <p class="MsoNoSpacing" style="line-height:150%;"><span style="line-height:150%; font-family:'Times New Roman','serif'; font-size:12.0pt; "> Date: <?php echo date(CNF_DATEFORMAT, strtotime($received_date)); ?></span></p>
        <p class="MsoNoSpacing" style="line-height:150%;"><span style="font-family:'Times New Roman','serif'; font-size:12.0pt; ">Received from:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             <?php echo ucwords($student_id); ?></p>
        <p class="MsoNoSpacing" style="line-height:150%;"><span style="font-family:'Times New Roman','serif'; font-size:12.0pt; "> The sum of&nbsp;<?php echo strtolower($amount_in_words); ?>&nbsp;dollars</span></p>
        <p class="MsoNoSpacing" style="line-height:150%;"><span style="font-family:'Times New Roman','serif'; font-size:12.0pt; "> For&nbsp;<?php echo strtolower($purpose);?><br>
    Amount  Paid <?php echo '$'.$amount.' '.CNF_CURRENCY; ?>   
        <?php if($due = 0) { ?>
            <p class="MsoNoSpacing" style="line-height:150%;"><span style="font-family:'Times New Roman','serif'; font-size:12.0pt; "> Balance  Due <?php echo '$'.$amount.' '.CNF_CURRENCY; ?>                                          </span></p>
        <?php } ?>
        <p class="MsoNoSpacing" align="center" style="text-align:center;"><?php echo ucwords($updated_by); ?></p>
        <p class="MsoNoSpacing" align="center" style="text-align:center;"> Authorized  Signature</p>
    </blockquote>
</div>
</body>
</html>
