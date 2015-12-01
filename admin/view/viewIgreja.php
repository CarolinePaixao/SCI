<?php
if($_SESSION['login']['role'] < 2){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{
include_once "class/HistoryChurch.php";
?>

        <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Controle de Igrejas</h1>
                </div>
            </div>
            <a href="forms.php?p=cadIgreja"><button class="btn btn-success">
                    Nova Igreja
                </button></a>
            <hr />

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Consultar Igrejas
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Pastor</th>
                                        <th>Endereço</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(Church::getChurches() != '') {
                                        foreach (Church::getChurches() as $chur) {
                                            echo '<tr>';
                                            echo '<td>' . $chur->getId() . '</td>';
                                            echo '<td>'. '<a class="modalChurch" data-id="'.$chur->getId().'" >'
                                                . $chur->getName()
                                                . '</a>'
                                                . '</td>';
                                            echo '<td>' . $chur->getPastor() . '</td>';
                                            echo '<td>' . $chur->getAddress()->getStreet().', ' . $chur->getAddress()->getNumber() .' ' . $chur->getAddress()->getComplement() .', ' . $chur->getAddress()->getDistrict() .', ' . $chur->getAddress()->getCity() . '/'. $chur->getAddress()->getState() . '</td>';
                                            echo '<td>' . $chur->getStatus() .'</td>';

                                            if($chur->getStatus() != 'Banido'){
                                                echo '<td>'
                                                    . '<a href="forms.php?p=altIgreja&cod=' . $chur->getId() . '">' . '<i class="icon icon-pencil"></i> Editar' . '</a>'
                                                    . '</td>';
                                            }else
                                                echo '<td></td>';

                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php if(HistoryChurch::getHistorys()){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Histórico de Pastores nas Igrejas
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Igreja</th>
                                        <th>Pastor</th>
                                        <th>Data de Entrada</th>
                                        <th>Data de Saida</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach (HistoryChurch::getHistorys() as $chur) {
                                            echo '<tr>';
                                            echo '<td>' . $chur->getId() . '</td>';
                                            echo '<td>'. '<a class="modalChurch" data-id="'.$chur->getChurch()->getId().'" >'
                                                . $chur->getChurch()->getName()
                                                .'</a>'
                                                . '</td>';
                                            echo '<td>' . $chur->getNamePastor() . '</td>';
                                            echo '<td>' . $chur->getDateInicial() .'</td>';
                                            echo '<td>' . $chur->getDateFinal() .'</td>';

                                            echo '</tr>';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            </div>
<?php } ?>