<?php
if($_SESSION['login']['role'] != 3){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{
include_once "class/Religion.php";
include_once "class/Person.php";
?>
        <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Controle de Religião</h1>
                </div>
            </div>
            <a href="forms.php?p=cadReligiao"><button class="btn btn-success">
               Nova Religião
            </button></a>
            <hr />
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Consultar Religiões
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(Religion::getReligions() != '') {
                                        foreach (Religion::getReligions() as $rel) {
                                            echo '<tr>';
                                            echo '<td>' . $rel->getId() . '</td>';
                                            echo '<td>'
                                                . '<a class="modalReligion" data-id="'.$rel->getId().'" >'
                                                . $rel->getName()
                                                . '</a>'
                                                . '</td>';

                                            if($rel->getId() != 1){
                                                echo '<td>'
                                                    . '<a href="forms.php?p=altReligiao&cod=' . $rel->getId() . '">' . '<i class="icon icon-pencil"></i> Editar' . '</a>';
                                                    if( ! Database::ReadAll('person', '*', "WHERE ID_RELIGION = ".$rel->getId() )) {
                                                        echo ' | '
                                                            . '<a data-table="religion" data-id="' . $rel->getId() . '" class="del">' . '<i class="icon icon-remove"></i> Exluir' . '</a>';
                                                    }
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