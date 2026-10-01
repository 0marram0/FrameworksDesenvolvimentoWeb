<?php

require_once('atributos/Tabela.php');
require_once('atributos/Coluna.php');
require_once('entidades/Jogos.php');
require_once('framework/fwkPersist.php');

$pdo = new PDO(
    "mysql:host=localhost;dbname=sistema_jogos;charset=utf8mb4",
    "root",
    ""
);

$fwk = new fwkPersist($pdo);

$jogo = new Jogos();

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $jogoEncontrado = $fwk->findByID(Jogos::class, $id);

    if ($jogoEncontrado) {
        $jogo = $jogoEncontrado;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $jogo->nome = $_POST['nome'];
    $jogo->genero = $_POST['genero'];
    $jogo->ano = (int) $_POST['ano'];
    $jogo->preco = (float) $_POST['preco'];

    if (!empty($jogo->id)) {

        $fwk->update($jogo);
    } else {

        $fwk->save($jogo);
    }

    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>
        <?= $jogo->id ? 'Editar Jogo' : 'Cadastrar Jogo' ?>
    </title>
</head>

<body>

    <h1>
        <?= $jogo->id ? 'Editar Jogo' : 'Cadastrar Jogo' ?>
    </h1>

    <form method="POST">

        <label>
            Nome:
        </label>

        <br>

        <input
            type="text"
            name="nome"
            value="<?= htmlspecialchars($jogo->nome ?? '') ?>"
            required>

        <br><br>


        <label>
            Gênero:
        </label>

        <br>

        <input
            type="text"
            name="genero"
            value="<?= htmlspecialchars($jogo->genero ?? '') ?>"
            required>

        <br><br>


        <label>
            Ano:
        </label>

        <br>

        <input
            type="number"
            name="ano"
            value="<?= $jogo->ano ?? '' ?>"
            required>

        <br><br>


        <label>
            Preço:
        </label>

        <br>

        <input
            type="number"
            name="preco"
            step="0.01"
            value="<?= $jogo->preco ?? '' ?>"
            required>

        <br><br>

        <button type="submit">
            <?= $jogo->id ? 'Alterar Jogo' : 'Cadastrar Jogo' ?>
        </button>

    </form>

    <br>

    <a href="index.php">
        Voltar para lista
    </a>

</body>

</html>