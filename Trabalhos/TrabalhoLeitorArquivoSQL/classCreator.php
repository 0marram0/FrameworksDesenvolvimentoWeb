<?php

include "leitorSQL.php";

function classCreator($receivedFile)

{
    //Cria a pasta caso ainda não exista
    if (is_dir("model") == false) {
        mkdir("model", 0777, true);
    }

    //Cria um objeto da classe LeitorSQL
    $reader = new LeitorSQL($receivedFile);

    //Percorre todas as tabelas encontradas no arquivo SQL
    foreach ($reader->getTabelas() as $table) {

        //Obtém todos os atributos da tabela atual
        $fields = $reader->getAtributos($table);

        //Variáveis que irão armazenar atributos e métodos
        $classAtributtes = "";
        $classMethods = "";

        //Percorre todos os atributos da tabela
        foreach ($fields as $fieldName => $fieldData) {

            //Monta os atributos privados da classe
            $classAtributtes .= "private \$$fieldName;\n\t";

            //Transforma a primeira letra em maiúscula para gerar o nome do método
            $methodName = ucfirst($fieldName);

            //Cria o método GET
            $getter = "public function get{$methodName}(){\n";
            $getter .= "    return \$this->$fieldName;\n";
            $getter .= "}\n\n";

            //Cria o método SET
            $setter = "public function set{$methodName}(\$$fieldName): self {\n";
            $setter .= "    \$this->$fieldName = \$$fieldName;\n";
            $setter .= "    return \$this;\n";
            $setter .= "}\n\n";

            //Junta os métodos na variável
            $classMethods .= $getter . $setter;
        }

        //Define o nome da classe baseado no nome da tabela
        $fileName = ucfirst($table);

        //Monta o conteúdo completo da classe
        $classe = <<<PHP
<?php

class $fileName {

//Attributes
    $classAtributtes

//Getters & Setters
$classMethods
}
PHP;

        //Cria o arquivo dentro da pasta model
        file_put_contents("model/$fileName.php", $classe);
    }
}

