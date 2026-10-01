<?php
class fwkPersist {
    public function __construct(private PDO $pdo){}

    function listAll(string $classe): array
    {
        $tabela = $this -> getNomeTabela($classe);
        $sql    = "SELECT * FROM {$tabela}";
        $stmt   = $this -> pdo -> query($sql);
        return $stmt -> fetchAll(PDO::FETCH_CLASS, $classe);
    }

    function save(object $objeto): void
    {
        $tabela         = $this->getNomeTabela($objeto);
        $dados          = $this->getDadosColunas($objeto);
        $dadosFiltrados = array_filter($dados, fn($valor) => $valor !== null);
        $colunas        = array_keys($dadosFiltrados);
        $stringColunas  = implode(', ', $colunas);
        $placeholders   = ':' . implode(' , :', $colunas);
        $sql            = "INSERT INTO {$tabela} ({$stringColunas}) VALUES ({$placeholders})";
        $stmt           = $this->pdo->prepare($sql);
        $stmt->execute($dadosFiltrados);
    }

    function update(object $objeto) {
        $tabela = $this->getNomeTabela($objeto);
        $dados = $this->getDadosColunas($objeto);
        $id = $dados['id'];
        unset($dados['id']);
        $colunas = array_keys($dados);
        $comando = "";

        for ($i = 0; $i < count($colunas); $i++) {
            $comando .= $colunas[$i] . " = :" . $colunas[$i] . ", ";
        }

        $comando = rtrim($comando, ", ");
        $sql = "UPDATE {$tabela} SET {$comando} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);

        foreach ($dados as $coluna => $valor) {
            $stmt->bindValue(':' . $coluna, $valor);
        }

        $stmt->execute();
    }

    function delete(string $classe, int $id) { 
        $tabela = $this->getNomeTabela($classe);
        $sql = "DELETE FROM {$tabela} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    function findByID(string $classe, int $id) {
        $tabela = $this->getNomeTabela($classe);
        $sql = "SELECT * FROM {$tabela} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, $classe);
        return $stmt->fetch();
    }

    function getNomeTabela(object|string $objectOuString): string
    {
        $espelho        = new ReflectionClass($objectOuString);
        $etiquetas      = $espelho -> getAttributes(Tabela::class);
        $etiquetaTabela = $etiquetas[0] -> newInstance();
        return $etiquetaTabela -> nome;
    }

    function getDadosColunas(object $objeto): array 
    {
        $espelho = new ReflectionClass($objeto);
        $dados   = [];
        foreach ($espelho -> getProperties() as $propriedade) {
            $etiquetas = $propriedade -> getAttributes(Coluna::class);
            if (empty($etiquetas)) {
                continue;
            }
            $nomeColuna         = $propriedade -> getName();
            $valor              = $propriedade -> getValue($objeto);
            $dados[$nomeColuna] = $valor;
        }
        return $dados;
    }
}

