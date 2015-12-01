<?php
session_start();
include_once "class/Functions.php";
include_once 'class/Calebe.php';

Functions::verLog(1);
if(isset($_GET['logout'])){
    unset($_SESSION);
    session_destroy();
    header('LOCATION: login.html');
}

$id = $_SESSION['login']['id_person'];
$role = $_SESSION['login']['role'];
if($role == 3){
    if(Person::getPerson("WHERE id_person = $id")){
        $cal = Person::getPerson("WHERE id_person = $id");
        $type = 'person';
    }

}else if($role == 2 || $role == 1){
    if(Calebe::getCalebe("AND p.id_person = $id")) {
        $cal = Calebe::getCalebe("AND p.id_person = $id");
        $type = 'calebe';
    }

}else{
    echo '<script>window.location = "index.php";</script>';
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

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Alterar Dados</h2>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="box dark">
                    <header>
                        <div class="icons"><i class="icon-edit"></i></div>
                        <h5>Dados Pessoais</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li>
                                    <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-1">
                                        <i class="icon-chevron-up"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </header>
                    <div id="div-1" class="accordion-body collapse in body">
                        <form class="form-horizontal" id="formPerfilPessoal">

                            <div class="form-group" style="display: none;">
                                <div class="col-lg-5">
                                    <input id="type" name="type" value="<?=$type?>" data-id="<?=$cal->getId()?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nome" class="control-label col-lg-4">ID</label>

                                <div class="col-lg-1">
                                    <input type="text" id="ID_PERSON" name="ID_PERSON" value="<?=$cal->getId()?>" readonly maxlength="80" class="form-control" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nome" class="control-label col-lg-4">Nome Completo</label>

                                <div class="col-lg-5">
                                    <input type="text" id="NAME_PERSON" name="NAME_PERSON" value="<?=$cal->getName()?>" maxlength="80" class="form-control" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Email</label>

                                <div class="col-lg-5">
                                    <input type="email" id="EMAIL" name="EMAIL" maxlength="120" value="<?=$cal->getEmail()?>" class="form-control" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Idade</label>

                                <div class="col-lg-1">
                                    <input type="number" id="AGE" name="AGE" min="12" max="70" value="<?=$cal->getAge()?>" class="form-control" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Sexo</label>

                                <div class="col-lg-5">
                                    <div class="checkbox">
                                        <label>
                                            <input class="uniform" type="radio" name="SEX" value="F" required <?php if($cal->getSex() == 'F') echo 'checked';?>/> Feminino
                                        </label>
                                        <label>
                                            <input class="uniform" type="radio" name="SEX" value="M" <?php if($cal->getSex() == 'M') echo 'checked';?>/> Masculino
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Telefone</label>

                                <div class="col-lg-2">
                                    <input type="text" id="PHONE" name="PHONE" class="form-control" data-mask="(99)9999-9999?9" value="<?=$cal->getPhone()?>" required/>
                                </div>
                                <label for="pass1" class="control-label col-lg-1">Operadora</label>
                                <div class="col-lg-2">
                                    <select name="OPERATOR" class="form-control">
                                        <option value="">Selecione a Operadora</option>
                                        <option <?php if($cal->getOperator() == 'Oi') echo 'selected';?>>Oi</option>
                                        <option <?php if($cal->getOperator() == 'Tim') echo 'selected';?>>Tim</option>
                                        <option <?php if($cal->getOperator() == 'Vivo') echo 'selected';?>>Vivo</option>
                                        <option <?php if($cal->getOperator() == 'Claro') echo 'selected';?>>Claro</option>
                                        <option <?php if($cal->getOperator() == 'Vivo Fixo') echo 'selected';?>>Vivo Fixo</option>
                                        <option <?php if($cal->getOperator() == 'Residêncial') echo 'selected';?>>Residêncial</option>
                                        <option <?php if($cal->getOperator() == 'Outro') echo 'selected';?>>Outro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Estado Civil</label>

                                <div class="col-lg-5">
                                    <select name="MARITAL_STATUS" class="form-control" required>
                                        <option value="">Selecione o Estado Civil</option>
                                        <option <?php if($cal->getMaritalStatus() == 'Solteiro(a)') echo 'selected';?>>Solteiro(a)</option>
                                        <option <?php if($cal->getMaritalStatus() == 'Casado(a)') echo 'selected';?>>Casado(a)</option>
                                        <option <?php if($cal->getMaritalStatus() == 'Viúvo(a)') echo 'selected';?>>Viúvo(a)</option>
                                        <option <?php if($cal->getMaritalStatus() == 'Divorciado(a)') echo 'selected';?>>Divorciado(a)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Filhos</label>

                                <div class="col-lg-1" >
                                    <input type="number" id="CHILDREN" name="CHILDREN" min="0" max="10" value="<?=$cal->getChildren()?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="religion" class="control-label col-lg-4">Religião</label>

                                <div class="col-lg-5">
                                    <select name="ID_RELIGION" id="ID_RELIGION" class="form-control" required>
                                        <option value="">Selecione a Religião</option>
                                        <?php
                                        if(Religion::getReligions()){
                                            foreach(Religion::getReligions() as $rel){
                                                if($rel->getId() == $cal->getReligion()->getId())
                                                    echo '<option value="'.$rel->getId().'" selected>'.$rel->getName().'</option>';
                                                else
                                                    echo '<option value="'.$rel->getId().'">'.$rel->getName().'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="calebe"></div>

                            <div class="form-group">
                                <div class="col-md-offset-8">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="box dark">
                    <header>
                        <div class="icons"><i class="icon-edit"></i></div>
                        <h5>Endereço</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li>
                                    <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-2">
                                        <i class="icon-chevron-up"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </header>
                    <div id="div-2" class="accordion-body collapse in body">
                        <form class="form-horizontal" id="formPerfilEnd">

                            <div class="form-group" style="display:none;">
                                <label for="nome" class="control-label col-lg-4">ID</label>

                                <div class="col-lg-1">
                                    <input type="text" id="ID_ADDRESS" name="ID_ADDRESS"  READONLY value="<?=$cal->getAddress()->getId()?>" class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nome" class="control-label col-lg-4">CEP</label>

                                <div class="col-lg-5">
                                    <input type="text" id="ZIPCODE" name="ZIPCODE" maxlength="8" value="<?=$cal->getAddress()->getZipcode()?>" class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Logradouro</label>

                                <div class="col-lg-5">
                                    <input type="text" id="NAME_ADDRESS" name="NAME_ADDRESS" maxlength="80" value="<?=$cal->getAddress()->getStreet()?>" class="form-control" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Número</label>
                                <div class="col-lg-1">
                                    <input type="text" id="NUMBER" name="NUMBER" maxlength="5" pattern="[0-9]+$" value="<?=$cal->getAddress()->getNumber()?>" class="form-control" required />
                                </div>
                                <label for="pass1" class="control-label col-lg-1">Complemento</label>
                                <div class="col-lg-3">
                                    <input type="text" id="COMPLEMENT" name="COMPLEMENT" maxlength="45" value="<?=$cal->getAddress()->getComplement()?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Bairro</label>

                                <div class="col-lg-5">
                                    <input type="text" id="DISTRICT" name="DISTRICT" maxlength="80" value="<?=$cal->getAddress()->getDistrict()?>" class="form-control" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Estado</label>

                                <div class="col-lg-5">
                                    <select name="STATE" id="STATE" class="form-control" required>
                                        <?php
                                        $states = Functions::getState();
                                        echo '<option value="">Selecione o Estado</option>';
                                        foreach($states as $list){
                                            if($list['INITIALS'] == $cal->getAddress()->getState()) {
                                                $id_state = $list['ID_STATE'];
                                                echo '<option value="' . $list['ID_STATE'] . '" selected>' . $list['NAME_STATE'] . "</option>";
                                            }
                                            else
                                                echo '<option value="'.$list['ID_STATE'].'">'.$list['NAME_STATE']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Cidade</label>

                                <div class="col-lg-5">
                                    <select name="ID_CITY" id="ID_CITY" class="form-control" required>
                                        <?php
                                        $city = Functions::getCity("id_state = $id_state");
                                        echo '<option value="">Selecione a Cidade</option>';
                                        foreach($city as $list){
                                            if($list['NAME_CITY'] == $cal->getAddress()->getCity())
                                                echo '<option value="'.$list['ID_CITY'].'" selected>'.$list['NAME_CITY']."</option>";
                                            else
                                                echo '<option value="'.$list['ID_CITY'].'">'.$list['NAME_CITY']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Observação</label>

                                <div class="col-lg-5">
                                    <textarea name="PS" class="form-control" rows="3" ><?=$cal->getAddress()->getPs()?></textarea>
                                </div>
                            </div>

                            <input type="hidden" id="LATITUDE" name="LATITUDE" maxlength="80" value="<?=$cal->getAddress()->getLatitude()?>" class="form-control" />
                            <input type="hidden" id="LONGITUDE" name="LONGITUDE" maxlength="80" value="<?=$cal->getAddress()->getLongitude()?>" class="form-control" />

                            <div class="form-group">
                                <div class="col-md-offset-8">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="box dark">
                    <header>
                        <div class="icons"><i class="icon-edit"></i></div>
                        <h5>Senha</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li>
                                    <a class="accordion-toggle minimize-box" data-toggle="collapse" href="#div-3">
                                        <i class="icon-chevron-up"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </header>
                    <div id="div-3" class="accordion-body collapse in body">
                        <form class="form-horizontal" id="formPerfilLog">

                            <div class="form-group" style="display:none;">
                                <label for="nome" class="control-label col-lg-4">ID</label>

                                <div class="col-lg-1">
                                    <input type="text" id="ID_LOGIN" name="ID_LOGIN" value="<?=$cal->getLogin()->getId()?>" readonly class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nome" class="control-label col-lg-4">Email</label>

                                <div class="col-lg-5">
                                    <input type="text" id="USER_NAME" name="USER_NAME" value="<?=$cal->getLogin()->getUser()?>" readonly class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Senha</label>

                                <div class="col-lg-5">
                                    <input type="password" id="USER_PASS" name="USER_PASS" pattern=".{6,20}" class="form-control" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Confirmar Senha</label>

                                <div class="col-lg-5">
                                    <input type="password" id="pass2" name="pass2"  pattern=".{6,20}" class="form-control" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-8">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
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
