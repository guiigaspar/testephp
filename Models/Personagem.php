<?php

namespace Models;

use Core\Model;

class Personagem extends Model
{
	private $ID;
	private $Nome;
	private $ClasseID;
	private $Forca;
	private $Destreza;
	private $Magia;
	private $Tropa;

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

	public function getClasseID()
	{
		return $this->ClasseID;
	}

	public function getForca()
	{
		return $this->Forca;
	}

	public function getDestreza()
	{
		return $this->Destreza;
	}

	public function getMagia()
	{
		return $this->Magia;
	}

	public function getTropa()
	{
		return $this->Tropa;
	}

	public function setNome($nome)
	{
		$this->Nome = $nome;
	}

	public function setClasseID($classeId)
	{
		if(is_numeric($classeId))
			$this->ClasseID = $classeId;
	}

	public function setForca($forca)
	{
		if(is_numeric($forca))
			$this->Forca = $forca;
	}

	public function setDestreza($desteza)
	{
		if(is_numeric($desteza))
			$this->Destreza = $desteza;
	}

	public function setMagia($magia)
	{
		if(is_numeric($magia))
			$this->Magia = $magia;
	}

	public function setTropa($tropa)
	{
		$this->Tropa = $tropa;
	}

	public function getPersonagemById($id)
	{
		$sql = "SELECT * FROM personagem WHERE ID = :personagemId";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':personagemId', $id);
		$sql->execute();

		return $sql->fetchObject(get_class($this));
	}

	public function getPersonagemByClasseId($id)
	{
		$sql = "SELECT * FROM personagem WHERE ClasseID = :classeId";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':classeId', $id);
		$sql->execute();

		return $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));
	}

	public function getAllPersonagemSoc()
	{
		$sql = "SELECT * FROM personagem WHERE Tropa = 'Sociedade'";
		$sql = $this->db->prepare($sql);
		$sql->execute();

		return $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));
	}

	public function getAllPersonagemOrc()
	{
		$sql = "SELECT * FROM personagem WHERE Tropa = 'Orcs'";
		$sql = $this->db->prepare($sql);
		$sql->execute();

		return $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));
	}
}