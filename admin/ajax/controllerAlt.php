<?php
session_start();
include_once "../class/Functions.php";
include_once '../class/Address.php';
$acao = $_POST['acao'];
switch($acao) {

    case 'alterReligion':
        $id = $_POST['ID_RELIGION'];
        $religion = $_POST['NAME_RELIGION'];

        Database::Update('religion', "name_religion = '$religion'", "WHERE id_religion = $id");
        echo 'success';
        break;

    case 'alterMissao1':
        $id_team = $_POST['ID_TEAM'];
        $dtInitial = $_POST['DATE_INITIAL'];
        $dtFinal = $_POST['DATE_END'];

        $Initial = DateTime::createFromFormat('d/m/Y', $dtInitial, new DateTimeZone('UTC'));
        $Final = DateTime::createFromFormat('d/m/Y', $dtFinal, new DateTimeZone('UTC'));
        if ($Initial > $Final) {
            echo 'date';
        } else if (Database::ReadOne('mission', '*', "WHERE id_team = $id_team AND ( ($dtInitial BETWEEN date_inicial AND date_end) OR ($dtFinal BETWEEN date_inicial AND date_end) ) "))
            echo 'team';
        else {
            $_SESSION['in'] = $_POST;
            echo 'success';
        }
        break;

    case 'alterMissaoI':
        $id_mission = $_SESSION['in']['ID_MISSION'];
        $mission['NAME_MISSION'] = $_SESSION['in']['NAME_MISSION'];
        $mission['STATUS'] = $_SESSION['in']['STATUS'];
        $mission['ID_TEAM'] = $_SESSION['in']['ID_TEAM'];
        $mission['DATE_INICIAL'] = $_SESSION['in']['DATE_INITIAL'];
        $mission['DATE_END'] = $_SESSION['in']['DATE_END'];
        $mission['ID_CHURCH'] = $_POST['ID_CHURCH'];
        $mission['ID_ADDRESS'] = null;

        Database::UpdateGeneric('mission', $mission, "WHERE id_mission = $id_mission");
        if($mission['STATUS'] == 'Concluida' || $mission['STATUS'] == 'Cancelada' )
            Database::Update('team', 'STATUS = "Disponível"', "WHERE id_team = ".$mission['ID_TEAM']);
        else
            Database::Update('team', 'STATUS = "Ocupada"', "WHERE id_team = ".$mission['ID_TEAM']);
        echo 'success';

        break;

    case 'alterMissaoE':
        $id_address = (isset($_POST['ID_ADDRESS'])) ? $_POST['ID_ADDRESS'] : false;
        $address['ZIPCODE'] = $_POST['ZIPCODE'];
        $address['NAME_ADDRESS'] = $_POST['NAME_ADDRESS'];
        $address['NUMBER'] = $_POST['NUMBER'];
        $address['COMPLEMENT'] = $_POST['COMPLEMENT'];
        $address['DISTRICT'] = $_POST['DISTRICT'];
        $address['ID_CITY'] = $_POST['ID_CITY'];
        $address['LATITUDE'] = $_POST['LATITUDE'];
        $address['LONGITUDE'] = $_POST['LONGITUDE'];
        $address['PS'] = $_POST['PS'];

        if ($id_address) {
            // Alterando Endereço
            Database::UpdateGeneric('address', $address, "WHERE id_address = $id_address");
        } else {
            $mission['ID_ADDRESS'] = Database::Insert('address', 'ZIPCODE, NAME_ADDRESS, NUMBER, COMPLEMENT, DISTRICT, ID_CITY, PS, LATITUDE, LONGITUDE', "'$zipcode', '$address', $number, '$complement', '$district', $id_city, '$ps', '$latitude', '$longitude'");
        }

        $id_mission = $_SESSION['in']['ID_MISSION'];
        $mission['NAME_MISSION'] = $_SESSION['in']['NAME_MISSION'];
        $mission['STATUS'] = $_SESSION['in']['STATUS'];
        $mission['ID_TEAM'] = $_SESSION['in']['ID_TEAM'];
        $mission['DATE_INICIAL'] = $_SESSION['in']['DATE_INITIAL'];
        $mission['DATE_END'] = $_SESSION['in']['DATE_END'];
        $mission['ID_CHURCH'] = null;

        // Alterando Missão
        Database::UpdateGeneric('mission', $mission, "WHERE id_mission = $id_mission");
        if($mission['STATUS'] == 'Concluida' || $mission['STATUS'] == 'Cancelada' )
            Database::Update('team', 'STATUS = "Disponível"', "WHERE id_team = ".$mission['ID_TEAM']);
        else
            Database::Update('team', 'STATUS = "Ocupada"', "WHERE id_team = ".$mission['ID_TEAM']);

        echo 'success';

        break;

    case 'alterEquipe':
        $id_team = $_POST['ID_TEAM'];
        $team['NAME_TEAM'] = $_POST['NAME_TEAM'];
        $team['ID_LEADER'] = $_POST['ID_LEADER'];
        $team['STATUS'] = $_POST['STATUS'];
        $integrantes = $_POST['CALEBES_MISSAO'];

        Database::UpdateGeneric('team', $team, "WHERE id_team = $id_team");

        Database::Delete('team_calebe', "WHERE id_team = $id_team");

        Database::Insert('team_calebe', 'ID_TEAM, ID_CALEBE', "$id_team, " . $team['ID_LEADER']);

        foreach ($integrantes as $id_integrante) {
            Database::Insert('team_calebe', 'ID_TEAM, ID_CALEBE', "$id_team, $id_integrante");
        }

        echo 'success';

        break;

    case 'alterIgreja1':
        $_SESSION['in'] = $_POST;
        break;

    case 'alterIgreja2':
        $id_church = $_SESSION['in']['ID_CHURCH'];
        $church['NAME_CHURCH'] = $_SESSION['in']['NAME_CHURCH'];
        $church['NAME_PASTOR'] = $_SESSION['in']['NAME_PASTOR'];
        $church['STATUS'] = $_SESSION['in']['STATUS'];

        $id_address = $_POST['ID_ADDRESS'];
        $address['ZIPCODE'] = $_POST['ZIPCODE'];
        $address['NAME_ADDRESS'] = $_POST['NAME_ADDRESS'];
        $address['NUMBER'] = $_POST['NUMBER'];
        $address['COMPLEMENT'] = $_POST['COMPLEMENT'];
        $address['DISTRICT'] = $_POST['DISTRICT'];
        $address['ID_CITY'] = $_POST['ID_CITY'];
        $address['LATITUDE'] = $_POST['LATITUDE'];
        $address['LONGITUDE'] = $_POST['LONGITUDE'];
        $address['PS'] = $_POST['PS'];

        // Alterando Endereço
        $addressEx = Database::ReadOne('address', '*', "WHERE zipcode = '".$address['ZIPCODE']."' AND number = ".$address['NUMBER']." AND complement = '".$address['COMPLEMENT']."' AND id_address != $id_address");
        if( $addressEx != '' ){
            echo 'exist';
        }else {
            Database::UpdateGeneric('address', $address, "WHERE ID_ADDRESS = $id_address");
            $history = Database::ReadOne('history', '*', "WHERE id_church = $id_church ORDER BY id_history DESC LIMIT 1");
            $dadoChurch = Database::ReadOne('church', 'NAME_PASTOR', "WHERE id_church = $id_church");
            date_default_timezone_set('America/Sao_Paulo');
            $dateUpdate = date('d/m/Y H:m');
            if ($history['NAME_PASTOR'] === $dadoChurch['NAME_PASTOR'] && $history['NAME_PASTOR'] !== $church['NAME_PASTOR'] && empty($history['DATE_FINAL'])) {
                Database::Update('history', "DATE_FINAL = '$dateUpdate'", "WHERE ID_HISTORY = " . $history['ID_HISTORY']);
                Database::Insert('history', 'ID_CHURCH, NAME_PASTOR, DATE_INICIAL', "$id_church, '" . $church['NAME_PASTOR'] . "', '$dateUpdate'");
            }

            // Alterando Igreja
            Database::UpdateGeneric('church', $church, "WHERE ID_CHURCH = $id_church");

            echo 'success';
            unset($_SESSION['in']);
        }
        break;

    case 'alterMorador1':
        $id = $_POST['ID_PERSON'];
        $email = $_POST['EMAIL'];
        $phone = $_POST['PHONE'];
        $name = $_POST['NAME_PERSON'];

        if(!Functions::validEmail($email)){
            echo 'email';
        }else if( Database::ReadOne('person', '*', "WHERE name_person = '$name'  AND email = '$email' AND id_person <> $id") )
            echo 'exist';
        else if( Database::ReadOne('person', '*', "WHERE email = '$email' AND id_person <> $id") )
            echo 'emailexist';
        else if(!Functions::validPhone($phone) && !Functions::validCelphone($phone))
            echo 'phone';
        else{
            $_SESSION['in'] = $_POST;
            echo 'success';
        }
        break;

    case 'alterMorador2':
        $id_person = $_SESSION['in']['ID_PERSON'];
        $person['NAME_PERSON'] = $_SESSION['in']['NAME_PERSON'];
        $person['EMAIL'] = $_SESSION['in']['EMAIL'];
        $person['AGE'] = $_SESSION['in']['AGE'];
        $person['SEX'] = $_SESSION['in']['SEX'];
        $person['CHILDREN'] = $_SESSION['in']['CHILDREN'];
        $person['MARITAL_STATUS'] = $_SESSION['in']['MARITAL_STATUS'];
        $person['PHONE'] = str_replace(['(', ')', '-'], '',$_SESSION['in']['PHONE']);
        $person['OPERATOR'] = $_SESSION['in']['OPERATOR'];
        $person['ID_RELIGION'] = $_SESSION['in']['ID_RELIGION'];

        $resident['NUMBER_RESIDENT_HOUSE'] = $_SESSION['in']['NUMBER_RESIDENT_HOUSE'];
        $resident['HOUSEFATHER'] = $_SESSION['in']['HOUSEFATHER'];
        $resident['COGNATE_ADVENTISTA'] = $_SESSION['in']['COGNATE_ADVENTISTA'];

        $id_address = $_POST['ID_ADDRESS'];
        $address['ZIPCODE'] = $_POST['ZIPCODE'];
        $address['NAME_ADDRESS'] = $_POST['NAME_ADDRESS'];
        $address['NUMBER'] = $_POST['NUMBER'];
        $address['COMPLEMENT'] = $_POST['COMPLEMENT'];
        $address['DISTRICT'] = $_POST['DISTRICT'];
        $address['ID_CITY'] = $_POST['ID_CITY'];
        $address['LATITUDE'] = $_POST['LATITUDE'];
        $address['LONGITUDE'] = $_POST['LONGITUDE'];
        $address['PS'] = $_POST['PS'];


        // Alterando Endereço
        Database::UpdateGeneric('address', $address, "WHERE ID_ADDRESS = $id_address");
        // Alterando Pessoa
        Database::UpdateGeneric('person', $person,"WHERE ID_PERSON = $id_person");
        // Alterando Calebe
        Database::UpdateGeneric('resident', $resident, "WHERE ID_PERSON = $id_person");

        unset($_SESSION['in']);
        echo 'success';
        break;

    case 'alterCalebe1':
        $id = $_POST['ID_PERSON'];
        $email = $_POST['EMAIL'];
        $phone = $_POST['PHONE'];
        $name = $_POST['NAME_PERSON'];
        $age = $_POST['AGE'];
        $time_study = $_POST['TIME_STUDY'];

        if(!Functions::validEmail($email)){
            echo 'email';
        }else if( Database::ReadOne('person', '*', "WHERE name_person = '$name' AND email = '$email' AND id_person <> $id") )
            echo 'exist';
        else if( Database::ReadOne('person', '*', "WHERE email = '$email' AND id_person <> $id") )
            echo 'emailexist';
        else if(!Functions::validPhone($phone) && !Functions::validCelphone($phone))
            echo 'phone';
        else if($time_study < (2015 - $age))
            echo 'year';
        else{
            $_SESSION['in'] = $_POST;
            echo 'success';
        }

        break;

    case 'alterCalebe2':
        $_SESSION['in2'] = $_POST;
        break;

    case 'alterCalebe3':
        $id_person = $_SESSION['in']['ID_PERSON'];
        $person['NAME_PERSON'] = $_SESSION['in']['NAME_PERSON'];
        $person['EMAIL'] = $_SESSION['in']['EMAIL'];
        $person['AGE'] = $_SESSION['in']['AGE'];
        $person['SEX'] = $_SESSION['in']['SEX'];
        $person['CHILDREN'] = $_SESSION['in']['CHILDREN'];
        $person['MARITAL_STATUS'] = $_SESSION['in']['MARITAL_STATUS'];
        $person['PHONE'] = str_replace(['(', ')', '-'], '',$_SESSION['in']['PHONE']);
        $person['OPERATOR'] = $_SESSION['in']['OPERATOR'];
        $person['ID_RELIGION'] = $_SESSION['in']['ID_RELIGION'];

        $calebe['STATUS'] = $_SESSION['in']['STATUS'];
        $calebe['TIME_STUDY'] = $_SESSION['in']['TIME_STUDY'];
        $calebe['BAPTISM'] = $_SESSION['in']['BAPTISM'];
        $calebe['LEADER'] = ($_SESSION['in']['BAPTISM'] == 1 && $_SESSION['in']['ID_RELIGION'] == 1) ? $_SESSION['in']['LEADER'] : 1;

        $id_address = $_SESSION['in2']['ID_ADDRESS'];
        $address['ZIPCODE'] = $_SESSION['in2']['ZIPCODE'];
        $address['NAME_ADDRESS'] = $_SESSION['in2']['NAME_ADDRESS'];
        $address['NUMBER'] = $_SESSION['in2']['NUMBER'];
        $address['COMPLEMENT'] = $_SESSION['in2']['COMPLEMENT'];
        $address['DISTRICT'] = $_SESSION['in2']['DISTRICT'];
        $address['ID_CITY'] = $_SESSION['in2']['ID_CITY'];
        $address['LATITUDE'] = $_SESSION['in2']['LATITUDE'];
        $address['LONGITUDE'] = $_SESSION['in2']['LONGITUDE'];
        $address['PS'] = $_SESSION['in2']['PS'];

        $login['USER_NAME'] = $_POST['USER_NAME'];
        $login['USER_PASS'] = $_POST['USER_PASS'];
        $login['ROLE'] = $calebe['LEADER'];

        // Alterando Endereço
        Database::UpdateGeneric('address', $address, "WHERE ID_ADDRESS = $id_address");
        // Alterando Pessoa
        Database::UpdateGeneric('person', $person,"WHERE ID_PERSON = $id_person");
        // Alterando Calebe
        Database::UpdateGeneric('calebe', $calebe, "WHERE ID_PERSON = $id_person");
        // Alterando Login
        Database::UpdateGeneric('login', $login, "WHERE ID_PERSON = $id_person");
        unset($_SESSION['in']);
        unset($_SESSION['in2']);
        echo 'success';
        break;

    case 'alterPerfilPessoal':
        $id_person = $_POST['ID_PERSON'];
        $person['NAME_PERSON'] = $_POST['NAME_PERSON'];
        $person['EMAIL'] = $_POST['EMAIL'];
        $person['PHONE'] = $_POST['PHONE'];
        if(!Functions::validEmail($person['EMAIL'])){
            echo 'email';
        }else if( Database::ReadOne('person', '*', "WHERE name_person = '".$person['NAME_PERSON']."' AND id_person <> $id_person") )
            echo 'exist';
        else if( Database::ReadOne('person', '*', "WHERE email = '".$person['EMAIL']."' AND id_person <> $id_person") )
            echo 'emailexist';
        else if(!Functions::validPhone($person['PHONE']) && !Functions::validCelphone($person['PHONE']))
            echo 'phone';
        else {
            $person['PHONE'] = str_replace(['(', ')', '-', '_'], '', $_POST['PHONE']);
            $person['AGE'] = $_POST['AGE'];
            $person['SEX'] = $_POST['SEX'];
            $person['CHILDREN'] = $_POST['CHILDREN'];
            $person['MARITAL_STATUS'] = $_POST['MARITAL_STATUS'];
            $person['OPERATOR'] = $_POST['OPERATOR'];
            $person['ID_RELIGION'] = $_POST['ID_RELIGION'];
            Database::UpdateGeneric('person', $person, "WHERE ID_PERSON = $id_person");
            Database::Update('login', 'user_name = "'.$person['EMAIL'].'"', "WHERE ID_PERSON = $id_person");

            if ($_POST['type'] == 'calebe') {
                $calebe['STATUS'] = $_POST['STATUS'];
                $calebe['TIME_STUDY'] = $_POST['TIME_STUDY'];
                $calebe['BAPTISM'] = $_POST['BAPTISM'];
                $calebe['LEADER'] = $_POST['LEADER'];
                Database::UpdateGeneric('calebe', $calebe, "WHERE ID_PERSON = $id_person");
            }

            $_SESSION['login']['name'] = $person['NAME_PERSON'];
            echo 'success';
        }
        break;

    case 'alterPerfilEnd':
        $id_address = $_POST['ID_ADDRESS'];
        $address['ZIPCODE'] = $_POST['ZIPCODE'];
        $address['NAME_ADDRESS'] = $_POST['NAME_ADDRESS'];
        $address['NUMBER'] = $_POST['NUMBER'];
        $address['COMPLEMENT'] = $_POST['COMPLEMENT'];
        $address['DISTRICT'] = $_POST['DISTRICT'];
        $address['ID_CITY'] = $_POST['ID_CITY'];
        $address['LATITUDE'] = $_POST['LATITUDE'];
        $address['LONGITUDE'] = $_POST['LONGITUDE'];
        $address['PS'] = $_POST['PS'];

        Database::UpdateGeneric('address', $address, "WHERE ID_ADDRESS = $id_address");
        echo 'success';
        break;

    case 'alterPerfilLog':
        $login['ID_LOGIN'] = $_POST['ID_LOGIN'];
        $login['USER_PASS'] = $_POST['USER_PASS'];

        Database::Update('login', 'user_pass = "'.$login['USER_PASS'].'"', "WHERE ID_LOGIN = ".$_POST['ID_LOGIN']);

        echo 'success';
        break;

    case 'makeAdmin':
        $id_person = $_POST['id'];
        Database::Update('login', 'role = 3', "WHERE id_person = $id_person");
        echo 'success';
        break;

    case 'removeAdmin':
        $id_person = $_POST['id'];
        Database::Update('login', 'role = 2', "WHERE id_person = $id_person");
        if( !Database::ReadOne('calebe', '*', "WHERE id_person = $id_person") )
            Database::Insert('calebe', 'ID_PERSON, TIME_STUDY, BAPTISM, LEADER, STATUS', "$id_person, '', 0, 2, 'Ativo'");

        echo 'success';
        break;

    case 'makeLeader':
        $id_person = $_POST['id'];
        Database::Update('calebe', 'leader = 2', "WHERE id_person = $id_person");
        Database::Update('login', 'role = 2', "WHERE id_person = $id_person");
        echo 'success';
        break;

    case 'removeLeader':
        $id_person = $_POST['id'];
        Database::Update('calebe', 'leader = 1', "WHERE id_person = $id_person");
        Database::Update('login', 'role = 1', "WHERE id_person = $id_person");
        echo 'success';
        break;

    case 'altPerfil':
        include_once '../class/Calebe.php';

        $cod = $_POST['cod'];
        $cal = Calebe::getCalebe("AND p.id_person = $cod");
        ?>
        <div class="form-group">
            <label for="pass1" class="control-label col-lg-4">Ano de Inicío de Estudo Biblíco</label>

            <div class="col-lg-2">
                <input type="number" id="TIME_STUDY" name="TIME_STUDY" min="1930" max="2015" value="<?=$cal->getTimeStudy()?>" placeholder="YYYY" class="form-control" required/>
            </div>
        </div>

        <div class="form-group">
            <label for="pass1" class="control-label col-lg-4">É batizado</label>

            <div class="col-lg-5">
                <div class="checkbox">
                    <label>
                        <input class="uniform" type="radio" name="BAPTISM" value="1" <?php if($cal->getBaptism() == 1) echo 'checked';?> required /> Sim
                    </label>
                    <label>
                        <input class="uniform" type="radio" name="BAPTISM" value="0" <?php if($cal->getBaptism() == 0) echo 'checked';?>/> Não
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="pass1" class="control-label col-lg-4">Status</label>

            <div class="col-lg-5">
                <select name="STATUS" class="form-control" required>
                    <option value="">Selecione o Status</option>
                    <option <?php if($cal->getStatus() == 'Ativo') echo 'selected'; ?>>Ativo</option>
                    <option <?php if($cal->getStatus() == 'Inativo') echo 'selected'; ?>>Inativo</option>
                    <option >Banido</option>
                </select>
            </div>
        </div>
        <?php
        break;

    default:
        echo 'erro';
        break;
}


