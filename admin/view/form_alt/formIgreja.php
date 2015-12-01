<?php
if($_SESSION['login']['role'] < 2){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{

    include_once 'class/Church.php';

$id = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
if(Church::getChurch("WHERE id_church = $id")){
    $church = Church::getChurch("WHERE id_church = $id");
}else
    echo '<script>window.location = "index.php"</script>';

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Alterar Igreja</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-6 col-md-offset-3">
            <ul class="nav nav-wizard">
                <li class="active" id="1"><a href="#">Dados da Igreja</a></li>
                <li class="disabled" id="2"><a href="#">Endereço</a></li>
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
                    <form id="formAltIgreja" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">ID</label>

                            <div class="col-lg-1">
                                <input type="text" name="ID_CHURCH" value="<?=$church->getId()?>" maxlength="80" class="form-control" readonly required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">Nome da Igreja</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_CHURCH" name="NAME_CHURCH" value="<?=$church->getName()?>" maxlength="80" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Pastor</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_PASTOR" name="NAME_PASTOR" value="<?=$church->getPastor()?>" maxlength="80" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Status</label>

                            <div class="col-lg-5">
                                <select name="STATUS" class="form-control" required>
                                    <option <?php if($church->getStatus() == 'Ativo') echo 'selected'; ?>>Ativo</option>
                                    <option <?php if($church->getStatus() == 'Bloqueado') echo 'selected'; ?>>Bloqueado</option>
                                    <option <?php if($church->getStatus() == 'Inativo') echo 'selected'; ?>>Inativo</option>
                                    <option >Banido</option>
                                </select>
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

                <!-- SEGUNDO PASSO - ENDEREÇO -->
                <div class="step2" style="display: none">
                    <form id="formAltIgrejaEnd" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">ID</label>

                            <div class="col-lg-1">
                                <input type="text" id="ID_ADDRESS" name="ID_ADDRESS" READONLY value="<?=$church->getAddress()->getId()?>" class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">CEP</label>

                            <div class="col-lg-5">
                                <input type="text" id="ZIPCODE" name="ZIPCODE" maxlength="8" value="<?=$church->getAddress()->getZipcode()?>" class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Logradouro</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_ADDRESS" name="NAME_ADDRESS" maxlength="80" value="<?=$church->getAddress()->getStreet()?>" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Número</label>
                            <div class="col-lg-1">
                                <input type="text" id="NUMBER" name="NUMBER" maxlength="5" pattern="[0-9]+$" value="<?=$church->getAddress()->getNumber()?>" class="form-control" required />
                            </div>
                            <label for="pass1" class="control-label col-lg-1">Complemento</label>
                            <div class="col-lg-3">
                                <input type="text" id="COMPLEMENT" name="COMPLEMENT" maxlength="45" value="<?=$church->getAddress()->getComplement()?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Bairro</label>

                            <div class="col-lg-5">
                                <input type="text" id="DISTRICT" name="DISTRICT" maxlength="80" value="<?=$church->getAddress()->getDistrict()?>" class="form-control" required/>
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
                                        if($list['INITIALS'] == $church->getAddress()->getState()) {
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
                                        if($list['NAME_CITY'] == $church->getAddress()->getCity())
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
                                <textarea name="PS" class="form-control" rows="3" ><?=$church->getAddress()->getPs()?></textarea>
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
                    <h2 class="alert alert-success">Igreja alterada com sucesso!</h2>
                    <a href="consulta.php?p=igreja"><button class="btn btn-primary">Voltar à consulta!</button></a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php } ?>