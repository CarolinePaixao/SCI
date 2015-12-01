<?php
include_once '../class/Functions.php';
include_once '../class/Mission.php';
include_once '../class/Resident.php';
$acao = $_POST['acao'];

switch($acao){

    case 'religion':
        $cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_NUMBER_INT);
        $rel = Religion::getReligion("WHERE id_religion = $cod");
        ?>
        <p><label>Nome</label>: <?=$rel->getName()?></p>
        <?php
        break;

    case 'admin':
        $cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_NUMBER_INT);
        $cal = false;
        if(!Database::ReadOne('calebe', '*', 'WHERE id_person ='.$cod)){
            $per = Person::getPerson('WHERE id_person = '.$cod);
        }else{
            $per = Calebe::getCalebe('AND p.id_person = '.$cod);
            $cal = true;
        }
        ?>
        <p><label>No sistema desde</label>: <?php echo $per->getDateInsert(); ?></p>

        <h4>Dados Pessoais</h4>
        <p><label>Nome</label>: <?=$per->getName()?></p>
        <p><label>Idade</label>: <?=$per->getAge()?>  |  <label>Sexo</label>: <?=$per->getSex()?>
            | <label>Email</label>: <?=$per->getEmail()?></p>
        <p><label>Telefone</label>: <?=Functions::pushMask($per->getPhone())?>
            | <label>Operadora</label>:  <?php if($per->getOperator()) echo $per->getOperator(); else echo 'Não especificado';?></p>
        <p><label>Estado Cívil</label>: <?=$per->getMaritalStatus()?>
            | <label>Filhos</label>:  <?=$per->getChildren()?></p>
        <p><label>Religião</label>:  <?=$per->getReligion()->getName()?></p>
        <?php if($cal) { ?>
        <p><label>Ano inicio da Fé</label>:  <?=$per->getTimeStudy()?>
            | <label>Batizado?</label> <?php if($per->getBaptism() == 1) echo 'Sim'; else echo 'Não';?> </p>
        <p><label>Nível</label>:  <?php if($per->getLogin()->getRole() == 1) echo 'Calebe'; else echo 'Líder Calebe';?></p>
        <?php }?>
        <hr>

        <h4>Endereço</h4>
        <p><label>CEP</label>:  <?=$per->getAddress()->getZipcode()?></p>
        <p><label>Logradouro</label>:
            <?=$per->getAddress()->getStreet()?>, <?=$per->getAddress()->getNumber()?> <?=$per->getAddress()->getComplement()?>
            - <?=$per->getAddress()->getDistrict()?> - <?=$per->getAddress()->getCity()?> / <?=$per->getAddress()->getState()?>
        </p>
        <p><label>Observações</label>:  <?=$per->getAddress()->getPs()?></p>
        <?php
        break;

    case 'calebe':
        $cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_NUMBER_INT);
        $per = Calebe::getCalebe('AND p.id_person = '.$cod);
        ?>
        <p><label>No sistema desde</label>: <?=$per->getDateInsert()?></p>

        <h4>Dados Pessoais</h4>
        <p><label>Nome</label>: <?=$per->getName()?></p>
        <p><label>Idade</label>: <?=$per->getAge()?>  |  <label>Sexo</label>: <?=$per->getSex()?>
            | <label>Email</label>: <?=$per->getEmail()?></p>
        <p><label>Telefone</label>: <?=Functions::pushMask($per->getPhone())?>
            | <label>Operadora</label>:  <?php if($per->getOperator()) echo $per->getOperator(); else echo 'Não especificado';?></p>
        <p><label>Estado Cívil</label>: <?=$per->getMaritalStatus()?>
            | <label>Filhos</label>:  <?=$per->getChildren()?></p>
        <p><label>Religião</label>:  <?=$per->getReligion()->getName()?></p>
        <p><label>Ano inicio da Fé</label>:  <?=$per->getTimeStudy()?>
            | <label>Batizado?</label> <?php if($per->getBaptism() == 1) echo 'Sim'; else echo 'Não';?> </p>
        <p><label>Nível</label>:  <?php if($per->getLogin()->getRole() == 1) echo 'Calebe'; else echo 'Líder Calebe';?></p>
        <hr>

        <h4>Endereço</h4>
        <p><label>CEP</label>:  <?=$per->getAddress()->getZipcode()?></p>
        <p><label>Logradouro</label>:
            <?=$per->getAddress()->getStreet()?>, <?=$per->getAddress()->getNumber()?> <?=$per->getAddress()->getComplement()?>
            - <?=$per->getAddress()->getDistrict()?> - <?=$per->getAddress()->getCity()?> / <?=$per->getAddress()->getState()?>
        </p>
        <p><label>Observações</label>:  <?=$per->getAddress()->getPs()?></p>
        <?php
        break;

    case 'team':
        $cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_NUMBER_INT);
        $team = Team::getTeam('WHERE id_team = '.$cod);
        ?>
        <p><label>Nome Equipe</label>: <?=$team->getName()?></p>
        <p><label>Líder</label>: <?=$team->getLeader()->getName()?></p>
        <p><label>Status</label>: <?=$team->getStatus()?>

        <p><label>Integrantes</label>:<br/>
            <?php foreach($team->getMembers() as $member){
                echo $member->getId() . ' - ' . $member->getName() . '<br />';
            }?></p>
        <?php
        break;

    case 'church':
        $cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_NUMBER_INT);
        $chur = Church::getChurch('WHERE id_church = '.$cod);
        ?>
        <p><label>Nome</label>: <?=$chur->getName()?></p>
        <p><label>Pastor</label>: <?=$chur->getPastor()?></p>
        <p><label>Status</label>: <?=$chur->getStatus()?>

        <h4>Endereço</h4>
        <p><label>CEP</label>:  <?=$chur->getAddress()->getZipcode()?></p>
        <p><label>Logradouro</label>:
            <?=$chur->getAddress()->getStreet()?>, <?=$chur->getAddress()->getNumber()?> <?=$chur->getAddress()->getComplement()?>
            - <?=$chur->getAddress()->getDistrict()?> - <?=$chur->getAddress()->getCity()?> / <?=$chur->getAddress()->getState()?>
        </p>
        <p><label>Observações</label>:  <?=$chur->getAddress()->getPs()?></p>
        <?php
        break;

    case 'mission':
        $cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_NUMBER_INT);
        $miss = Mission::getMission('WHERE id_mission = '.$cod);
        ?>
        <p><label>Nome</label>: <?=$miss->getName()?></p>
        <p><label>Equipe</label>: <?=$miss->getTeam()->getName()?></p>
        <p><label>Data Inicio</label>: <?=$miss->getDateBegin()?> | <label>Data Fim</label>: <?=$miss->getDateEnd()?></p>
        <p><label>Status</label>: <?=$miss->getStatus()?></p>
        <hr>
        <h4>Local</h4>
        <?php if($miss->getAddress()->getId()) { ?>
        <p><label>CEP</label>:  <?=$miss->getAddress()->getZipcode()?></p>
        <p><label>Logradouro</label>:
            <?=$miss->getAddress()->getStreet()?>, <?=$miss->getAddress()->getNumber()?> <?=$miss->getAddress()->getComplement()?>
            - <?=$miss->getAddress()->getDistrict()?> - <?=$miss->getAddress()->getCity()?> / <?=$miss->getAddress()->getState()?>
        </p>
        <p><label>Observações</label>:  <?=$miss->getAddress()->getPs()?></p>
        <?php }
        if($miss->getChurch()->getId()) { ?>
            <p><label>Igreja</label>: <?=$miss->getChurch()->getName()?></p>
            <p><label>CEP</label>:  <?=$miss->getChurch()->getAddress()->getZipcode()?></p>
            <p><label>Logradouro</label>:
                <?=$miss->getChurch()->getAddress()->getStreet()?>, <?=$miss->getChurch()->getAddress()->getNumber()?> <?=$miss->getChurch()->getAddress()->getComplement()?>
                - <?=$miss->getChurch()->getAddress()->getDistrict()?> - <?=$miss->getChurch()->getAddress()->getCity()?> / <?=$miss->getChurch()->getAddress()->getState()?>
            </p>
            <p><label>Observações</label>:  <?=$miss->getChurch()->getAddress()->getPs()?></p>
        <?php
        }
        break;

    case 'resident':
        $cod = filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_NUMBER_INT);
        $res = Resident::getResident('AND p.id_person = '.$cod);
        ?>
        <p><label>No sistema desde</label>: <?=$res->getDateInsert()?></p>
        <h4>Dados Pessoais</h4>
        <p><label>Nome</label>: <?=$res->getName()?></p>
        <p><label>Idade</label>: <?=$res->getAge()?>  |  <label>Sexo</label>: <?=$res->getSex()?>
            | <label>Email</label>: <?=$res->getEmail()?></p>
        <p><label>Telefone</label>: <?=Functions::pushMask($res->getPhone())?>
            | <label>Operadora</label>:  <?php if($res->getOperator()) echo $res->getOperator(); else echo 'Não especificado';?></p>
        <p><label>Estado Cívil</label>: <?=$res->getMaritalStatus()?>
            | <label>Filhos</label>:  <?=$res->getChildren()?></p>
        <p><label>Religião</label>:  <?=$res->getReligion()->getName()?></p>

        <p><label>Mora com quantas pessoas</label>:  <?=$res->getNumberResident()?>
            | <label>Chefe da casa:</label> <?=$res->getHouseFather()?> </p>
        <p><label>Número de parentes Adventistas</label>:  <?=$res->getCognateAdventista()?></p>
        <hr>

        <h4>Endereço</h4>
        <p><label>CEP</label>:  <?=$res->getAddress()->getZipcode()?></p>
        <p><label>Logradouro</label>:
            <?=$res->getAddress()->getStreet()?>, <?=$res->getAddress()->getNumber()?> <?=$res->getAddress()->getComplement()?>
            - <?=$res->getAddress()->getDistrict()?> - <?=$res->getAddress()->getCity()?> / <?=$res->getAddress()->getState()?>
        </p>
        <p><label>Observações</label>:  <?=$res->getAddress()->getPs()?></p>
        <hr>

        <h4>Pesquisa</h4>
        <?php
        if(!$res->getResearch())
            echo '<p>Pesquisa Não realizada</p>';
        else{
            echo '<p><label>Data da Pesquisa</label>: '.$res->getResearch()->getDateResearch().'</p>';
            echo '<p><label>Ano de Início de Fé</label>: '.$res->getResearch()->getTimeFe().'</p>';
            echo '<p><label>Conhece a IASD</label>? ';
             if($res->getResearch()->getKnowIasd() == 1) echo 'Sim';
             else echo 'Não';

             if($res->getResearch()->getKnowIasd() == 1) {
                 echo ' | <label>Já visitou</label>? ';

                 if($res->getResearch()->getIasdVisit() == 1) {
                     echo 'Sim';
                     echo ' | <label>Voltaria</label>? ';
                     if ($res->getResearch()->getIasdBack() == 1) echo 'Sim';
                         else echo 'Não';

                     echo ' | <label>Igreja que visitou</label>: ' . $res->getResearch()->getIasdLocal();
                 }
                 else echo 'Não';

             }
             echo '</p>';

            echo '<p><label>Sabe o Significado da palavra Adventista</label>? ';
                if($res->getResearch()->getknowSignification() == 1) echo 'Sim';
                else echo 'Não';
                echo '</p>';

            echo '<p>'.'<label>Considera-se Adventista</label>? ';
            if($res->getResearch()->getConsiderAdventista() == 1) echo 'Sim';
            else echo 'Não';
            echo '</p>';

            echo '<p><label>Conhece os </label>:';
            echo '  <label>Aventureiros:</label>';
                if($res->getResearch()->getKnowAventureiros() == 1) echo 'Sim';
                else echo 'Não';
            echo ' | <label>ADRA:</label>';
                if($res->getResearch()->getKnowAdra() == 1) echo 'Sim';
                else echo 'Não';
            echo ' | <label>Desbravadores:</label>';
                if($res->getResearch()->getKnowDesbravadores() == 1) echo 'Sim';
                else echo 'Não';
            echo '</p>';


            ?>
            <p><label>Opinião sobre projetos:</label>  <?=$res->getResearch()->getOpnionProjects()?> </p>
            <p><label>Opinião sobre a IASD:</label>  <?=$res->getResearch()->getOpnionIasd()?></p>
            <p><label>Opinião sobre os Adventistas:</label>  <?=$res->getResearch()->getOpnionAdventista()?></p>
            <p><label>Opinião por:</label>  <?=$res->getResearch()->getOpnionReason()?></p>

            <?php
            echo '<p><label>Conhece a TV Novo Tempo?</label> ';
                if($res->getResearch()->getKnowTv() == 1){
                    echo 'Sim';
                    echo ' | <label>Programa que gosta:</label> '. $res->getResearch()->getProgramTv();;
                }
                else echo 'Não';
            echo '</p>';

        }
        break;

    default:
        echo 'erro';
        break;

}