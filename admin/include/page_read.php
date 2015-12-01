<?php
$page = (isset($_GET['p'])) ? $_GET['p'] : '';

switch($page){
    // VIEW
    case 'estatisticas':
        include_once 'view/viewEstatisticas.php';
        break;
    case 'calebe':
        include_once 'view/viewCalebe.php';
        break;
    case 'equipe':
        include_once 'view/viewEquipe.php';
        break;
    case 'igreja':
        include_once 'view/viewIgreja.php';
        break;
    case 'lider':
        include_once 'view/viewLider.php';
        break;
    case 'missao':
        include_once 'view/viewMissao.php';
        break;
    case 'morador':
        include_once 'view/viewMorador.php';
        break;
    case 'aux':
        include_once 'view/viewAux.php';
        break;
    case 'admin':
        include_once 'view/viewAdmin.php';
        break;

    default:
        echo '<script>window.location="index.php";</script>';
        break;
}
?>