<?php
if($_SESSION['login']['role'] != 3){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{  ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cadastrar Religião</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-6 col-md-offset-5">
            <ul class="nav nav-wizard">
                <li class="active" id="1"><a href="#">Religião</a></li>
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
                <div class="step1">
                    <form id="formReligiao" class="form-horizontal">
                        <div class="form-group">
                            <label for="nome" class="control-label col-lg-4">Religião</label>

                            <div class="col-lg-5">
                                <input type="text" id="NAME_RELIGION" name="NAME_RELIGION" maxlength="80" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-8">
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="step2 col-md-offset-3 col-md-6" style="text-align: center; display: none;">
                    <h3 class="alert alert-success">Religião cadastrada com sucesso!</h3>
                    <a href="consulta.php?p=aux"><button class="btn btn-primary">Voltar à consulta!</button></a>
                </div>

            </div>
        </div>
    </div>

</div>
<?php } ?>
