<?php
if($_SESSION['login']['role'] < 2){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{

    include_once 'class/Mission.php';

$id = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
if(Mission::getMission("WHERE id_mission = $id")){
    $mission = Mission::getMission("WHERE id_mission = $id");
}else
    echo '<script>window.location = "index.php"</script>';

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Alterar Missão</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-6 col-md-offset-3">
            <ul class="nav nav-wizard">
                <li class="active" id="1"><a href="#">Dados da Missão</a></li>
                <li class="disabled" id="2"><a href="#">Local</a></li>
                <li class="disabled" id="3"><a href="#">Finalizar</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box dark">
            <div id="div-1" class="accordion-body collapse in body">
                <div class="message"></div>
                <!-- PRIMEIRO PASSO - DADOS PESSOAIS -->
                <div class="step1">
                    <form id="formAltMissao" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">ID</label>

                            <div class="col-lg-1">
                                <input type="text" id="ID_MISSION" name="ID_MISSION" value="<?=$mission->getId()?>" readonly class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">Nome da Missão</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_MISSION" name="NAME_MISSION" value="<?=$mission->getName()?>" maxlength="80" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Data Inicial</label>

                            <div class="col-lg-2">
                                <div class="input-group input-append date" id="dp3" data-date="<?=$mission->getDateBegin()?>"
                                     data-date-format="dd/mm/yyyy">
                                    <input class="form-control" type="text" name="DATE_INITIAL"  value="<?=$mission->getDateBegin()?>" readonly="" />
                                    <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>

                            <label class="control-label col-lg-1">Final</label>

                            <div class="col-lg-2">
                                <div class="input-group input-append date" id="dp2" data-date="<?=$mission->getDateEnd()?>"
                                     data-date-format="dd/mm/yyyy">
                                    <input class="form-control" type="text" name="DATE_END" value="<?=$mission->getDateEnd()?>" readonly="" />
                                    <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Equipe da Missão</label>

                            <div class="col-lg-5">
                                <select name="ID_TEAM" class="form-control" required>
                                    <option value="">Selecione a Equipe</option>
                                    <?php
                                    if(Team::getTeams()){
                                        foreach(Team::getTeams() as $team){
                                            if($mission->getTeam()->getId() == $team->getId())
                                                echo '<option value="'.$team->getId().'" selected>'.$team->getName().'</option>';
                                            else{
                                                if($team->getStatus() == 'Disponível')
                                                    echo '<option value="'.$team->getId().'">'.$team->getName().'</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Status</label>

                            <div class="col-lg-5">
                                <select name="STATUS" class="form-control" required>
                                    <option value="">Selecione o Status</option>
                                    <option <?php if($mission->getStatus() == 'Agendado') echo 'selected';?>>Agendado</option>
                                    <option <?php if($mission->getStatus() == 'Em Andamento') echo 'selected';?>>Em Andamento</option>
                                    <option <?php if($mission->getStatus() == 'Concluida') echo 'selected';?>>Cancelada</option>
                                    <option >Concluida</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Será realizada em </label>

                            <div class="col-lg-5">
                                <div class="checkbox">
                                    <label>
                                        <input class="uniform" type="radio" name="realizar" value="I" required <?php if($mission->getChurch()->getId()) echo 'checked';?>/> Igreja
                                    </label>
                                    <label>
                                        <input class="uniform" type="radio" name="realizar" value="E" <?php if($mission->getAddress()->getId()) echo 'checked';?>/> Endereço
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-8">
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- FIM PRIMEIRO PASSO - DADOS PESSOAIS -->

                <div class="step2Ig" style="display: none;">
                    <form id="formAltMissaoIgreja" class="form-horizontal">
                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Igreja</label>

                            <div class="col-lg-5">
                                <select name="ID_CHURCH" class="form-control" required>
                                    <option>Selecione a Igreja</option>
                                    <?php
                                    if(Church::getChurches()){
                                        foreach(Church::getChurches() as $chur){
                                            if($mission->getChurch() && $mission->getChurch()->getId() == $chur->getId() )
                                                echo '<option value="'.$chur->getId().'" selected>'.$chur->getName().'</option>';
                                            else
                                                echo '<option value="'.$chur->getId().'">'.$chur->getName().'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-4">
                                <button type="button" data-back="1" class="btn btn-primary back">Voltar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- SEGUNDO PASSO - ENDEREÇO -->
                <div class="step2End" style="display: none;">
                    <form id="formAltMissaoEnd" class="form-horizontal">
                        <?php if ($mission->getAddress()->getId()) { ?>
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">ID</label>

                            <div class="col-lg-1">
                                <input type="text" id="ID_ADDRESS" name="ID_ADDRESS" value="<?=$mission->getAddress()->getId()?>" readonly class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
                            </div>
                        </div>
                        <?php }?>
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">CEP</label>

                            <div class="col-lg-5">
                                <input type="text" id="ZIPCODE" name="ZIPCODE" maxlength="8"  value="<?=$mission->getAddress()->getZipcode()?>" class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Logradouro</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_ADDRESS" name="NAME_ADDRESS" maxlength="80"  value="<?=$mission->getAddress()->getStreet()?>" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Número</label>
                            <div class="col-lg-1">
                                <input type="text" id="NUMBER" name="NUMBER" maxlength="5" pattern="[0-9]+$" value="<?=$mission->getAddress()->getNumber()?>" class="form-control" required />
                            </div>
                            <label for="pass1" class="control-label col-lg-1">Complemento</label>
                            <div class="col-lg-3">
                                <input type="text" id="COMPLEMENT" name="COMPLEMENT" maxlength="45"  value="<?=$mission->getAddress()->getComplement()?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Bairro</label>

                            <div class="col-lg-5">
                                <input type="text" id="DISTRICT" name="DISTRICT" maxlength="80" value="<?=$mission->getAddress()->getDistrict()?>" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Estado</label>

                            <div class="col-lg-5">
                                <select name="STATE" id="STATE" class="form-control" required>
                                    <option value="">Selecione o Estado</option>
                                    <?php
                                    $states = Functions::getState();
                                    foreach($states as $list){
                                        if($list['INITIALS'] == $mission->getAddress()->getState()) {
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
                                    if(!empty($id_state)) {
                                        $city = Functions::getCity("id_state = $id_state");
                                        echo '<option value="">Selecione a Cidade</option>';
                                        foreach ($city as $list) {
                                            if ($list['NAME_CITY'] == $mission->getAddress()->getCity())
                                                echo '<option value="' . $list['ID_CITY'] . '" selected>' . $list['NAME_CITY'] . "</option>";
                                            else
                                                echo '<option value="' . $list['ID_CITY'] . '">' . $list['NAME_CITY'] . "</option>";
                                        }
                                    }else
                                        echo '<option value="">Selecione primeiramente o Estado</option>';
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Observação</label>

                            <div class="col-lg-5">
                                <textarea name="PS" class="form-control" rows="3" ><?=$mission->getAddress()->getPs()?></textarea>
                            </div>
                        </div>

                        <input type="hidden" id="LATITUDE" name="LATITUDE" maxlength="80" value="<?=$mission->getAddress()->getLatitude()?>" class="form-control" />
                        <input type="hidden" id="LONGITUDE" name="LONGITUDE" maxlength="80" value="<?=$mission->getAddress()->getLongitude()?>" class="form-control" />

                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-4">
                                <button type="button" data-back="1" class="btn btn-primary back">Voltar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- FIM SEGUNDO PASSO - ENDEREÇO -->


                <div class="step3 col-md-offset-3 col-md-6" style="text-align: center; display: none;">
                    <h2 class="alert alert-success">Missão alterada com sucesso! </h2>
                    <a href="consulta.php?p=missao"><button class="btn btn-primary">Voltar à consulta!</button></a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php } ?>