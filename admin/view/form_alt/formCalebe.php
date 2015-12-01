<?php
if($_SESSION['login']['role'] != 3){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{
    include_once 'class/Calebe.php';

    $id = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
    if(Calebe::getCalebe("AND p.id_person = $id")) {
        $cal = Calebe::getCalebe("AND p.id_person = $id");
    }else{
        echo '<script>window.location = "index.php";</script>';
    }
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Alterar Calebe</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-6 col-md-offset-3">
            <ul class="nav nav-wizard">
                <li class="active" id="1"><a href="#">Dados Pessoais</a></li>
                <li class="disabled" id="2"><a href="#">Endereço</a></li>
                <li class="disabled" id="3"><a href="#">Login</a></li>
                <li class="disabled" id="4"><a href="#">Finalizar</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box dark">
            <div id="div-1" class="accordion-body collapse in body">
                    <div class="col-md-6 col-md-offset-3 message" style="text-align: center"></div>
                    <!-- PRIMEIRO PASSO - DADOS PESSOAIS -->
                    <div class="step1">
                        <form id="formAltCalebe" class="form-horizontal">
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
                                    <input type="text" id="PHONE" name="PHONE" class="form-control" data-mask="(99)9999-9999?9" value="<?=Functions::pushMask($cal->getPhone())?>" required/>
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
                                <label for="pass1" class="control-label col-lg-4">Ano de Inicío de Estudo Biblíco</label>

                                <div class="col-lg-2">
                                    <input type="number" id="TIME_STUDY" name="TIME_STUDY" min="1930" max="2015" value="<?=$cal->getTimeStudy()?>" placeholder="YYYY" class="form-control" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">É batizado</label>

                                <div class="col-lg-5">
                                    <div class="checkbox">
                                        <label>
                                            <input class="uniform" type="radio" name="BAPTISM" value="1" <?php if($cal->getBaptism() == 1) echo 'checked';?> required /> Sim
                                        </label>
                                        <label>
                                            <input class="uniform" type="radio" name="BAPTISM" value="0" <?php if($cal->getBaptism() == 0) echo 'checked';?>/> Não
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="religion" class="control-label col-lg-4">Religião</label>

                                <div class="col-lg-5">
                                    <select name="ID_RELIGION" id="ID_RELIGION_C" class="form-control" required>
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

                            <div class="form-group lider" <?php if($cal->getReligion()->getId() != 1 || $cal->getBaptism() != 1) echo 'style="display: none;"'; ?>>
                                <label for="pass1" class="control-label col-lg-4">Será Líder</label>

                                <div class="col-lg-5">
                                    <div class="checkbox">
                                        <label>
                                            <input class="uniform" type="radio" name="LEADER" value="2" <?php if($cal->getLeader() == 2) echo 'checked';?>  /> Sim
                                        </label>
                                        <label>
                                            <input class="uniform" type="radio" name="LEADER" id="#N" value="1"  <?php if($cal->getLeader() == 1) echo 'checked';?>  /> Não
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Status</label>

                                <div class="col-lg-5">
                                    <select name="STATUS" class="form-control" required>
                                        <option value="">Selecione o Status</option>
                                        <option <?php if($cal->getStatus() == 'Ativo') echo 'selected'; ?>>Ativo</option>
                                        <option <?php if($cal->getStatus() == 'Bloqueado') echo 'selected'; ?>>Bloqueado</option>
                                        <option <?php if($cal->getStatus() == 'Inativo') echo 'selected'; ?>>Inativo</option>
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
                    <div class="step2" style="display: none;">
                        <form id="formAltCalebeEnd" class="form-horizontal">
                            <div class="form-group">
                                <label for="nome" class="control-label col-lg-4">ID</label>

                                <div class="col-lg-1">
                                    <input type="text" id="ID_ADDRESS" name="ID_ADDRESS" READONLY value="<?=$cal->getAddress()->getId()?>" class="form-control" pattern="[0-9]+$" placeholder="Apenas Números" required />
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

                    <!-- TERCEIRO PASSO - LOGIN -->
                    <div class="step3" style="display: none;">
                        <form id="formAltCalebeLogin" class="form-horizontal">
                            <div class="form-group">
                                <label for="nome" class="control-label col-lg-4">Email</label>

                                <div class="col-lg-5">
                                    <input type="text" id="USER_NAME" name="USER_NAME" value="<?=$cal->getLogin()->getUser()?>" readonly class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Senha</label>

                                <div class="col-lg-5">
                                    <input type="password" id="USER_PASS" name="USER_PASS" pattern=".{6,20}" value="<?=$cal->getLogin()->getPass()?>" class="form-control" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass1" class="control-label col-lg-4">Confirmar Senha</label>

                                <div class="col-lg-5">
                                    <input type="password" id="pass2" name="pass2"  pattern=".{6,20}" value="<?=$cal->getLogin()->getPass()?>" class="form-control" required />
                                </div>
                            </div>

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
                    <!-- FIM TERCEIRO PASSO - LOGIN -->

                <div class="step4 col-md-offset-3 col-md-6" style="text-align: center; display: none;">
                    <h2 class="alert alert-success">O Calebe foi alterado com sucesso! <br> </h2>
                    <a href="consulta.php?p=calebe"><button class="btn btn-primary">Voltar à consulta!</button></a>
                </div>

            </div>
        </div>
    </div>

</div>

<?php } ?>