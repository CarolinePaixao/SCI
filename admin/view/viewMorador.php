<?php

include_once "class/Resident.php";
include_once "class/Research.php";
?>
        <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Controle de Moradores</h1>
                </div>
            </div>
            <a href="forms.php?p=cadMorador"><button class="btn btn-success">
               Novo Morador
            </button></a>
            <hr />
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Consultar Moradores
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
                                    if(Resident::getResidents() != '') {
                                        foreach (Resident::getResidents() as $res) {
                                            echo '<tr>';
                                            echo '<td>' . $res->getId() . '</td>';
                                            echo '<td>'
                                                . '<a class="modalResident" data-id="'.$res->getId().'" >'
                                                . $res->getName()
                                                . '</a>'
                                                . '</td>';
                                            echo '<td>' . $res->getEmail() . '</td>';
                                            echo '<td>' . $res->getReligion()->getName() . '</td>';
                                            echo '<td>' . $res->getAge() . '</td>';

                                            echo '<td>'
                                                . '<a href="forms.php?p=altMorador&cod='.$res->getId().'"><i class="icon-pencil"></i>Editar</a>'
                                                . '  |  ';

                                            if(Research::existResearch($res->getId())){
                                                echo '<i class="icon icon-check" style="color: green"></i> Pesquisa Realizada' ;
                                            }else{
                                                echo '<a href="forms.php?p=cadPesquisa&cod='.$res->getId().'"><i class="icon-edit" style="color: red"></i>Realizar Pesquisa</a>';
                                            }
                                            echo '</td>';

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