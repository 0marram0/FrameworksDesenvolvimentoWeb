<?php

class Usuario {

//Attributes
    private $id;
	private $nome;
	private $email;
	private $idade;
	

//Getters & Setters
public function getId(){
    return $this->id;
}

public function setId($id): self {
    $this->id = $id;
    return $this;
}

public function getNome(){
    return $this->nome;
}

public function setNome($nome): self {
    $this->nome = $nome;
    return $this;
}

public function getEmail(){
    return $this->email;
}

public function setEmail($email): self {
    $this->email = $email;
    return $this;
}

public function getIdade(){
    return $this->idade;
}

public function setIdade($idade): self {
    $this->idade = $idade;
    return $this;
}


}