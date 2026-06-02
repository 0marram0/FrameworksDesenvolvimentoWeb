<?php

class Produto {

//Attributes
    private $id;
	private $descricao;
	private $preco;
	

//Getters & Setters
public function getId(){
    return $this->id;
}

public function setId($id): self {
    $this->id = $id;
    return $this;
}

public function getDescricao(){
    return $this->descricao;
}

public function setDescricao($descricao): self {
    $this->descricao = $descricao;
    return $this;
}

public function getPreco(){
    return $this->preco;
}

public function setPreco($preco): self {
    $this->preco = $preco;
    return $this;
}


}