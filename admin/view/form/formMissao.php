<?php
if($_SESSION['login']['role'] < 2){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{
include_once 'class/Team.php';
include_once 'class/Church.php';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastrar Missão</h1>
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
                    <form id="formMissao" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">Nome da Missão</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_MISSION" name="NAME_MISSION" maxlength="80" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Data Inicial</label>

                            <div class="col-lg-2">
                                <div class="input-group input-append date" id="dp3" data-date="<?=date("d/m/Y");?>"
                                     data-date-format="dd/mm/yyyy">
                                    <input class="form-control" type="text" name="DATE_INITIAL" value="<?=date("d/m/Y");?>" readonly="" />
                                    <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>

                            <label class="control-label col-lg-1">Final</label>

                            <div class="col-lg-2">
                                <div class="input-group input-append date" id="dp2" data-date="<?=date('d/m/Y');?>"
                                     data-date-format="dd/mm/yyyy">
                                    <input class="form-control" type="text" name="DATE_END" value="<?=date('d/m/Y');?>" readonly="" />
                                    <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4" title="É necessário que tenha ao menos uma equipe disponivel">Equipe da Missão</label>

                            <div class="col-lg-5">
                                <select name="ID_TEAM" class="form-control" required title="É necessário que tenha ao menos uma equipe disponivel">
                                    <option value="">Selecione a Equipe</option>
                                    <?php
                                    if(Team::getTeams()){
                                        foreach(Team::getTeams() as $rel){
                                            if($rel->getStatus() == 'Disponível')
                                                echo '<option value="'.$rel->getId().'">'.$rel->getName().'</option>';
                                        }
                                    }else
                                        echo '<script>
                                                        alert("Para agendar uma Missão é necessário ter ao menos uma Equipe!");
                                                        window.location = "consulta.php?p=equipe";
                                                  </script>';
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Status</label>

                            <div class="col-lg-5">
                                <select name="STATUS" class="form-control" required>
                                    <option value="">Selecione o Status</option>
                                    <option selected>Agendado</option>
                                    <option>Concluida</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Será realizada em </label>

                            <div class="col-lg-5">
                                <div class="checkbox">
                                    <label>
                                        <input class="uniform" type="radio" name="realizar" value="I" /> Igreja
                                    </label>
                                    <label>
                                        <input class="uniform" type="radio" name="realizar" value="E" /> Endereço
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
                    <form id="formMissaoIgreja" class="form-horizontal">
                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Igreja</label>

                            <div class="col-lg-5">
                                <select name="ID_CHURCH" class="form-control" required>
                                    <option>Selecione a Igreja</option>
                                    <?php
                                    if(Church::getChurches()){
                                        foreach(Church::getChurches() as $rel){
                                            echo '<option value="'.$rel->getId().'">'.$rel->getName().'</option>';
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
                    <form id="formMissaoEnd" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">CEP</label>

                            <div class="col-lg-5">
                                <input type="text" id="ZIPCODE" name="ZIPCODE" maxlength="8" class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Logradouro</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_ADDRESS" name="NAME_ADDRESS" maxlength="80" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Número</label>
                            <div class="col-lg-1">
                                <input type="text" id="NUMBER" name="NUMBER" maxlength="5" pattern="[0-9]+$" class="form-control" required />
                            </div>
                            <label for="pass1" class="control-label col-lg-1">Complemento</label>
                            <div class="col-lg-3">
                                <input type="text" id="COMPLEMENT" name="COMPLEMENT" maxlength="45" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Bairro</label>

                            <div class="col-lg-5">
                                <input type="text" id="DISTRICT" name="DISTRICT" maxlength="80" class="form-control" required/>
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
                                    <option value="">Selecione primeiramente o Estado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Observação</label>

                            <div class="col-lg-5">
                                <textarea name="PS" class="form-control" rows="3" ></textarea>
                            </div>
                        </div>

                        <input type="hidden" id="LATITUDE" name="LATITUDE" maxlength="80" class="form-control" />
                        <input type="hidden" id="LONGITUDE" name="LONGITUDE" maxlength="80" class="form-control" />


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
                    <h2 class="alert alert-success">Missão cadastrada com sucesso! </h2>
                    <a href="consulta.php?p=missao"><button class="btn btn-primary">Voltar à consulta!</button></a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php } ?>