<h1>Atualizar Curso</h1>

<?php if (hasFlash('sucesso')) : ?>
    <div class="alert alert-success" role="alert">
        <?= flash('sucesso') ?>
    </div>
<?php endif; ?>

<?php if (hasFlash('error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= flash('error') ?>
    </div>
<?php endif; ?>

<form class="mt-4" action="<?= route('curso.edit', '?id=' . $curso->id) ?>" method="POST">
    <input type="hidden" name="id" value="<?= $curso->id ?>">
    <div class="row mb-3">
        <div class="col-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control <?= hasFlash('nome') ? 'is-invalid' : '' ?>" value="<?= old("nome") ?? $curso->nome ?>" id="nome" name="nome">
            <div class="invalid-feedback">
                <?= flash('nome') ?>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>