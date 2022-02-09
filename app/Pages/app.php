<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Davos Tech</title>
</head>

<body>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center">
                <ul class="nav justify-content-center">
                    <li><a href="/davos-tech" class="nav-link px-2 <?= !$_GET ? 'text-white' : 'text-secondary' ?>">Início</a></li>
                    <li><a href="/davos-tech/create" class="nav-link px-2 <?= $_GET ? ($_GET['url'] == 'create' ? 'text-white' : 'text-secondary') : 'text-secondary' ?>">Cadastrar</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main class="container mt-4">
        <?= routerView($_GET); ?>
    </main>
</body>

</html>