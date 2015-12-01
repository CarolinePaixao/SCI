<?php
session_start();
include_once "class/Functions.php";
Functions::verLog(1);
if(isset($_GET['logout'])){
    unset($_SESSION);
    session_destroy();
    header('LOCATION: login.html');
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>

    <?php include_once 'include/head.html'; ?>
    <!-- PAGE LEVEL STYLES -->
    <link href="assets/css/jquery-ui.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/plugins/uniform/themes/default/css/uniform.default.css" />
    <link rel="stylesheet" href="assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
    <link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css" />
    <link rel="stylesheet" href="assets/plugins/colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" href="assets/plugins/tagsinput/jquery.tagsinput.css" />
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
    <link rel="stylesheet" href="assets/plugins/timepicker/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-nav-wizard.css" />
    <!-- END PAGE LEVEL  STYLES -->
</head>
<!-- END  HEAD-->
<!-- BEGIN BODY-->
<body class="padTop53 " >

<!-- MAIN WRAPPER -->
<div id="wrap">


    <!-- HEADER SECTION -->
    <?php include_once 'include/header.php';?>
    <!-- END HEADER SECTION -->



    <!-- MENU SECTION -->
    <?php include_once 'include/menu.php';?>
    <!--END MENU SECTION -->


    <!--PAGE CONTENT -->
    <div id="content">
        <div class="inner">
            <?php include_once 'include/page_form.php';?>
        </div>
    </div>
    <!--END PAGE CONTENT -->


</div>

<!--END MAIN WRAPPER -->

<!-- FOOTER -->
<div id="footer">
    <p>&copy;  QuartetMaster &nbsp;2015 &nbsp;</p>
</div>
<!--END FOOTER -->
<!-- GLOBAL SCRIPTS -->
<script src="assets/plugins/jquery-2.0.3.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<!-- END GLOBAL SCRIPTS -->

<!-- PAGE LEVEL SCRIPT-->
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
<script src="assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
<script src="assets/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script src="assets/plugins/validVal/js/jquery.validVal.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/plugins/timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/switch/static/js/bootstrap-switch.min.js"></script>
<script src="assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
<script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
<script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
<script src="assets/js/formsInit.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/js/alterForms.js"></script>
<script>
    $(function () { formInit(); });
</script>

<!--END PAGE LEVEL SCRIPT-->

</body>
<!-- END BODY-->

</html>
