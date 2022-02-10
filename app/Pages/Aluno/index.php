<h1>Lista de alunos</h1>

<?php if (hasFlash('sucesso')) : ?>
    <div class="alert alert-success" role="alert">
        <?= flash('sucesso') ?>
    </div>
<?php endif; ?>

<table class="table mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
            <th scope="col">Valor Mensal</th>
            <th scope="col">Situação</th>
            <th scope="col">Observacao</th>
            <th scope="col">Curso</th>
            <th scope="col">Ver</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alunos as $aluno) : ?>
            <tr>
                <th><?= $aluno->id ?></th>
                <td><?= $aluno->email ?></td>
                <td><?= telefone($aluno->telefone) ?></td>
                <td>R$ <?= money($aluno->valor_mensalidade) ?></td>
                <td><?= $aluno->situacao ?></td>
                <td><?= $aluno->observacao ?></td>
                <td><?= $aluno->curso()->nome ?></td>
                <td>
                    <a href="<?= route('show', "?id=" . $aluno->id) ?>" class="btn btn-secondary">Ver</a>
                </td>
                <td>
                    <a href="<?= route('update', "?id=" . $aluno->id) ?>" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="<?= route('index'); ?>" method="post">
                        <input type="hidden" name="flag" value="delete">
                        <input type="hidden" name="id" value="<?= $aluno->id ?>">
                        <input type="submit" value="Excluir" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($alunos) == 0) : ?>
            <tr>
                <td colspan="10" class="text-center">Nenhum aluno cadastrado!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>