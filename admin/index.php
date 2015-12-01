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
</head>
<!-- END  HEAD-->
<!-- BEGIN BODY-->
<body class="padTop53 ">

<!-- MAIN WRAPPER -->
<div id="wrap">


    <!-- HEADER SECTION -->
    <?php include_once 'include/header.php';?>
    <!-- END HEADER SECTION -->





    <!--PAGE CONTENT -->
        <div class="inner" >
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="text-align: center; margin-top: 75px"> Sistema de Captação de Informações - Missão Calebe
                       <br/> <img src="assets/img/favicon.png" width="120">
                    </h3>
                </div>
            </div>
            <!--BLOCK SECTION -->
            <div class="row">
                <div class="col-lg-12">
                    <div style="text-align: center; margin-top: 15px">

                        <?php
                        if($_SESSION['login']['role'] == 3) {
                        ?>
                            <a class="quick-btn" href="consulta.php?p=calebe">
                                <i class="icon-user icon-2x"></i>
                                <span>Calebe</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=equipe">
                                <i class="icon-flag icon-2x"></i>
                                <span>Equipe</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=igreja">
                                <i class="icon-home icon-2x"></i>
                                <span>Igreja</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=lider">
                                <i class="icon-star icon-2x"></i>
                                <span>Líder Calebe</span>
                            </a>
                            <br />
                            <a class="quick-btn" href="consulta.php?p=missao">
                                <i class="icon-globe icon-2x"></i>
                                <span>Missão</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=morador">
                                <i class="icon-male icon-2x"></i>
                                <span>Morador</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=aux">
                                <i class="icon-file icon-2x"></i>
                                <span>Religião</span>
                            </a>
                        <?php
                        }else if($_SESSION['login']['role'] == 2){
                        ?>
                            <a class="quick-btn" href="consulta.php?p=equipe">
                                <i class="icon-flag icon-2x"></i>
                                <span>Equipe</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=igreja">
                                <i class="icon-home icon-2x"></i>
                                <span>Igreja</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=missao">
                                <i class="icon-globe icon-2x"></i>
                                <span>Missão</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=morador">
                                <i class="icon-male icon-2x"></i>
                                <span>Morador</span>
                            </a>
                         <?php
                        }else if($_SESSION['login']['role'] == 1){
                        ?>
                            <a class="quick-btn" href="consulta.php?p=equipe">
                                <i class="icon-flag icon-2x"></i>
                                <span>Equipe</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=missao">
                                <i class="icon-globe icon-2x"></i>
                                <span>Missão</span>
                            </a>
                            <a class="quick-btn" href="consulta.php?p=morador">
                                <i class="icon-male icon-2x"></i>
                                <span>Morador</span>
                            </a>
                        <?php
                        }else{
                            unset($_SESSION);
                            header("Location:login.html");
                        }
                        ?>

                        <a class="quick-btn" href="consulta.php?p=estatisticas">
                            <i class="icon-bar-chart icon-2x"></i>
                            <span>Estatísticas</span>
                        </a>
                    </div>

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
</body>
<!-- END BODY-->

</html>
