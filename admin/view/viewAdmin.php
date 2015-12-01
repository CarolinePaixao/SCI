<?php
if($_SESSION['login']['role'] != 3){
    echo '<h2 style="text-align: center; vertical-align: middle">Página Restrita</h2>';
}else{
include_once "class/Religion.php";
include_once "class/Person.php"; ?>
        <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Controle de Administradores</h1>
                </div>
            </div>
            <a href="forms.php?p=cadAdmin"><button class="btn btn-success">
               Novo Administrador
            </button></a>
            <hr />
            <div class="row">
                <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Consultar Administradores
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
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(Person::getPersons()) {
                                    foreach (Person::getPersons() as $per) {
                                        if( $per->getLogin() && $per->getLogin()->getRole() == 3) {

                                            echo '<tr>';
                                            echo '<td>' . $per->getId() . '</td>';
                                            echo '<td>'
                                                . '<a class="modalAdmin" data-id="'.$per->getId().'" >'
                                                . $per->getName()
                                                . '</a>'.
                                                '</td>';
                                            echo '<td>' . $per->getEmail() . '</td>';
                                            echo '<td>' . $per->getReligion()->getName() . '</td>';
                                            echo '<td>' . $per->getAge() . '</td>';

                                            echo '<td>';
                                                if($per->getId() == $_SESSION['login']['id_person'])
                                                    echo '<a href="editPerfil.php">' . '<i class="icon icon-pencil"></i> Editar' . '</a>';

                                                if($per->getId() != 1)
                                                    echo '   '
                                                    . '<a  class="removeAdmin" data-id="' . $per->getId() . '" data-name="' . $per->getName() . '" title="Remover Admin">' . '<i class="icon icon-remove"></i> Remover Admin' . '</a>';

                                            echo '</td>';

                                            echo '</tr>';
                                        }
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