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


if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $fwk->delete(Jogos::class, $id);
}


header('Location: index.php');
exit;
