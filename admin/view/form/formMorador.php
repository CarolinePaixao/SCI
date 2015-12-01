<?php

include_once 'class/Functions.php';
include_once 'class/Religion.php';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastrar Morador</h1>
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
                    <form id="formMorador" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">Nome Completo</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_PERSON" name="NAME_PERSON" maxlength="80" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Email</label>

                            <div class="col-lg-5">
                                <input type="email" id="EMAIL" name="EMAIL" maxlength="120" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Idade</label>

                            <div class="col-lg-1">
                                <input type="number" id="AGE" name="AGE" min="12" max="70" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Sexo</label>

                            <div class="col-lg-5">
                                <div class="checkbox">
                                    <label>
                                        <input class="uniform" type="radio" name="SEX" value="F" required /> Feminino
                                    </label>
                                    <label>
                                        <input class="uniform" type="radio" name="SEX" value="M" /> Masculino
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Telefone</label>

                            <div class="col-lg-2">
                                <input type="text" id="PHONE" name="PHONE" class="form-control" data-mask="(99)9999-9999?9" required/>
                            </div>
                            <label for="pass1" class="control-label col-lg-1">Operadora</label>
                            <div class="col-lg-2">
                                <select name="OPERATOR" class="form-control">
                                    <option value="">Selecione a Operadora</option>
                                    <option>Oi</option>
                                    <option>Tim</option>
                                    <option>Vivo</option>
                                    <option>Claro</option>
                                    <option>Vivo Fixo</option>
                                    <option>Residêncial</option>
                                    <option>Outro</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Estado Civil</label>

                            <div class="col-lg-5">
                                <select name="MARITAL_STATUS" class="form-control" required>
                                    <option value="">Selecione o Estado Civil</option>
                                    <option>Solteiro(a)</option>
                                    <option>Casado(a)</option>
                                    <option>Viúvo(a)</option>
                                    <option>Divorciado(a)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Filhos</label>

                            <div class="col-lg-1" >
                                <input type="number" id="CHILDREN" name="CHILDREN" min="0" max="10" value="0" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Chefe de Familia</label>

                            <div class="col-lg-5">
                                <select name="HOUSEFATHER" id="HOUSEFATHER" class="form-control" required>
                                    <option value="">Selecione o Chefe de Familia</option>
                                    <option>Você mesmo</option>
                                    <option>Pai/Mãe</option>
                                    <option>Marido/Esposa</option>
                                    <option>Irmão(ã)</option>
                                    <option>Outro</option>
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
                                            echo '<option value="'.$rel->getId().'">'.$rel->getName().'</option>';
                                        }
                                    }else
                                        echo '<script>
                                                        alert("Para cadastrar um Morador é necessário ter ao menos uma Religião!");
                                                        window.location = "consulta.php?p=aux";
                                                  </script>';
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Mora com quantas pessoas</label>

                            <div class="col-lg-2" >
                                <input type="number" id="NUMBER_RESIDENT_HOUSE" name="NUMBER_RESIDENT_HOUSE" min="0" value="0" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Parentes Adventitas</label>

                            <div class="col-lg-2" >
                                <input type="number" id="COGNATE_ADVENTISTA" name="COGNATE_ADVENTISTA" min="0" value="0" class="form-control" />
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
                    <form id="formMoradorEnd" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">CEP</label>

                            <div class="col-lg-5">
                                <input type="text" id="ZIPCODE" name="ZIPCODE" maxlength="8" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Logradouro</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_ADDRESS" name="NAME_ADDRESS" maxlength="80" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Número</label>
                            <div class="col-lg-1">
                                <input type="text" id="NUMBER" name="NUMBER" pattern="[0-9]+$" maxlength="5" class="form-control" required/>
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
                                <select name="STATE" id="STATE" class="form-control" >
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
                                <select name="ID_CITY" id="ID_CITY" class="form-control" required >
                                    <option value="">Selecione Primeiramente Estado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Observação</label>

                            <div class="col-lg-5">
                                <textarea name="PS" class="form-control" rows="3" ></textarea>
                            </div>
                        </div>

                        <input type="hidden" id="LATITUDE" name="LATITUDE" maxlength="80" value="" class="form-control" />
                        <input type="hidden" id="LONGITUDE" name="LONGITUDE" maxlength="80" value="" class="form-control" />

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
                    <h2 class="alert alert-success">O Morador foi cadastrado com sucesso!</h2>
                    <a href="consulta.php?p=morador"><button class="btn btn-primary">Voltar à consulta!</button></a>
                </div>

            </div>
        </div>
    </div>

</div>

