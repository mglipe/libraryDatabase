<?php

$mensagem = '';

if (isset($_GET['status'])) {

    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="alert alert-success" role="alert">success!</div>';
            break;
        case 'error':
            $mensagem = '<div class="alert alert-danger" role="alert">error!</div>';
            break;
    }
}

$result = '';

foreach ($vagas as $vaga) {


    $result .= '<tr>
                <td>' . $vaga->id . '</td>
                <td>' . $vaga->titulo . '</td>
                <td>' . $vaga->descricao . '</td>
                <td>' . ($vaga->status == 1 ? 'ativo' : 'inativo') . '</td>
                <td>' . date('d/m/Y à\s H:i:s,', strtotime($vaga->data)) . '</td>
                <td>
                    <a href="editar.php?id=' . $vaga->id . '">
                        <button type="button" class="btn btn-primary">Editar</button>
                    </a>
                </td>
                <td>
                <a class="btn-delete" href="excluir.php?id=' . $vaga->id . '">
                    <button type="button" class="btn btn-danger">Deletar</button>
                </a>
            </td>
            </tr>';
}
?>

<main>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova vaga</button>
        </a>

    </section>

    <section>
        <?= $mensagem ?>
    </section>

    <section class=" mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Status</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
                <?= $result ?>
            </tbody>

        </table>
    </section>

</main>