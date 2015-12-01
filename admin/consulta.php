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
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />

    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="assets/plugins/flot/examples/examples.css" rel="stylesheet" />

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

            <?php include_once 'include/page_read.php'; ?>

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
<script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="assets/plugins/morris/morris.js"></script>

<script  src="assets/plugins/flot/jquery.flot.js"></script>
<script src="assets/plugins/flot/jquery.flot.resize.js"></script>
<script  src="assets/plugins/flot/jquery.flot.pie.js"></script>
<script src="assets/js/pie_chart.js"></script>

<script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="assets/js/details.js"></script>

<div class="modal fade" role="dialog" id="myModal" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">

                </h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {
        $('.dataTables-example').dataTable();

        $(".del").click(function(){
            if(confirm('Realmente deseja excluir esta informação?')) {
                var id = $(this).attr('data-id');
                var table = $(this).attr('data-table');
                $.ajax({
                    url: 'ajax/controller.php',
                    type: 'POST',
                    data: 'acao=Delete&id=' + id+'&table='+table,
                    success: function (retorno) {
                        console.log(retorno);
                        if(retorno === 'success') {
                            alert('Dado excluido com sucesso!');
                            location.reload();
                        }else
                            alert('Não foi possível realizar está operação!');
                    }
                });
            }
            return false;
        });

        $(".makeLeader").click(function(){
            var name = $(this).attr('data-name');
            if(confirm('Deseja torna '+name+' um(a) Líder Calebe?')) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: 'ajax/controllerAlt.php',
                    type: 'POST',
                    data: 'acao=makeLeader&id=' + id,
                    success: function (retorno) {
                        console.log(retorno);
                        if(retorno === 'success') {
                            window.location = 'consulta.php?p=lider';
                        }else
                            alert('Não foi possível realizar está operação!');
                    }
                });
            }
            return false;
        });

        $(".makeAdmin").click(function(){
            var name = $(this).attr('data-name');
            if(confirm('Deseja torna '+name+' um(a) Administrador(a)?')) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: 'ajax/controllerAlt.php',
                    type: 'POST',
                    data: 'acao=makeAdmin&id=' + id,
                    success: function (retorno) {
                        console.log(retorno);
                        if(retorno === 'success') {
                            window.location = 'consulta.php?p=admin';
                        }else
                            alert('Não foi possível realizar está operação!');
                    }
                });
            }
            return false;
        });

        $(".removeAdmin").click(function(){
            var name = $(this).attr('data-name');
            if(confirm('Deseja retirar '+name+' de Administrador(a)?')) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: 'ajax/controllerAlt.php',
                    type: 'POST',
                    data: 'acao=removeAdmin&id=' + id,
                    success: function (retorno) {
                        console.log(retorno);
                        if(retorno === 'success') {
                            window.location = 'consulta.php?p=lider';
                        }else
                            alert('Não foi possível realizar está operação!');
                    }
                });
            }
            return false;
        });

        $(".removeLeader").click(function(){
            var name = $(this).attr('data-name');
            if(confirm('Deseja retirar '+name+' de Líder Calebe?')) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: 'ajax/controllerAlt.php',
                    type: 'POST',
                    data: 'acao=removeLeader&id=' + id,
                    success: function (retorno) {
                        console.log(retorno);
                        if(retorno === 'success') {
                            location.reload();
                        }else
                            alert('Não foi possível realizar está operação!');
                    }
                });
            }
            return false;
        });

    });
</script>

<!--END PAGE LEVEL SCRIPT-->
</body>
<!-- END BODY-->

</html>
