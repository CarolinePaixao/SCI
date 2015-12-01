<?php
include_once 'class/Resident.php';
$id = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
if(Resident::getResident("AND p.id_person = $id")) {
    $res = Resident::getResident("AND p.id_person = $id");
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Alterar Morador</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-8 col-md-offset-3">
            <ul class="nav nav-wizard">
                <li class="active" id="1"><a href="#">Dados Pessoais</a></li>
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
                    <form id="formAltMorador" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">ID</label>

                            <div class="col-lg-1">
                                <input type="text" id="ID_PERSON" readonly name="ID_PERSON" value="<?=$res->getId()?>" maxlength="80" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">Nome Completo</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_PERSON" name="NAME_PERSON" value="<?=$res->getName()?>" maxlength="80" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Email</label>

                            <div class="col-lg-5">
                                <input type="email" id="EMAIL" name="EMAIL" maxlength="120" value="<?=$res->getEmail()?>" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Idade</label>

                            <div class="col-lg-1">
                                <input type="number" id="AGE" name="AGE" min="12" max="70" class="form-control" value="<?=$res->getAge()?>" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Sexo</label>

                            <div class="col-lg-5">
                                <div class="checkbox">
                                    <label>
                                        <input class="uniform" type="radio" name="SEX" value="F" required <?php if($res->getSex() == 'F') echo 'checked';?>/> Feminino
                                    </label>
                                    <label>
                                        <input class="uniform" type="radio" name="SEX" value="M" <?php if($res->getSex() == 'M') echo 'checked';?>/> Masculino
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Telefone</label>

                            <div class="col-lg-2">
                                <input type="text" id="PHONE" name="PHONE" class="form-control" data-mask="(99)9999-9999?9" value="<?=Functions::pushMask($res->getPhone())?>" required/>
                            </div>
                            <label for="pass1" class="control-label col-lg-1">Operadora</label>
                            <div class="col-lg-2">
                                <select name="OPERATOR" class="form-control">
                                    <option value="">Selecione a Operadora</option>
                                    <option <?php if($res->getOperator() == 'Oi') echo 'selected';?>>Oi</option>
                                    <option <?php if($res->getOperator() == 'Tim') echo 'selected';?>>Tim</option>
                                    <option <?php if($res->getOperator() == 'Vivo') echo 'selected';?>>Vivo</option>
                                    <option <?php if($res->getOperator() == 'Claro') echo 'selected';?>>Claro</option>
                                    <option <?php if($res->getOperator() == 'Vivo Fixo') echo 'selected';?>>Vivo Fixo</option>
                                    <option <?php if($res->getOperator() == 'Residêncial') echo 'selected';?>>Residêncial</option>
                                    <option <?php if($res->getOperator() == 'Outro') echo 'selected';?>>Outro</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Estado Civil</label>

                            <div class="col-lg-5">
                                <select name="MARITAL_STATUS" class="form-control" required>
                                    <option value="">Selecione o Estado Civil</option>
                                    <option <?php if($res->getMaritalStatus() == 'Solteiro(a)') echo 'selected';?>>Solteiro(a)</option>
                                    <option <?php if($res->getMaritalStatus() == 'Casado(a)') echo 'selected';?>>Casado(a)</option>
                                    <option <?php if($res->getMaritalStatus() == 'Viúvo(a)') echo 'selected';?>>Viúvo(a)</option>
                                    <option <?php if($res->getMaritalStatus() == 'Divorciado(a)') echo 'selected';?>>Divorciado(a)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Filhos</label>

                            <div class="col-lg-1" >
                                <input type="number" id="CHILDREN" name="CHILDREN" min="0" max="10" value="<?=$res->getChildren()?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Chefe de Familia</label>

                            <div class="col-lg-5">
                                <select name="HOUSEFATHER" id="HOUSEFATHER" class="form-control" required>
                                    <option value="">Selecione o Chefe de Familia</option>
                                    <option <?php if($res->getHouseFather() == 'Você mesmo') echo 'selected';?>>Você mesmo</option>
                                    <option <?php if($res->getHouseFather() == 'Pai/Mãe') echo 'selected';?>>Pai/Mãe</option>
                                    <option <?php if($res->getHouseFather() == 'Marido/Esposa') echo 'selected';?>>Marido/Esposa</option>
                                    <option <?php if($res->getHouseFather() == 'Irmão(ã)') echo 'selected';?>>Irmão(ã)</option>
                                    <option <?php if($res->getHouseFather() == 'Outro') echo 'selected';?>>Outro</option>
                                </select>
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
                                            if($rel->getId() == $res->getReligion()->getId())
                                                echo '<option value="'.$rel->getId().'" selected>'.$rel->getName().'</option>';
                                            else
                                                echo '<option value="'.$rel->getId().'">'.$rel->getName().'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Mora com quantas pessoas</label>

                            <div class="col-lg-2" >
                                <input type="number" id="NUMBER_RESIDENT_HOUSE" name="NUMBER_RESIDENT_HOUSE" min="0" value="<?=$res->getNumberResident()?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Parentes Adventitas</label>

                            <div class="col-lg-2" >
                                <input type="number" id="COGNATE_ADVENTISTA" name="COGNATE_ADVENTISTA" min="0" value="<?=$res->getCognateAdventista()?>" class="form-control" />
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
                <div class="step2" style="display: none;">
                    <form id="formAltMoradorEnd" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">ID</label>

                            <div class="col-lg-1">
                                <input type="text" id="ID_ADDRESS" name="ID_ADDRESS" READONLY value="<?=$res->getAddress()->getId()?>" class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">CEP</label>

                            <div class="col-lg-5">
                                <input type="text" id="ZIPCODE" name="ZIPCODE" maxlength="8" value="<?=$res->getAddress()->getZipcode()?>" class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Logradouro</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_ADDRESS" name="NAME_ADDRESS" maxlength="80" value="<?=$res->getAddress()->getStreet()?>" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Número</label>
                            <div class="col-lg-1">
                                <input type="text" id="NUMBER" name="NUMBER" maxlength="5" pattern="[0-9]+$" value="<?=$res->getAddress()->getNumber()?>" class="form-control" required />
                            </div>
                            <label for="pass1" class="control-label col-lg-1">Complemento</label>
                            <div class="col-lg-3">
                                <input type="text" id="COMPLEMENT" name="COMPLEMENT" maxlength="45" value="<?=$res->getAddress()->getComplement()?>" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Bairro</label>

                            <div class="col-lg-5">
                                <input type="text" id="DISTRICT" name="DISTRICT" maxlength="80" value="<?=$res->getAddress()->getDistrict()?>" class="form-control" required/>
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
                                        if($list['INITIALS'] == $res->getAddress()->getState()) {
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
                                        if($list['NAME_CITY'] == $res->getAddress()->getCity())
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
                                <textarea name="PS" class="form-control" rows="3" ><?=$res->getAddress()->getPs()?></textarea>
                            </div>
                        </div>

                        <input type="hidden" id="LATITUDE" name="LATITUDE" maxlength="80" value="<?=$res->getAddress()->getLatitude()?>" class="form-control" />
                        <input type="hidden" id="LONGITUDE" name="LONGITUDE" maxlength="80" value="<?=$res->getAddress()->getLongitude()?>" class="form-control" />

                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-4">
                                <button type="button" data-back="2" class="btn btn-primary back">Voltar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- FIM SEGUNDO PASSO - ENDEREÇO -->

                <div class="step3 col-md-offset-3 col-md-6" style="text-align: center; display: none;">
                    <h2 class="alert alert-success">O Morador foi alterado com sucesso!</h2>
                    <a href="consulta.php?p=morador"><button class="btn btn-primary">Voltar à consulta!</button></a>
                </div>

            </div>
        </div>
    </div>

</div>

