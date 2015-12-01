<?php
session_start();
include_once '../class/Functions.php';
include_once '../class/Address.php';
$acao = $_POST['acao'];
switch($acao){
    case 'Delete':
        $id = $_POST['id'];
        $table = $_POST['table'];
        Database::Delete($table, "WHERE id_$table = $id");
        echo 'success';
        break;

    case 'saveReligion':
        $religion = $_POST['NAME_RELIGION'];

        if(Database::ReadOne('religion', '*', "WHERE name_religion = '$religion'"))
            echo 'exist';
        else {
            Database::Insert('religion', 'NAME_RELIGION', "'$religion'");
            echo 'success';
        }
        break;



    case 'saveAdmin1':
        $email = $_POST['EMAIL'];
        $phone = $_POST['PHONE'];
        $name = $_POST['NAME_PERSON'];

        if(!Functions::validEmail($email)){
            echo 'email';
        }else if( Database::ReadOne('person', '*', "WHERE name_person = '$name'") )
            echo 'exist';
        else if( Database::ReadOne('person', '*', "WHERE email = '$email'") )
            echo 'emailexist';
        else if(!Functions::validPhone($phone) && !Functions::validCelphone($phone))
            echo 'phone';
        else{
            $_SESSION['in'] = $_POST;
            echo 'success';
        }

        break;

    case 'saveAdmin2':
        $_SESSION['in2'] = $_POST;
        break;

    case 'saveAdmin3':
        $name = $_SESSION['in']['NAME_PERSON'];
        $email = $_SESSION['in']['EMAIL'];
        $age = $_SESSION['in']['AGE'];
        $sex = $_SESSION['in']['SEX'];
        $children = $_SESSION['in']['CHILDREN'];
        $maritalStatus = $_SESSION['in']['MARITAL_STATUS'];
        $phone = str_replace(['(', ')', '-'], '',$_SESSION['in']['PHONE']);
        $operator = $_SESSION['in']['OPERATOR'];
        $id_religion = $_SESSION['in']['ID_RELIGION'];

        $zipcode = $_SESSION['in2']['ZIPCODE'];
        $address = $_SESSION['in2']['NAME_ADDRESS'];
        $number = $_SESSION['in2']['NUMBER'];
        $complement = $_SESSION['in2']['COMPLEMENT'];
        $district = $_SESSION['in2']['DISTRICT'];
        $id_city = $_SESSION['in2']['ID_CITY'];
        $latitude = $_SESSION['in2']['LATITUDE'];
        $longitude = $_SESSION['in2']['LONGITUDE'];
        $ps = $_SESSION['in2']['PS'];

        $pass = $_POST['USER_PASS'];

        // Inserindo Endereço
        $id_address = Database::Insert('address', 'ZIPCODE, NAME_ADDRESS, NUMBER, COMPLEMENT, DISTRICT, ID_CITY, PS, LATITUDE, LONGITUDE', "'$zipcode', '$address', $number, '$complement', '$district', $id_city, '$ps', '$latitude', '$longitude'");
        // Inserindo Pessoa
        $id_person = Database::Insert('person', 'NAME_PERSON, EMAIL, AGE, SEX, PHONE, OPERATOR, MARITAL_STATUS, CHILDREN, ID_RELIGION, ID_ADDRESS', "'$name', '$email', $age, '$sex', '$phone', '$operator', '$maritalStatus', $children, $id_religion, $id_address");
        // Inserindo Login
        Database::Insert('login', 'ID_PERSON, USER_NAME, USER_PASS, ROLE', "$id_person, '$email', '$pass', 3");
        unset($_SESSION['in']);
        unset($_SESSION['in2']);
        echo 'success';
        break;


    case 'saveResearch1':
        $research['ID_RESIDENT'] = $_POST['id'];

        if(Database::ReadOne('research', '*', "WHERE id_resident = ".$research['ID_RESIDENT'])) {
            echo json_encode('');
        }else {
            $research['ID_LOGIN'] = $_SESSION['login']['id_login'];
            $research['TIME_FE'] = $_POST['tempoFe'];
            $research['KNOW_IASD'] = $_POST['knowIASD'];
            $research['IASD_VISIT'] = ($_POST['knowIASD'] == 1) ? $_POST['visitIASD'] : 0;
            $research['IASD_BACK'] = (isset($_POST['visitIASD'] ) && isset($_POST['backIASD'])) ? $_POST['backIASD'] : 0;
            $research['IASD_LOCAL'] = (isset($_POST['iasdLocal'])) ? $_POST['iasdLocal'] : '';
            $research['KNOW_SIGNIFICATION'] = $_POST['knowSignification'];
            $research['CONSIDER_ADVENTISTA'] = $_POST['considerAdventista'];
            $research['OPNION_ADVENTISTA'] = $_POST['opnionPersonGood'] . ';' . $_POST['opnionPersonBad'];
            $research['OPNION_IASD'] = $_POST['opnionChurchGood'] . ';' . $_POST['opnionChurchBad'];
            $research['OPNION_REASON'] = $_POST['opnionFor'];
            $research['KNOW_DESBRAVADOR'] = $_POST['knowDesbravadores'];
            $research['KNOW_AVENTUREIRO'] = $_POST['knowAventureiros'];
            $research['KNOW_ADRA'] = $_POST['knowAdra'];
            $research['OPNION_PROJECTS'] = $_POST['opnionProject'] . ';' . $_POST['opnionProjectReason'];
            $research['KNOW_TVNOVOTEMPO'] = $_POST['tv'];
            $research['PROGRAM_TV'] = (isset($_POST['program'])) ? $_POST['program'] : '';

            $_SESSION['in'] = $research;
            echo json_encode($research);
        }
        break;

    case 'saveResearch2':
        $research = $_SESSION['in'];

        Database::InsertGeneric('research', $research);
        echo 'success';

        break;

    case 'saveMissao1':
        $id_team = $_POST['ID_TEAM'];
        $dtInitial = $_POST['DATE_INITIAL'];
        $dtFinal = $_POST['DATE_END'];

        $Initial = DateTime::createFromFormat ('d/m/Y',$dtInitial , new DateTimeZone('UTC'));
        $Final = DateTime::createFromFormat ('d/m/Y',$dtFinal , new DateTimeZone('UTC'));
        if($Initial > $Final){
            echo 'date';
        }
        else if( Database::ReadOne('mission', '*', "WHERE id_team = $id_team AND ( ($dtInitial BETWEEN date_inicial AND date_end) OR ($dtFinal BETWEEN date_inicial AND date_end) ) ") )
            echo 'team';
        else{
            $_SESSION['in'] = $_POST;
            echo 'success';
        }
        break;

    case 'saveMissaoI':
        $nameMission = $_SESSION['in']['NAME_MISSION'];
        $status = $_SESSION['in']['STATUS'];
        $id_team = $_SESSION['in']['ID_TEAM'];
        $dtInitial = $_SESSION['in']['DATE_INITIAL'];
        $dtFinal = $_SESSION['in']['DATE_END'];
        $id_church = $_POST['ID_CHURCH'];

        Database::Insert('mission', 'NAME_MISSION, STATUS, ID_TEAM, DATE_INICIAL, DATE_END, ID_CHURCH', "'$nameMission', '$status', $id_team, '$dtInitial', '$dtFinal', $id_church");
        Database::Update('team', 'STATUS = "Ocupada"', "WHERE id_team = $id_team");
        echo 'success';

        break;

    case 'saveMissaoE':
        $nameMission = $_SESSION['in']['NAME_MISSION'];
        $status = $_SESSION['in']['STATUS'];
        $id_team = $_SESSION['in']['ID_TEAM'];
        $dtInitial = $_SESSION['in']['DATE_INITIAL'];
        $dtFinal = $_SESSION['in']['DATE_END'];

        $zipcode = $_POST['ZIPCODE'];
        $address = $_POST['NAME_ADDRESS'];
        $number = $_POST['NUMBER'];
        $complement = $_POST['COMPLEMENT'];
        $district = $_POST['DISTRICT'];
        $id_city = $_POST['ID_CITY'];
        $ps = $_POST['PS'];
        $latitude = $_POST['LATITUDE'];
        $longitude = $_POST['LONGITUDE'];

        // Inserindo Endereço
        $id_address = Database::Insert('address', 'ZIPCODE, NAME_ADDRESS, NUMBER, COMPLEMENT, DISTRICT, ID_CITY, PS, LATITUDE, LONGITUDE', "'$zipcode', '$address', $number, '$complement', '$district', $id_city, '$ps', '$latitude', '$longitude'");

        Database::Insert('mission', 'NAME_MISSION, STATUS, ID_TEAM, DATE_INICIAL, DATE_END, ID_ADDRESS', "'$nameMission', '$status', $id_team, '$dtInitial', '$dtFinal', $id_address");
        Database::Update('team', 'STATUS = "Ocupada"', "WHERE id_team = $id_team");

        echo 'success';

        break;

    case 'saveEquipe':
        $name = $_POST['NAME_TEAM'];
        $id_leader = $_POST['ID_LEADER'];
        $integrantes = $_POST['CALEBES_MISSAO'];
        $status = $_POST['STATUS'];

        if(Database::ReadOne('team', '*', "WHERE name_team = '$name'"))
            echo 'exist';
        else {
            $id_team = Database::Insert('team', 'NAME_TEAM, ID_LEADER, STATUS', "'$name', $id_leader, '$status'");
            Database::Insert('team_calebe', 'ID_TEAM, ID_CALEBE', "$id_team, $id_leader");
            foreach($integrantes as $id_integrante){
                Database::Insert('team_calebe', 'ID_TEAM, ID_CALEBE', "$id_team, $id_integrante");
            }

            echo 'success';
        }
        break;

    case 'saveIgreja1':
        $_SESSION['in'] = $_POST;
        break;

    case 'saveIgreja2':
        $nameChurch = $_SESSION['in']['NAME_CHURCH'];
        $namePastor = $_SESSION['in']['NAME_PASTOR'];
        $status = $_SESSION['in']['STATUS'];

        $zipcode = $_POST['ZIPCODE'];
        $address = $_POST['NAME_ADDRESS'];
        $number = $_POST['NUMBER'];
        $complement = $_POST['COMPLEMENT'];
        $district = $_POST['DISTRICT'];
        $id_city = $_POST['ID_CITY'];
        $ps = $_POST['PS'];
        $latitude = $_POST['LATITUDE'];
        $longitude = $_POST['LONGITUDE'];

        $addressEx = Database::ReadOne('address', '*', "WHERE zipcode = '$zipcode' AND number = $number AND complement = '$complement'");
        if( $addressEx != '' ){
            echo 'exist';
        }else{
            // Inserindo Endereço
            $id_address = Database::Insert('address', 'ZIPCODE, NAME_ADDRESS, NUMBER, COMPLEMENT, DISTRICT, ID_CITY, PS, LATITUDE, LONGITUDE', "'$zipcode', '$address', $number, '$complement', '$district', $id_city, '$ps', '$latitude', '$longitude'");
            // Inserindo Igreja
            $id_church = Database::Insert('church', 'NAME_CHURCH, NAME_PASTOR, ID_ADDRESS, STATUS', "'$nameChurch', '$namePastor', $id_address, '$status'");

            date_default_timezone_set('America/Sao_Paulo');
            $dateInsert = date('d/m/Y H:m');
            Database::Insert('history', 'ID_CHURCH, NAME_PASTOR, DATE_INICIAL', "$id_church, '$namePastor', '$dateInsert'");

            echo 'success';
            unset($_SESSION['in']);
        }

        break;

    case 'saveMorador1':
        $email = $_POST['EMAIL'];
        $phone = $_POST['PHONE'];
        $name = $_POST['NAME_PERSON'];

        if(!Functions::validEmail($email)){
            echo 'email';
        }else if( Database::ReadOne('person', '*', "WHERE name_person = '$name' AND email = '$email'") )
            echo 'exist';
        else if( Database::ReadOne('person', '*', "WHERE email = '$email'") )
            echo 'emailexist';
        else if(!Functions::validPhone($phone) && !Functions::validCelphone($phone))
            echo 'phone';
        else{
            $_SESSION['in'] = $_POST;
            echo 'success';
        }
        break;

    case 'saveMorador2':
        $name = $_SESSION['in']['NAME_PERSON'];
        $email = $_SESSION['in']['EMAIL'];
        $age = $_SESSION['in']['AGE'];
        $sex = $_SESSION['in']['SEX'];
        $children = $_SESSION['in']['CHILDREN'];
        $maritalStatus = $_SESSION['in']['MARITAL_STATUS'];
        $phone = str_replace(['(', ')', '-'], '',$_SESSION['in']['PHONE']);
        $operator = $_SESSION['in']['OPERATOR'];
        $id_religion = $_SESSION['in']['ID_RELIGION'];
        $resident = $_SESSION['in']['NUMBER_RESIDENT_HOUSE'];
        $housefather = $_SESSION['in']['HOUSEFATHER'];
        $cognate_adventista = $_SESSION['in']['COGNATE_ADVENTISTA'];

        $zipcode = $_POST['ZIPCODE'];
        $address = $_POST['NAME_ADDRESS'];
        $number = $_POST['NUMBER'];
        $complement = $_POST['COMPLEMENT'];
        $district = $_POST['DISTRICT'];
        $id_city = $_POST['ID_CITY'];
        $ps = $_POST['PS'];
        $latitude = $_POST['LATITUDE'];
        $longitude = $_POST['LONGITUDE'];


        // Inserindo Endereço
        $id_address = Database::Insert('address', 'ZIPCODE, NAME_ADDRESS, NUMBER, COMPLEMENT, DISTRICT, ID_CITY, PS, LATITUDE, LONGITUDE', "'$zipcode', '$address', $number, '$complement', '$district', $id_city, '$ps', '$latitude', '$longitude'");
        // Inserindo Pessoa
        $id_person = Database::Insert('person', 'NAME_PERSON, EMAIL, AGE, SEX, PHONE, OPERATOR, MARITAL_STATUS, CHILDREN, ID_RELIGION, ID_ADDRESS', "'$name', '$email', $age, '$sex', '$phone', '$operator', '$maritalStatus', $children, $id_religion, $id_address");
        // Inserindo Morador
        Database::Insert('resident', 'ID_PERSON, NUMBER_RESIDENT_HOUSE, HOUSEFATHER, COGNATE_ADVENTISTA', "$id_person, $resident, '$housefather', '$cognate_adventista'");

        unset($_SESSION['in']);
        echo 'success';
        break;

    case 'saveCalebe1':
        $email = $_POST['EMAIL'];
        $phone = $_POST['PHONE'];
        $name = $_POST['NAME_PERSON'];
        $age = $_POST['AGE'];
        $time_study = $_POST['TIME_STUDY'];

        if(!Functions::validEmail($email)){
            echo 'email';
        }else if( Database::ReadOne('person', '*', "WHERE name_person = '$name' AND email = '$email'") )
            echo 'exist';
        else if( Database::ReadOne('person', '*', "WHERE email = '$email'") )
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

    case 'saveCalebe2':
        $_SESSION['in2'] = $_POST;
        break;

    case 'saveCalebe3':
        $name = $_SESSION['in']['NAME_PERSON'];
        $email = $_SESSION['in']['EMAIL'];
        $age = $_SESSION['in']['AGE'];
        $sex = $_SESSION['in']['SEX'];
        $children = $_SESSION['in']['CHILDREN'];
        $maritalStatus = $_SESSION['in']['MARITAL_STATUS'];
        $phone = str_replace(['(', ')', '-'], '',$_SESSION['in']['PHONE']);
        $operator = $_SESSION['in']['OPERATOR'];
        $id_religion = $_SESSION['in']['ID_RELIGION'];
        $status = $_SESSION['in']['STATUS'];
        $time_study = $_SESSION['in']['TIME_STUDY'];
        $baptism = $_SESSION['in']['BAPTISM'];
        $leader = ($_SESSION['in']['BAPTISM'] == 1 && $_SESSION['in']['ID_RELIGION'] == 1) ? $_SESSION['in']['LEADER'] : 1;

        $zipcode = $_SESSION['in2']['ZIPCODE'];
        $address = $_SESSION['in2']['NAME_ADDRESS'];
        $number = $_SESSION['in2']['NUMBER'];
        $complement = $_SESSION['in2']['COMPLEMENT'];
        $district = $_SESSION['in2']['DISTRICT'];
        $id_city = $_SESSION['in2']['ID_CITY'];
        $latitude = $_SESSION['in2']['LATITUDE'];
        $longitude = $_SESSION['in2']['LONGITUDE'];
        $ps = $_SESSION['in2']['PS'];

        $pass = $_POST['USER_PASS'];

        // Inserindo Endereço
        $id_address = Database::Insert('address', 'ZIPCODE, NAME_ADDRESS, NUMBER, COMPLEMENT, DISTRICT, ID_CITY, PS, LATITUDE, LONGITUDE', "'$zipcode', '$address', $number, '$complement', '$district', $id_city, '$ps', '$latitude', '$longitude'");
        // Inserindo Pessoa
        $id_person = Database::Insert('person', 'NAME_PERSON, EMAIL, AGE, SEX, PHONE, OPERATOR, MARITAL_STATUS, CHILDREN, ID_RELIGION, ID_ADDRESS', "'$name', '$email', $age, '$sex', '$phone', '$operator', '$maritalStatus', $children, $id_religion, $id_address");
        // Inserindo Calebe
        Database::Insert('calebe', 'ID_PERSON, TIME_STUDY, BAPTISM, LEADER, STATUS', "$id_person, '$time_study', $baptism, $leader, '$status'");
        // Inserindo Login
        Database::Insert('login', 'ID_PERSON, USER_NAME, USER_PASS, ROLE', "$id_person, '$email', '$pass', $leader");
        unset($_SESSION['in']);
        unset($_SESSION['in2']);
        echo 'success';
        break;

    case 'login':
        $login = $_POST['user_name'];
        $senha = $_POST['user_pass'];

        if( Functions::verLogin($login, $senha) ){
            $dados = Functions::selectLogin($login);
            $id_login = $dados['ID_LOGIN'];
            $id_person = $dados['ID_PERSON'];
            $_SESSION['login']['role'] = $dados['ROLE'];
            $_SESSION['login']['id_login'] = $id_login;
            $_SESSION['login']['id_person'] = $id_person;
            $name = Database::ReadOne('person', 'name_person', 'WHERE ID_PERSON = '.$id_person);
            $_SESSION['login']['name'] = $name['name_person'];
            echo 'sucesso';
        }else{
            if($login == "" || $senha == ""){
                echo 'vazio';
                break;
            }
            $logValido = Functions::selectLogin($login);
            if(!$logValido){
                echo "loginerrado";
            }else if($logValido['USER_PASS'] != $senha){
                echo "senhaerrada";
            }else{
                echo "erro";
            }
        }
        break;

    case 'forgot':
            $email = $_POST['email'];
            if(empty($email)){
                echo 'emailinvalido';
                break;
            }
            $valid = Database::ReadOne('person', '*', "WHERE EMAIL = '$email'");
            if(!$valid){
                echo 'naoencontrado';
            }else{
                $pass = Database::ReadOne('login', 'user_pass', "WHERE ID_PERSON = ".$valid["ID_PERSON"]);
                if(Functions::sendEmailRecoverPass($email, $valid["NAME_PERSON"], $pass[0]))
                    echo 'enviado';
                else
                    echo 'falha';
            }
        break;

    case 'zipcode':
        $cep = $_POST['zipcode'];

        $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);

        $dados['sucesso'] = (string) $reg->resultado;
        $dados['rua']     = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
        $dados['bairro']  = (string) $reg->bairro;
        $dados['cidade']  = (string) $reg->cidade;
        $dados['estado']  = (string) $reg->uf;
        $dados['latitude']  = (string) $reg->latitude;
        $dados['longitude']  = (string) $reg->longitude;

        echo json_encode($dados);
        break;

    case 'city':
        $nome = $_POST['nome'];
        $city = Functions::getCity("id_state = (SELECT id_state FROM states WHERE id_state = '$nome' OR name_state = '$nome' OR initials = '$nome') ORDER BY name_city ASC");
        echo '<option value="">Selecione a Cidade</option>';
        foreach($city as $list){
            if(isset($_POST['cidade']) && $_POST['cidade'] == $list['NAME_CITY'])
                echo "<option value='".$list['ID_CITY']."' selected>".$list['NAME_CITY']."</option>";
            else
                echo "<option value='".$list['ID_CITY']."'>".$list['NAME_CITY']."</option>";
        }
        break;

    case 'state':
        $uf = $_POST['uf'];
        $states = Functions::getState();
        echo '<option value="">Selecione o Estado</option>';
        foreach($states as $list){
            if($list['INITIALS'] == $uf)
                echo '<option value="'.$list['ID_STATE'].'" selected>'.$list['NAME_STATE']."</option>";
            else
                echo '<option value="'.$list['ID_STATE'].'">'.$list['NAME_STATE']."</option>";
        }

        break;


    case 'contact':
        $name = $_POST['name'];
        $email = $_POST['email'];
        $assunto = $_POST['assunto'];
        $message = $_POST['message'];
        if(Functions::sendEmailContact($email, $assunto, $message, $assunto))
            echo 'enviado';
        else
            echo 'falha';

        break;


    default:
        echo 'erro';
        break;
}


