<?php
include_once '../class/Calebe.php';
include_once '../class/Resident.php';
$acao = $_POST['acao'];

switch($acao) {

    case 'religions':
        $type = $_POST['type'];
        $data = [];
        $reliCount[] = 0;
        $religions = Database::ReadAll('religion', 'id_religion, name_religion');

        if ($type == 'person')
            $persons = Person::getPersons();
        else if ($type == 'calebe')
            $persons = Calebe::getCalebes();
        else
            $persons = Resident::getResidents();

        for ($i = 0; $i < count($religions); $i++) {
            $reliCount[$i] = 0;
            for ($j = 0; $j < count($persons); $j++) {
                if ($religions[$i]['id_religion'] == $persons[$j]->getReligion()->getId())
                    $reliCount[$i]++;
            }
        }

        for ($i = 0; $i < count($religions); $i++) {
            $data[$i] = array(
                'label' => $religions[$i]['name_religion'],
                'data' => $reliCount[$i]
            );
        }

        echo json_encode($data);
        break;

    case 'detalReligions':
        $type = $_POST['type'];
        $data = [];
        $reliCount[] = 0;
        $religions = Database::ReadAll('religion', 'id_religion, name_religion');

        if ($type == 'person')
            $persons = Person::getPersons();
        else if ($type == 'calebe')
            $persons = Calebe::getCalebes();
        else
            $persons = Resident::getResidents();

        for ($i = 0; $i < count($religions); $i++) {
            $reliCount[$i] = 0;
            for ($j = 0; $j < count($persons); $j++) {
                if ($religions[$i]['id_religion'] == $persons[$j]->getReligion()->getId())
                    $reliCount[$i]++;
            }
        }

        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Religiões
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Pessoas por Religião</a>
                            </li>
                            <li><a href="#profile" data-toggle="tab">Pesquisar por Pessoas</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>Religião</th>
                                            <th>Nº Pessoas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($religions); $i++) {
                                            echo '<tr>' .
                                                '<td>' . $religions[$i]['name_religion'] . '</td>' .
                                                '<td>' . $reliCount[$i] . '</td>' .
                                                '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <h4>
                                    Consultar Religiões por <?php if ($type == 'person') echo 'Todos';
                                    if ($type == 'calebe') echo 'Calebes';
                                    if ($type == 'resident') echo 'Moradores' ?>
                                </h4>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Religião</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($persons as $person) {
                                            echo '<tr>'
                                                . '<td>' . $person->getId() . '</td>'
                                                . '<td>' . $person->getName() . '</td>'
                                                . '<td>' . $person->getReligion()->getName() . '</td>'
                                                . '</tr>';
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
        </div>
        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable();
            })
        </script>

        <?php
        break;

    case 'personSystem':
        $data = [];
        $type = array('Administrador', 'Líder Calebe', 'Calebe', 'Morador');
        $typeCount = array(0, 0, 0, 0);
        $persons = Person::getPersons();

        for ($i = 0; $i < count($persons); $i++) {
            if (!$persons[$i]->getLogin())
                $typeCount[3]++;
            else if ($persons[$i]->getLogin()->getRole() == 3)
                $typeCount[0]++;
            else if ($persons[$i]->getLogin()->getRole() == 2)
                $typeCount[1]++;
            else if ($persons[$i]->getLogin()->getRole() == 1)
                $typeCount[2]++;
        }

        for ($i = 0; $i < count($type); $i++) {
            $data[$i] = array(
                'label' => $type[$i],
                'data' => $typeCount[$i]
            );
        }
        echo json_encode($data);

        break;

    case 'detalPersons':
        $type = array('Administrador', 'Líder Calebe', 'Calebe', 'Morador');
        $typeCount = array(0, 0, 0, 0);
        $persons = Person::getPersons();

        for ($i = 0; $i < count($persons); $i++) {
            if (!$persons[$i]->getLogin())
                $typeCount[3]++;
            else if ($persons[$i]->getLogin()->getRole() == 3)
                $typeCount[0]++;
            else if ($persons[$i]->getLogin()->getRole() == 2)
                $typeCount[1]++;
            else if ($persons[$i]->getLogin()->getRole() == 1)
                $typeCount[2]++;
        }

        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Pessoas no sistema
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Pessoas por Nível</a>
                            </li>
                            <li><a href="#profile" data-toggle="tab">Pesquisar por Pessoas</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Nível</th>
                                            <th>Nº Pessoas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($type); $i++) {
                                            echo '<tr>' .
                                                '<td>' . $type[$i] . '</td>' .
                                                '<td>' . $typeCount[$i] . '</td>' .
                                                '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Nível</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($persons as $person) {
                                            echo '<tr>'
                                                . '<td>' . $person->getId() . '</td>'
                                                . '<td>' . $person->getName() . '</td>'
                                                . '<td>';

                                            if (!$person->getLogin())
                                                echo $type[3];
                                            else if ($person->getLogin()->getRole() == 3)
                                                echo $type[0];
                                            else if ($person->getLogin()->getRole() == 2)
                                                echo $type[1];
                                            else if ($person->getLogin()->getRole() == 1)
                                                echo $type[2];

                                            echo '</td>'
                                                . '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable();
            })
        </script>

        <?php
        break;

    case 'projectsKnow':
        $adra = Database::ReadAll('research', 'KNOW_ADRA', 'WHERE KNOW_ADRA = 1');
        $aventureiros = Database::ReadAll('research', 'KNOW_AVENTUREIRO', 'WHERE KNOW_AVENTUREIRO = 1');
        $desbravadores = Database::ReadAll('research', 'KNOW_DESBRAVADOR', 'WHERE KNOW_DESBRAVADOR = 1');

        $adra = ($adra != false) ? count($adra) : 0;
        $aventureiros = ($aventureiros != false) ? count($aventureiros) : 0;
        $desbravadores = ($desbravadores != false) ? count($desbravadores) : 0;

        $data = array(
            array(
                'label' => 'ADRA',
                'data' => $adra),
            array(
                'label' => 'Aventureiros',
                'data' => $aventureiros
            ),
            array(
                'label' => 'Desbravadores',
                'data' => $desbravadores
            )
        );


        echo json_encode($data);

        break;

    case 'detalProjectsKnow':
        $type = array('ADRA', 'Aventureiros', 'Desbravadores');
        $typeCount = array(0, 0, 0);
        $persons = Resident::getResidents();
        if($persons) {
            foreach ($persons as $person) {
                if ($person->getResearch()) {
                    if ($person->getResearch()->getKnowAdra() == 1)
                        $typeCount[0]++;

                    if ($person->getResearch()->getKnowAventureiros() == 1)
                        $typeCount[1]++;

                    if ($person->getResearch()->getKnowDesbravadores() == 1)
                        $typeCount[2]++;
                }
            }
        }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Conhecimento dos Projetos
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Pessoas por Projeto</a>
                            </li>
                            <li><a href="#profile" data-toggle="tab">Pesqusisar por Pessoas</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="table-responsive">

                                    <form id="searchProjects">
                                        <div class="form-group">
                                            <label>Pesquisar por:</label>

                                            <button type="submit" title="Pesquisar"
                                                    class="btn btn-primary btn-circle col-lg-offset-8"><i
                                                    class="icon icon-search"></i></button>
                                            <br/>

                                            <div class="checkbox-inline anim-checkbox">
                                                <input type="checkbox" id="ch1" name="ADRA" class="primary" />
                                                <label for="ch1">ADRA</label>
                                            </div>
                                            <div class="checkbox-inline anim-checkbox">
                                                <input type="checkbox" id="ch2" name="Aventureiros" class="primary"
                                                       />
                                                <label for="ch2">Aventureiros</label>
                                            </div>
                                            <div class="checkbox-inline anim-checkbox">
                                                <input type="checkbox" id="ch3" name="Desbravadores" class="primary"
                                                       />
                                                <label for="ch3">Desbravadores</label>
                                            </div>

                                        </div>


                                    </form>

                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Projetos que Conhecem</th>
                                            <th>Nº Pessoas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><label id="projects"></label></td>
                                                <td><label id="number"></label></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-striped table-bordered table-hover">
                                        <label>Geral</label>
                                        <thead>
                                        <tr>
                                            <th>Projetos</th>
                                            <th>Nº Pessoas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for($i=0;$i<count($type);$i++){
                                            echo '<tr>'
                                                .'<td>'.$type[$i].'</td>'
                                                .'<td>'.$typeCount[$i].'</td>'
                                                .'</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>ADRA</th>
                                            <th>Aventureiros</th>
                                            <th>Desbravadores</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($persons) {
                                            foreach ($persons as $person) {
                                                if ($person->getResearch()) {

                                                    echo '<tr>'
                                                        . '<td>' . $person->getId() . '</td>'
                                                        . '<td>' . $person->getName() . '</td>';
                                                    if ($person->getResearch()->getKnowAdra() == 1)
                                                        echo '<td style="text-align: center">' . '<i class="icon icon-ok"></i>' . '</td>';
                                                    else
                                                        echo '<td></td>';

                                                    if ($person->getResearch()->getKnowAventureiros() == 1)
                                                        echo '<td style="text-align: center">' . '<i class="icon icon-ok"></i>' . '</td>';
                                                    else
                                                        echo '<td></td>';

                                                    if ($person->getResearch()->getKnowDesbravadores() == 1)
                                                        echo '<td style="text-align: center">' . '<i class="icon icon-ok"></i>' . '</td>';
                                                    else
                                                        echo '<td></td>';

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
        </div>

        <script>
            $(document).ready(function () {
                $('.dataTables-example').dataTable();
            })
        </script>

        <?php
        break;

    case 'detalProjectsEspecific':
        $adra = (isset($_POST['ADRA'])) ? 'ADRA' : false;
        $aven = (isset($_POST['Aventureiros'])) ? 'Aventureiros' : false;
        $desb = (isset($_POST['Desbravadores'])) ? 'Desbravadores' : false;
        $types = array($adra, $aven, $desb);

        if ($adra && $aven && $desb) {
            $title = $adra . ', ' . $aven . ' e ' . $desb;
            $number = Database::ReadAll('research', '*', "WHERE know_adra = 1 AND know_aventureiro = 1 AND know_desbravador = 1");
        }
        else if($adra && $aven && !$desb){
            $title = $adra . ' e ' . $aven;
            $number = Database::ReadAll('research', '*', "WHERE know_adra = 1 AND know_aventureiro = 1 AND know_desbravador = 0");
        }
        else if($adra && $desb && !$aven){
            $title = $adra . ' e ' . $desb;
            $number = Database::ReadAll('research', '*', "WHERE know_adra = 1 AND know_desbravador = 1 AND know_aventureiro = 0");
        }
        else if($aven && $desb && !$adra){
            $title = $aven . ' e ' . $desb;
            $number = Database::ReadAll('research', '*', "WHERE know_aventureiro = 1 AND know_desbravador = 1 AND know_adra = 0");
        }
        else if($adra && !$aven && !$desb){
            $title = $adra;
            $number = Database::ReadAll('research', '*', "WHERE know_adra = 1 AND know_aventureiro = 0 AND know_desbravador = 0");
        }
        else if($desb && !$adra && !$aven){
            $title = $desb;
            $number = Database::ReadAll('research', '*', "WHERE know_desbravador = 1 AND know_adra = 0 AND know_aventureiro = 0");
        }
        else if($aven && !$desb && !$adra){
            $title = $aven;
            $number = Database::ReadAll('research', '*', "WHERE know_aventureiro = 1 AND know_desbravador = 0 AND know_adra = 0");
        }else{
            $title = 'Não conhece nenhum projeto';
            $number = Database::ReadAll('research', '*', "WHERE know_aventureiro = 0 AND know_desbravador = 0 AND know_adra = 0");
        }
        $number = ($number) ? count($number) : 0;

        $data = array('title'=> $title, 'number' => $number );
        #var_dump($data);
        echo json_encode($data);
        break;

    case 'projectsOpnion':
        $type = array('Bom', 'Pode melhorar', 'Ruim');
        $opnions = Database::ReadAll('research', 'OPNION_PROJECTS');

        for($i=0; $i < count($type); $i++){
            $typeCount[$i] = 0;
            foreach($opnions as $opnion){
                $opnion = explode(';', $opnion['OPNION_PROJECTS']);
                if($opnion[0] == $type[$i])
                    $typeCount[$i]++;
            }
        }

        for($i=0; $i < count($type); $i++) {
            $data[] = array(
                'label' => $type[$i],
                'data' => $typeCount[$i]
            );
        }

        echo json_encode($data);

        break;

    case 'detalProjectsOpnion':
        $type = array('Bom', 'Pode melhorar', 'Ruim');
        $persons = Resident::getResidents();

        for ($i = 0; $i < count($type); $i++) {
            $typeCount[$i] = 0;
           if($persons) {
               foreach ($persons as $opnion) {
                   if ($opnion->getResearch()) {
                       $opnion = explode(';', $opnion->getResearch()->getOpnionProjects());
                       if ($opnion[0] == $type[$i])
                           $typeCount[$i]++;
                   }
               }
           }
        }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Opinião sobre os Projetos
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Pessoas por Projeto</a>
                            </li>
                            <li><a href="#profile" data-toggle="tab">Pesquisar por Pessoas</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Opinião</th>
                                            <th>Nº Pessoas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($type); $i++) {
                                            echo '<tr>'.
                                                '<td>'.$type[$i].'</td>'.
                                                '<td>'.$typeCount[$i].'</td>'.
                                                '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Opinião</th>
                                            <th>Observação</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($persons) {
                                            foreach ($persons as $person) {
                                                if ($person->getResearch()) {
                                                    $opnion = explode(';', $person->getResearch()->getOpnionProjects());

                                                    echo '<tr>'
                                                        . '<td>' . $person->getId() . '</td>'
                                                        . '<td>' . $person->getName() . '</td>'
                                                        . '<td>' . $opnion[0] . '</td>'
                                                        . '<td>' . $opnion[1] . '</td>'
                                                        . '</tr>';

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
        </div>

        <script>
            $(document).ready(function () {
                $('#dataTables').dataTable();
            })
        </script>

        <?php
        break;

    case 'opnionIASD':
        $get = $_POST['type'];
        $typeGood = array('Sociabilizacao', 'Local Adequado', 'Organizada', 'Seriacao', 'NDA');
        $typeBad = array('Farizaismo', 'Dinamica', 'Fechada', 'Acusadora', 'NDA');
        $typeAll = array('Sociabilizacao', 'Local Adequado', 'Organizada', 'Seriacao', 'Farizaismo', 'Dinamica', 'Fechada', 'Acusadora', 'NDA');
        $opnions = Database::ReadAll('research', 'OPNION_IASD');

        if($get == 'good') $type = $typeGood;
        if($get == 'bad') $type = $typeBad;
        if($get == 'all') $type = $typeAll;
        for($i=0; $i < count($type); $i++){
            $typeCount[$i] = 0;
            foreach($opnions as $opnion){
                $opnion = explode(';', $opnion['OPNION_IASD']);
                if($opnion[0] == $type[$i])
                    $typeCount[$i]++;
                else if($opnion[1] == $type[$i])
                    $typeCount[$i]++;
            }
        }

        for($i=0; $i < count($type); $i++) {
            $data[] = array(
                'y' => $type[$i],
                'a' => $typeCount[$i]
            );
        }

        echo json_encode($data);

        break;

    case 'detalOpnionIASD':
        $get = $_POST['type'];
        $typeGood = array('Sociabilizacao', 'Local Adequado', 'Organizada', 'Seriacao', 'NDA');
        $typeBad = array('Farizaismo', 'Dinamica', 'Fechada', 'Acusadora', 'NDA');
        $typeAll = array('Sociabilizacao', 'Local Adequado', 'Organizada', 'Seriacao', 'Farizaismo', 'Dinamica', 'Fechada', 'Acusadora', 'NDA');
        $persons = Resident::getResidents();

        if($get == 'good') $type = $typeGood;
        if($get == 'bad') $type = $typeBad;
        if($get == 'all') $type = $typeAll;

        for($i=0; $i < count($type); $i++){
            $typeCount[$i] = 0;
            if($persons) {
                foreach ($persons as $opnion) {
                    if ($opnion->getResearch()) {
                        $opnion = explode(';', $opnion->getResearch()->getOpnionIasd());
                        if ($opnion[0] == $type[$i])
                            $typeCount[$i]++;
                        else if ($opnion[1] == $type[$i])
                            $typeCount[$i]++;
                    }
                }
            }
        }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Opnião sobre a Igreja Adventista do Sétimo Dia
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Pessoas por Opinião</a>
                            </li>
                            <li><a href="#profile" data-toggle="tab">Pesquisar por Pessoas</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Opinião</th>
                                            <th>Nº Pessoas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($type); $i++) {
                                            echo '<tr>'.
                                                '<td>'.$type[$i].'</td>'.
                                                '<td>'.$typeCount[$i].'</td>'.
                                                '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Opinião</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($persons) {
                                            foreach ($persons as $person) {
                                                if ($person->getResearch()) {
                                                    $opnion = explode(';', $person->getResearch()->getOpnionIasd());

                                                    echo '<tr>'
                                                        . '<td>' . $person->getId() . '</td>'
                                                        . '<td>' . $person->getName() . '</td>'
                                                        . '<td>';
                                                    for ($i = 0; $i < count($type); $i++) {
                                                        if ($opnion[0] == $type[$i] || $opnion[1] == $type[$i])
                                                            echo $type[$i] . '; ';
                                                    }
                                                    echo '</td>'
                                                        . '</tr>';

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
        </div>

        <script>
            $(document).ready(function () {
                $('#dataTables').dataTable();
            })
        </script>

        <?php
        break;


    case 'opnionPerson':
        $get = $_POST['type'];
        $typeGood = array('Honesto', 'Comprometido', 'Persistente', 'Companheiro', 'NDA');
        $typeBad = array('Pontualidade', 'Hipocrita', 'Falso', 'Interesseiro', 'NDA');
        $typeAll = array('Honesto', 'Comprometido', 'Persistente', 'Companheiro', 'Pontualidade', 'Hipocrita', 'Falso', 'Interesseiro', 'NDA');
        $opnions = Database::ReadAll('research', 'OPNION_ADVENTISTA');

        if($get == 'good') $type = $typeGood;
        if($get == 'bad') $type = $typeBad;
        if($get == 'all') $type = $typeAll;

        for($i=0; $i < count($type); $i++){
            $typeCount[$i] = 0;
            foreach($opnions as $opnion){
                $opnion = explode(';', $opnion['OPNION_ADVENTISTA']);
                if($opnion[0] == $type[$i])
                    $typeCount[$i]++;
                else if($opnion[1] == $type[$i])
                    $typeCount[$i]++;
            }
        }

        for($i=0; $i < count($type); $i++) {
            $data[] = array(
                'y' => $type[$i],
                'a' => $typeCount[$i]
            );
        }

        echo json_encode($data);

        break;

    case 'detalOpnionPerson':
        $get = $_POST['type'];
        $typeGood = array('Honesto', 'Comprometido', 'Persistente', 'Companheiro', 'NDA');
        $typeBad = array('Pontualidade', 'Hipocrita', 'Falso', 'Interesseiro', 'NDA');
        $typeAll = array('Honesto', 'Comprometido', 'Persistente', 'Companheiro', 'Pontualidade', 'Hipocrita', 'Falso', 'Interesseiro', 'NDA');
        $persons = Resident::getResidents();

        if($get == 'good') $type = $typeGood;
        if($get == 'bad') $type = $typeBad;
        if($get == 'all') $type = $typeAll;

        for($i=0; $i < count($type); $i++){
            $typeCount[$i] = 0;
            if($persons){
                foreach($persons as $opnion) {
                    if ($opnion->getResearch()) {
                        $opnion = explode(';', $opnion->getResearch()->getOpnionAdventista());
                        if ($opnion[0] == $type[$i])
                            $typeCount[$i]++;
                        else if ($opnion[1] == $type[$i])
                            $typeCount[$i]++;
                    }
                }
            }
        }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Opnião sobre os Adventistas
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Pessoas por Opinião</a>
                            </li>
                            <li><a href="#profile" data-toggle="tab">Pesquisar por Pessoas</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Opinião</th>
                                            <th>Nº Pessoas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        for ($i = 0; $i < count($type); $i++) {
                                            echo '<tr>'.
                                                '<td>'.$type[$i].'</td>'.
                                                '<td>'.$typeCount[$i].'</td>'.
                                                '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Opinião</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($persons) {
                                            foreach ($persons as $person) {
                                                if ($person->getResearch()) {
                                                    $opnion = explode(';', $person->getResearch()->getOpnionAdventista());

                                                    echo '<tr>'
                                                        . '<td>' . $person->getId() . '</td>'
                                                        . '<td>' . $person->getName() . '</td>'
                                                        . '<td>';
                                                    for ($i = 0; $i < count($type); $i++) {
                                                        if ($opnion[0] == $type[$i] || $opnion[1] == $type[$i])
                                                            echo $type[$i] . '; ';
                                                    }
                                                    echo '</td>'
                                                        . '</tr>';

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
        </div>

        <script>
            $(document).ready(function () {
                $('#dataTables').dataTable();
            })
        </script>

        <?php
        break;



    default:
        echo 'erro';
        break;

}