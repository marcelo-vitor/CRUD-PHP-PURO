<h1>Lista de cursos</h1>

<?php if (hasFlash('sucesso')) : ?>
    <div class="alert alert-success" role="alert">
        <?= flash('sucesso') ?>
    </div>
<?php endif; ?>

<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cursos as $curso) : ?>
            <tr>
                <th><?= $curso->id ?></th>
                <th><?= $curso->nome ?></th>
                <td>
                    <a href="<?= route('curso.show', "?id=" . $curso->id) ?>" class="btn btn-secondary">Ver</a>
                </td>
                <td>
                    <a href="<?= route('curso.update', "?id=" . $curso->id) ?>" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="<?= route('curso.index'); ?>" method="post">
                        <input type="hidden" name="flag" value="delete">
                        <input type="hidden" name="id" value="<?= $curso->id ?>">
                        <input type="submit" value="Excluir" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($cursos) == 0) : ?>
            <tr>
                <td colspan="10" class="text-center">Nenhum curso cadastrado!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>