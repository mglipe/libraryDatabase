<main>

    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>

    </section>

    <h2 class="mt-3">Excluir item</h2>

    <form method="post">
        <div class="form-group">
            <p>Excluir: <strong><?= $obVaga->titulo ?></strong></p>
        </div>

        <div class="form-group mt-3">
            <button type="submit" name="passaraqui" class="btn btn-danger">excluir</button>
        </div>
        </div>


    </form>

</main>