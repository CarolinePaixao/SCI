<?php
$page = (isset($_GET['p'])) ? $_GET['p'] : '';

switch($page){
    // FORM'S
    case 'cadCalebe':
        include_once 'view/form/formCalebe.php';
        break;
    case 'cadEquipe':
        include_once 'view/form/formEquipe.php';
        break;
    case 'cadIgreja':
        include_once 'view/form/formIgreja.php';
        break;
    case 'cadMissao':
        include_once 'view/form/formMissao.php';
        break;
    case 'cadMorador':
        include_once 'view/form/formMorador.php';
        break;
    case 'cadReligiao':
        include_once 'view/form/formReligiao.php';
        break;
    case 'cadPesquisa':
        include_once 'view/form/formPesquisa.php';
        break;
    case 'cadAdmin':
        include_once 'view/form/formAdmin.php';
        break;

    // FORM'S
    case 'altCalebe':
        include_once 'view/form_alt/formCalebe.php';
        break;
    case 'altMorador':
        include_once 'view/form_alt/formMorador.php';
        break;
    case 'altEquipe':
        include_once 'view/form_alt/formEquipe.php';
        break;
    case 'altIgreja':
        include_once 'view/form_alt/formIgreja.php';
        break;
    case 'altMissao':
        include_once 'view/form_alt/formMissao.php';
        break;
    case 'altReligiao':
        include_once 'view/form_alt/formReligiao.php';
        break;

    default:
        echo '<script>window.location="index.php";</script>';
        break;
}
?>