<?php
ini_set('display_errors','On'); ini_set('error_reporting','E_ALL'); error_reporting(E_ALL);
?>
<div id="top">

    <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
        <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
            <i class="icon-align-justify"></i>
        </a>
        <!-- LOGO SECTION -->
        <header class="navbar-header">

            <a href="index.php" class="navbar-brand">
                <img src="assets/img/missaocalebe.png" width="100px" height="40" alt="" />

            </a>
        </header>
        <!-- END LOGO SECTION -->

        <!--ADMIN SETTINGS SECTIONS -->
        <ul class="nav navbar-top-links navbar-right">
            <li>
                Nível: <?php
                            if($_SESSION['login']['role'] == 3) echo 'Administrador';
                             else if($_SESSION['login']['role'] == 2) echo 'Líder';
                            else echo 'Calebe';
                        ?>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="editPerfil.php"><i class="icon-cog"></i> Configurar Perfil </a>
                    </li>
                    <?php  if($_SESSION['login']['role'] == 3){ ?>
                    <li class="divider"></li>
                    <li>
                        <a href="consulta.php?p=admin"><i class="icon-eye-open"></i> Ver Administradores </a>
                    </li>
                    <li>
                        <a href="forms.php?p=cadAdmin"><i class="icon-plus"></i> Adicionar Administrador </a>
                    </li>
                    <?php } ?>
                    <li class="divider"></li>
                    <li>
                        <a href="?logout"><i class="icon-signout"></i> Sair </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!--END ADMIN SETTINGS -->
        <ul class="nav navbar-top-links" style="text-align: center">
            <!--ADMIN SETTINGS SECTIONS -->
            <li><h3 class="media-heading" style="text-align: center">Bem vindo, <?=$_SESSION['login']['name'];?></h3></li>
                <!--END ADMIN SETTINGS -->
        </ul>


    </nav>

</div>