<main>

    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>

    </section>

    <h2 class="mt-3"><?= TITLE ?></h2>

    <form method="post">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" id="title" class="form-control" name="titulo" value="<?= $obVaga->titulo ?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea rows="5" id="descricao" class="form-control" name="descricao"><?= $obVaga->descricao ?></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control" for="ativo">
                        <input type="radio" name="status" id="ativo" value="1" checked>Ativo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-control" for="inativo">
                        <input type="radio" name="status" id="inativo" value="0" <?= $obVaga->status == 0 ? 'checked' : '' ?>>Inativo
                    </label>
                </div>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">enviar</button>
            </div>
        </div>


    </form>

</main>