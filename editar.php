<?php

//defino uma constante
define('TITLE', 'Editar vaga');

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Vaga;

if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}


//consulta vaga
$obVaga = Vaga::getVaga($_GET['id']);


//validação da vaga
if (!$obVaga instanceof Vaga) {
    header('location: index.php?status=error');
}


//valida o post foi definido
if (isset($_POST['titulo'], $_POST['descricao'], $_POST['status'])) {

    //instanciando a entity
    $obVaga = new Vaga;

    //setando os atributos da entity com os valores do post
    $obVaga->id = $_GET['id'];
    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->status = $_POST['status'];

    $obVaga->atualizar();

    header('location: index.php?status=success');

    exit;
}

require __DIR__ . '/vendor/autoload.php';

include __DIR__ . '/includes/header.php';

include __DIR__ . '/includes/formulario.php';

include __DIR__ . '/includes/footer.php';
