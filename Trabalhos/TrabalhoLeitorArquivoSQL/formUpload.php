<?php

if (isset($_GET["error"])) {
    if ($_GET["error"] == 1) {
        print "Adicione o arquivo corretamente. ";
    } else if ($_GET["error"] == 2) {
        print "O arquivo deve estar no formato '.sql'. ";
    } else if ($_GET["error"] == 3) {
        print "O arquivo não pode exceder 5MB.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Framework Leitor SQL</title>
</head>

<body>

    <form action="fileReader.php" method="post" enctype="multipart/form-data">

        <label>Selecione um arquivo SQL:</label>

        <input type="file" name="file" accept=".sql" required>

        <p class="info">
            Formatos aceitos: .sql<br>
            Tamanho máximo: 5 MB
        </p>

        <button type="submit">Gerar Classes</button>

    </form>

</body>

</html>