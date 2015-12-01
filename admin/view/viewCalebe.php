<?php
if($_SESSION['login']['role'] != 3){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{

include_once "class/Calebe.php";
?>

        <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Controle de Calebes</h1>
                </div>
            </div>
            <a href="forms.php?p=cadCalebe"><button class="btn btn-success text-center">
               Novo Calebe
            </button></a>
            <hr />

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Consultar Calebes
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Religião</th>
                                        <th>Idade</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(Calebe::getCalebes() != '') {
                                        foreach (Calebe::getCalebes() as $cal) {
                                            echo '<tr>';
                                            echo '<td>' . $cal->getId() . '</td>';
                                            echo '<td>'
                                                . '<a class="modalCalebe" data-id="'.$cal->getId().'" >'
                                                . $cal->getName()
                                                . '</a>'
                                                . '</td>';
                                            echo '<td>' . $cal->getEmail() . '</td>';
                                            echo '<td>' . $cal->getReligion()->getName() . '</td>';
                                            echo '<td>' . $cal->getAge() . '</td>';
                                            echo '<td>' . $cal->getStatus() . '</td>';

                                            if($cal->getStatus() != 'Banido'){
                                                echo '<td>'
                                                    . '<a href="forms.php?p=altCalebe&cod=' . $cal->getId() . '">' . '<i class="icon icon-pencil"></i> Editar' . '</a>';

                                                    if($cal->getBaptism() == 1 && $cal->getReligion()->getName() == 'Adventista do Sétimo Dia') {
                                                        echo '  |  '
                                                        . '<a class="makeLeader" data-id="' . $cal->getId() . '" data-name="' . $cal->getName() . '" title="Tornar Líder">' . '<i class="icon icon-star"></i> Lider' . '</a>'
                                                        . '</td>';
                                                    }else
                                                        echo '</td>';

                                                echo '</tr>';
                                            }else
                                                echo '<td></td>';
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

            </div>
<?php } ?>