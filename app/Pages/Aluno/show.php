<h1>Dados:</h1>

<hr>

<div class="container">
    <p>Email: <b><?= $aluno->email ?></b></p>
    <p>Telefone: <b><?= telefone($aluno->telefone) ?></b></p>
    <p>Valor Mensal: <b>R$ <?= money($aluno->valor_mensalidade) ?></b></p>
    <p>Situação: <b><?= $aluno->situacao ?></b></p>
    <p>Observação: <b><?= $aluno->observacao ?></b></p>
</div>