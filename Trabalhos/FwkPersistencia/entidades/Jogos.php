<?php

#[Tabela(nome: 'jogos')]
class Jogos
{
    #[Coluna]
    public ?int $id = null;

    #[Coluna]
    public string $nome;

    #[Coluna]
    public string $genero;

    #[Coluna]
    public int $ano;

    #[Coluna]
    public float $preco;
}
