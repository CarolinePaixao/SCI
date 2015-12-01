<?php
if($_SESSION['login']['role'] < 2){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{
include_once 'class/Calebe.php';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastrar Equipe</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-6 col-md-offset-3">
            <ul class="nav nav-wizard">
                <li class="active" id="1"><a href="#">Dados da Equipe</a></li>
                <li class="disabled" id="2"><a href="#">Finalizar</a></li>
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
                    <form id="formEquipe" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">Nome</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_TEAM" name="NAME_TEAM" maxlength="80" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass1" class="control-label col-lg-4">Lider da Equipe</label>

                            <div class="col-lg-5">
                                <select name="ID_LEADER" class="form-control" required>
                                    <option value="">Selecione o Lider</option>
                                    <?php
                                    if(Calebe::getLeaders() != '') {
                                        foreach (Calebe::getLeaders() as $cal) {
                                            echo '<option value="' . $cal->getId() . '">'.$cal->getName().'</option>';
                                        }
                                    }else
                                        echo '<script>
                                                        alert("Para cadastrar uma Equipe é necessário ter ao menos um Líder!");
                                                        window.location = "consulta.php?p=lider";
                                                  </script>';
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Integrantes Equipe</label>
                            <div class="col-lg-5">
                                <select id="CALEBES_MISSAO" name="CALEBES_MISSAO[]" multiple="multiple" class="form-control chzn-select" required data-placeholder="Escolha os Calebes para a Equipe">
                                    <?php
                                    if(Calebe::getCalebes() != '') {
                                        foreach (Calebe::getCalebes() as $cal) {
                                            echo '<option value="' . $cal->getId() . '">'.$cal->getName().'</option>';
                                        }
                                    }else
                                        echo '<script>
                                                        alert("Para cadastrar uma Equipe é necessário ter ao menos um Calebe!");
                                                        window.location = "consulta.php?p=calebe";
                                                  </script>';
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Status</label>
                            <div class="col-lg-5">
                                <select id="STATUS" name="STATUS" class="form-control">
                                    <option selected>Disponível</option>
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

                <div class="step2 col-md-offset-3 col-md-6" style="text-align: center; display: none;">
                    <h2 class="alert alert-success">Equipe cadastrada com sucesso! </h2>
                    <a href="consulta.php?p=equipe"><button class="btn btn-primary">Voltar à consulta!</button></a>
                </div>

            </div>
        </div>
    </div>

</div>

<?php } ?>