<?php

include "classCreator.php";

$file = $_FILES['file'];
$file_tmp = $file['tmp_name'];
$file_size = $file['size'];
$file_name = explode('.', $file['name']);
$extension = strtolower(end($file_name));
echo "<br>";

//Validações
if (!isset($_FILES['file'])) {
    header("location: formUpload.php?error=1");
} else if ($extension != "sql") {
    header("location: formUpload.php?error=2");
} else if ($_FILES['file']['size'] > 5242880) {
    header("location: formUpload.php?error=3");
}

else {
    echo "Extensão: " . $extension;
}

echo "<br>";
echo "Tamanho: " . $file_size . " bytes";
echo "<br>";
echo "Nome do arquivo: " . $file_name[0];
echo "<br>";
move_uploaded_file($file_tmp, $file["name"]);

classCreator($file["name"]);

?>
