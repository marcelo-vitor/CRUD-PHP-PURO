<h1>Dados:</h1>

<hr>

<div class="container">
    <p>Email: <b><?= $curso->nome ?></b></p>

    <?php if (count($curso->alunos()) != 0) : ?>
        <hr>
        <h3>Alunos:</h3>
    <?php endif; ?>
    <ul>
        <?php foreach ($curso->alunos() as $alunos) : ?>
            <li><?= $alunos->email ?></li>
        <?php endforeach; ?>
    </ul>
</div>