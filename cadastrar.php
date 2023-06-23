<?php

require __DIR__ . '/vendor/autoload.php';

//definir uma constante
define('TITLE', 'Cadastrar vagas');

use \App\Entity\Vaga;

//instanciando a entity
$obVaga = new Vaga;

//valida o post foi definido
if (isset($_POST['titulo'], $_POST['descricao'], $_POST['status'])) {

    //setando os atributos da entity com os valores do post
    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->status = $_POST['status'];

    $obVaga->cadastrar();


    header('location: index.php?status=success');

    exit;
}

require __DIR__ . '/vendor/autoload.php';

include __DIR__ . '/includes/header.php';

include __DIR__ . '/includes/formulario.php';

include __DIR__ . '/includes/footer.php';
