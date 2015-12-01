<?php
include_once "class/Team.php";
?>

        <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Controle de Equipes</h1>
                </div>
            </div>
            <?php if($_SESSION['login']['role'] > 1){ ?>
            <a href="forms.php?p=cadEquipe"><button class="btn btn-success">
                    Nova Equipe
                </button></a>
            <hr />
            <?php }?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Consultar Equipes
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Lider</th>
                                        <th>Nº Integrantes</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($_SESSION['login']['role'] > 1) {
                                        if (Team::getTeams() != '') {
                                            foreach (Team::getTeams() as $team) {
                                                echo '<tr>';
                                                echo '<td>' . $team->getId() . '</td>';
                                                echo '<td>' . '<a class="modalTeam" data-id="' . $team->getId() . '" >'
                                                    . $team->getName()
                                                    . '</a>'
                                                    . '</td>';

                                                echo '<td>'
                                                    . '<a class="modalCalebe" data-id="' . $team->getLeader()->getId() . '" >'
                                                    . $team->getLeader()->getName()
                                                    . '</a>'
                                                    . '</td>';

                                                echo '<td>' . count($team->getMembersTeam($team->getId())) . '</td>';
                                                echo '<td>' . $team->getStatus() . '</td>';

                                                if ($_SESSION['login']['role'] == 3
                                                    ||
                                                    ($_SESSION['login']['role'] == 2 && $_SESSION['login']['id_person'] == $team->getLeader()->getId())
                                                ) {

                                                    if ($team->getStatus() != 'Inativa')
                                                        echo '<td>'
                                                            . '<a href="forms.php?p=altEquipe&cod=' . $team->getId() . '">' . '<i class="icon icon-pencil"></i> Editar' . '</a>'
                                                            . '</td>';
                                                    else
                                                        echo '<td></td>';

                                                } else
                                                    echo '<td></td>';

                                                echo '</tr>';
                                            }
                                        }
                                    }else{
                                        if (Team::getTeams() != '') {
                                            foreach (Team::getTeams() as $team) {
                                                $calebe = false;
                                                foreach($team->getMembers() as $cal){
                                                    if($cal->getId() == $_SESSION['login']['id_person'])
                                                        $calebe=true;
                                                }
                                                if($calebe) {
                                                    echo '<tr>';
                                                    echo '<td>' . $team->getId() . '</td>';
                                                    echo '<td>' . '<a class="modalTeam" data-id="' . $team->getId() . '" >'
                                                        . $team->getName()
                                                        . '</a>'
                                                        . '</td>';

                                                    echo '<td>'
                                                        . '<a class="modalCalebe" data-id="' . $team->getLeader()->getId() . '" >'
                                                        . $team->getLeader()->getName()
                                                        . '</a>'
                                                        . '</td>';

                                                    echo '<td>' . count($team->getMembersTeam($team->getId())) . '</td>';
                                                    echo '<td>' . $team->getStatus() . '</td>';

                                                    echo '<td></td>';

                                                    echo '</tr>';
                                                }
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