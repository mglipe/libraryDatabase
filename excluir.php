<?php


require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Vaga;

//instancio o objeto vaga
$obVaga = new Vaga;

if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

//pegando o id da vaga
$obVaga = Vaga::getVaga($_GET['id']);


if (!$obVaga instanceof Vaga) {
    header('location: index.php?status=error');
    exit;
}
//outra forma de pegar o id
//$obVaga->id = $_GET['id'];
if (isset($_POST['passaraqui'])) {
    $obVaga->excluir();

    header('location: index.php?status=success');
}



include __DIR__ . '/includes/header.php';

include __DIR__ . '/includes/confirmacaoDelete.php';

include __DIR__ . '/includes/footer.php';
