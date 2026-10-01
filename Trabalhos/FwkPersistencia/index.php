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

$jogos = $fwk->listAll(Jogos::class);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Jogos</title>
</head>

<body>

    <h1>Lista de Jogos</h1>

    <a href="formulario.php">Cadastrar novo jogo</a>

    <br><br>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Ano</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($jogos as $jogo): ?>

            <tr>

                <td>
                    <?= $jogo->id ?>
                </td>

                <td>
                    <?= $jogo->nome ?>
                </td>

                <td>
                    <?= $jogo->genero ?>
                </td>

                <td>
                    <?= $jogo->ano ?>
                </td>

                <td>
                    R$ <?= number_format($jogo->preco, 2, ',', '.') ?>
                </td>

                <td>

                    <a href="formulario.php?id=<?= $jogo->id ?>">
                        Editar
                    </a>

                    |

                    <a href="excluir.php?id=<?= $jogo->id ?>">
                        Excluir
                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>