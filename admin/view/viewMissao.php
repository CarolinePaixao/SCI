<?php

include_once "class/Mission.php";
?>


        <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Controle de Missões</h1>
                </div>
            </div>

            <?php if($_SESSION['login']['role'] > 1){ ?>
                <a href="forms.php?p=cadMissao"><button class="btn btn-success">
                        Nova Missão
                    </button></a>
                <hr />
            <?php }?>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Consultar Missão
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Equipe</th>
                                        <th>Duração</th>
                                        <th>Local</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(Mission::getMissions() != '') {
                                        foreach (Mission::getMissions() as $miss) {
                                            echo '<tr>';
                                            echo '<td>' . $miss->getId() . '</td>';
                                            echo '<td>'
                                                . '<a class="modalMission" data-id="'.$miss->getId().'" >'
                                                . $miss->getName()
                                                . '</a>' . '</td>';
                                            echo '<td>' . '<a class="modalTeam" data-id="'.$miss->getTeam()->getId().'" >'
                                                . $miss->getTeam()->getName()
                                                . '</a>'
                                                . '</td>';
                                            echo '<td>' . $miss->getDateBegin() . ' - ' . $miss->getDateEnd() . '</td>';

                                            if($miss->getAddress()->getId())
                                                echo '<td>' . $miss->getAddress()->getStreet().', ' . $miss->getAddress()->getNumber() .', ' . $miss->getAddress()->getDistrict() .', ' . $miss->getAddress()->getCity() . '/'. $miss->getAddress()->getState() . '</td>';
                                            if($miss->getChurch()->getId())
                                                echo '<td>'. '<a class="modalChurch" data-id="'.$miss->getChurch()->getId().'" >'
                                                    . 'Igreja: ' . $miss->getChurch()->getName()
                                                    . '</a>'
                                                    . '</td>';

                                            echo '<td>' . $miss->getStatus(). '</td>';


                                            if( $_SESSION['login']['role'] == 3
                                                ||
                                                ($_SESSION['login']['role'] == 2 && $_SESSION['login']['id_person'] == $miss->getTeam()->getLeader()->getId()) ){

                                                if($miss->getStatus() != 'Concluida')
                                                    echo '<td>'
                                                        . '<a href="forms.php?p=altMissao&cod=' . $miss->getId() . '">' . '<i class="icon icon-pencil"></i> Editar' . '</a>'
                                                        . '</td>';
                                                else
                                                    echo '<td></td>';

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

            </div>

