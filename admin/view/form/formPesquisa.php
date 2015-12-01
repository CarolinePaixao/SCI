<?php

include_once 'class/Database.php';
$id = filter_input(INPUT_GET, 'cod', FILTER_VALIDATE_INT);
$morador = Database::ReadOne('person', 'id_person, name_person', "where id_person = ".$id)
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pesquisa</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-8 col-md-offset-4">
            <ul class="nav nav-wizard">
                <li class="active" id="1"><a href="#">Pesquisa</a></li>
                <li class="disabled" id="2"><a href="#">Confirmar</a></li>
                <li class="disabled" id="3"><a href="#">Finalizar Pesquisa</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box dark">
            <div id="div-1" class="accordion-body collapse in body">
                <div class="message"></div>

                <div class="step1">
                    <form id="formPesquisa" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">Morador</label>

                            <div class="col-lg-5">
                                <input type="hidden" value="<?=$morador['id_person']?>" name="id">
                                <input readonly value="<?=$morador['name_person']?>" type="text"class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Ano de Inicío de Fé</label>

                            <div class="col-lg-2">
                                <input type="number" placeholder="YYYY" id="tempoFe" name="tempoFe"  min="1980" max="2015" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Conhece a IASD</label>

                            <div class="col-lg-1">
                                <div class="checkbox">
                                    <label>
                                        <input class="inline" type="radio" name="knowIASD" id="knowIASD1" value="1" required/> Sim
                                    </label>
                                    <label>
                                        <input class="inline" type="radio" name="knowIASD" id="knowIASD0" value="0" /> Não
                                    </label>
                                </div>
                            </div>

                            <div class="visita" style="display: none;">
                                <label for="pass1" class="control-label col-lg-2">Já visitou alguma?</label>

                                <div class="col-lg-1">
                                    <div class="checkbox">
                                        <label>
                                            <input class="inline" type="radio" name="visitIASD" id="visitIASD1" value="1" /> Sim
                                        </label>
                                        <label>
                                            <input class="inline" type="radio" name="visitIASD" id="visitIASD0" value="0" /> Não
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group voltaria" style="display: none;">
                            <label for="pass1" class="control-label col-lg-4">Voltaria a Visitar?</label>

                            <div class="col-lg-1">
                                <div class="checkbox">
                                    <label>
                                        <input class="inline" type="radio" name="backIASD" id="backIASD1" value="1" /> Sim
                                    </label>
                                    <label>
                                        <input class="inline" type="radio" name="backIASD" id="backIASD0" value="0" /> Não
                                    </label>
                                </div>
                            </div>

                            <label for="pass1" class="control-label col-lg-2">Qual visitou?</label>

                            <div class="col-lg-2">
                                <input type="text" id="iasdLocal" name="iasdLocal" maxlength="15" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Sabe o Significado de "Adventista"?</label>

                            <div class="col-lg-1">
                                <div class="checkbox">
                                    <label>
                                        <input class="inline" type="radio" name="knowSignification" value="1" required /> Sim
                                    </label>
                                    <label>
                                        <input class="inline" type="radio" name="knowSignification" value="0" /> Não
                                    </label>
                                </div>
                            </div>

                            <label for="pass1" class="control-label col-lg-3">Identifica-se com o <br/>significado de Adventista?</label>

                            <div class="col-lg-1">
                                <div class="checkbox">
                                    <label>
                                        <input class="inline" type="radio" name="considerAdventista" value="1" required /> Sim
                                    </label>
                                    <label>
                                        <input class="inline" type="radio" name="considerAdventista" value="0" /> Não
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Duas caracteristas do Adventista (Pessoa):</label>

                            <div class="col-lg-2" style="border: dotted; border-width: 1px">
                                <label>Uma Positiva:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio"  name="opnionPersonGood" value="Honesto" required /> Honesto
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionPersonGood" value="Comprometido" /> Comprometido
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionPersonGood" value="Companheiro" /> Companheiro
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionPersonGood" value="Persistente" /> Persistente
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionPersonGood" value="NDA" /> NDA
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-lg-offset-1" style="border: dotted; border-width: 1px">
                                <label>Uma Negativa:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio"  name="opnionPersonBad" value="Pontualidade" required /> Não é pontual
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionPersonBad" value="Hipocrita" /> Não vive o que diz
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionPersonBad" value="Falso" /> Falso
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionPersonBad" value="Interesseiro" /> Interesseiro
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionPersonBad" value="NDA" /> NDA
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Duas caracteristicas da IASD (Igreja):</label>

                            <div class="col-lg-5" style="border: dotted; border-width: 1px">
                                <label>Uma Positiva:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio"  name="opnionChurchGood" value="Sociabilizacao" required /> Social
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionChurchGood" value="Local Adequado" /> Local adequado para construção de conhecimento e
                                        estruturação
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionChurchGood" value="Organizada" /> Organização na distribuição de dízimos e ofertas
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionChurchGood" value="Seriacao" /> Seriação - Divisão por idades para o estudo da lição
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionChurchGood" value="NDA" /> NDA
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-5 col-lg-offset-4" style="border: dotted; border-width: 1px; margin-top: 10px">
                                <label>Uma Negativa:</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio"   name="opnionChurchBad" value="Fechada" required /> É fechada em si mesma
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionChurchBad" value="Farizaismo" /> Se prende em Leis e não na Salvação
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionChurchBad" value="Dinamica" /> Não é dinâmica em suas atividades
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionChurchBad" value="Acusadora" /> Julgam os outros, mas não ajudam
                                    </label><br/>
                                    <label>
                                        <input type="radio"  name="opnionChurchBad" value="NDA" /> NDA
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Opinião por:</label>

                            <div class="col-lg-5">
                                <div class="checkbox">
                                    <label>
                                        <input class="inline" type="radio" name="opnionFor" value="Observar" required /> Observar
                                    </label>
                                    <label>
                                        <input class="inline" type="radio" name="opnionFor" value="Conhecer" /> Conhecer
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Conhece os:</label>

                            <div class="col-lg-1">
                                <label for="pass1">Desbravadores</label>
                                <div class="checkbox">
                                    <label>
                                        <input class="inline" type="radio" name="knowDesbravadores" value="1" required /> Sim
                                    </label>
                                    <label>
                                        <input class="inline" type="radio" name="knowDesbravadores" value="0" /> Não
                                    </label>
                                </div>
                            </div>
                            <div class=""></div>
                            <div class="col-md-offset-1 col-lg-1">
                                <label for="pass1">Aventureiros</label>
                                <div class="checkbox">
                                    <label>
                                        <input class="inline" type="radio" name="knowAventureiros" value="1" required /> Sim
                                    </label>
                                    <label>
                                        <input class="inline" type="radio" name="knowAventureiros" value="0" /> Não
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-offset-1 col-lg-1">
                                <label for="pass1" style="text-align: center;">ADRA</label>
                                <div class="checkbox">
                                    <label>
                                        <input class="inline" type="radio" name="knowAdra" value="1" required/> Sim
                                    </label>
                                    <label>
                                        <input class="inline" type="radio" name="knowAdra" value="0" /> Não
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Opnião sobre os Projetos</label>

                            <div class="col-lg-2">
                                <select class="form-control" name="opnionProject" required >
                                    <option value="">Selecione</option>
                                    <option>Bom</option>
                                    <option>Pode melhorar</option>
                                    <option>Ruim</option>
                                </select>
                            </div>

                            <label for="pass1" class="control-label col-lg-1">Motivo</label>
                            <div class="col-lg-2">
                                <input type="text" maxlength="255" class="form-control" name="opnionProjectReason" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Conhece a TV Novo Tempo?</label>

                            <div class="col-lg-1">
                                <div class="checkbox">
                                    <label>
                                        <input class="inline" type="radio" name="tv" id="tv1" value="1" /> Sim
                                    </label>
                                    <label>
                                        <input class="inline" type="radio" name="tv" id="tv0" value="0" /> Não
                                    </label>
                                </div>
                            </div>

                            <div class="tv" style="display: none;">
                                <label for="pass1" class="control-label col-lg-2">Programa Preferido?</label>

                                <div class="col-lg-2">
                                    <input type="text" id="program" name="program" maxlength="100" class="form-control" />
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

                <div class="step2" style="display: none;">
                    <form class="form-horizontal" id="formConfirm">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">Morador</label>

                            <div class="col-lg-5">
                                <input type="hidden" value="<?=$morador['id_person']?>" name="id">
                                <input readonly value="<?=$morador['name_person']?>" type="text"class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Ano de Inicío de Fé</label>

                            <div class="col-lg-2 tempoFe"></div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Conhece a IASD</label>

                            <div class="col-lg-1 knowIASD"></div>

                            <div class="visita" style="display: none;">
                                <label for="pass1" class="control-label col-lg-2">Já visitou alguma?</label>

                                <div class="col-lg-1 visitIASD"></div>
                            </div>
                        </div>

                        <div class="form-group voltaria" style="display: none;">
                            <label for="pass1" class="control-label col-lg-4">Voltaria a Visitar?</label>

                            <div class="col-lg-1 backIASD"></div>

                            <label for="pass1" class="control-label col-lg-2">Qual visitou?</label>

                            <div class="col-lg-2 iasdLocal"></div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Sabe o Significado de "Adventista"?</label>

                            <div class="col-lg-1 knowSignification"></div>

                            <label for="pass1" class="control-label col-lg-3">Identifica-se com o <br/>significado de Adventista?</label>

                            <div class="col-lg-1 considerAdventista"></div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Duas caracteristas do Adventista (Pessoa):</label>

                            <div class="col-lg-2" style="border: dotted; border-width: 1px">
                                <label>Uma Positiva:</label>
                                <div class="opnionPersonGood"></div>
                            </div>
                            <div class="col-lg-2 col-lg-offset-1" style="border: dotted; border-width: 1px">
                                <label>Uma Negativa:</label>
                                <div class="opnionPersonBad"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Duas caracteristicas da IASD (Igreja):</label>

                            <div class="col-lg-5" style="border: dotted; border-width: 1px">
                                <label>Uma Positiva:</label>
                                <div class="opnionChurchGood"></div>
                            </div>
                            <div class="col-lg-5 col-lg-offset-4" style="border: dotted; border-width: 1px; margin-top: 10px">
                                <label>Uma Negativa:</label>
                                <div class="opnionChurchBad"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Opinião por:</label>

                            <div class="col-lg-5 opnionFor"></div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Conhece os:</label>

                            <div class="col-lg-1">
                                <label for="pass1">Desbravadores</label>
                                <div class="knowDesbravadores"></div>
                            </div>
                            <div class=""></div>
                            <div class="col-md-offset-1 col-lg-1">
                                <label for="pass1">Aventureiros</label>
                                <div class="knowAventureiros">
                                </div>
                            </div>

                            <div class="col-md-offset-1 col-lg-1">
                                <label for="pass1" style="text-align: center;">ADRA</label>
                                <div class="knowAdra">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Opnião sobre os Projetos</label>

                            <div class="col-lg-2 opnionProject">
                            </div>

                            <label for="pass1" class="control-label col-lg-1">Motivo</label>
                            <div class="col-lg-2 opnionProjectReason">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Conhece a TV Novo Tempo?</label>

                            <div class="col-lg-1 knowtv">
                            </div>

                            <div class="col-lg-4 tv" style="display: none;">
                                <label for="pass1" class="control-label col-lg-1">Programa Preferido?</label>

                                <div class="col-lg-offset-2 col-lg-2 program"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-4 col-lg-offset-4">
                                <button type="button" data-back="1" class="btn btn-primary back">Voltar</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="confirm" class="btn btn-primary">Continue</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="step3 col-md-offset-3 col-md-6" style="text-align: center; display: none;">
                    <h2 class="alert alert-success">Pesquisa realizada com sucesso!</h2>
                    <a href="consulta.php?p=morador"><button class="btn btn-primary">Voltar à consulta!</button></a>
                </div>

            </div>
        </div>
    </div>

</div>

