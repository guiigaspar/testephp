<?php

namespace Models;

use Core\Model;

class PersonagemClasse extends Model
{
	private $ID;
	private $Nome;

	public function __construct()
	{
		parent::__construct();
	}

	public function getID()
	{
		return $this->ID;
	}

	public function getNome()
	{
		return $this->Nome;
	}

	public function setNome($nome)
	{
		$this->Nome = $nome;
	}

	public function getClasseById($id)
	{
		$sql = "SELECT * FROM personagemClasse WHERE ID = :classeId";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':classeId', $id);
		$sql->execute();

		return $sql->fetchObject(get_class($this));
	}

	public function getClasseByName($nome)
	{
		$sql = "SELECT * FROM personagemClasse WHERE Nome = :nome";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':nome', $nome);
		$sql->execute();

		return $sql->fetchObject(get_class($this));
	}

}