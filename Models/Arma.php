<?php

namespace Models;

use Core\Model;

class Arma extends Model
{
	private $ID;
	private $Nome;
	private $FrocaMin;
	private $ForcaMax;
	private $DestrezaMin;
	private $DestrezaMax;
	private $MagiaMin;
	private $MagiaMax;

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

	public function getForcaMin()
	{
		return $this->FrocaMin;
	}

	public function getForcaMax()
	{
		return $this->ForcaMax;
	}

	public function getDestrezaMin()
	{
		return $this->DestrezaMin;
	}

	public function getDestrezaMax()
	{
		return $this->DestrezaMax;
	}

	public function getMagiaMin()
	{
		return $this->MagiaMin;
	}

	public function getMagiaMax()
	{
		return $this->MagiaMax;
	}

	public function getAll()
	{
		$sql = "SELECT * FROM arma";
		$sql = $this->db->prepare($sql);
		$sql->execute();

		return $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));
	}

	public function getArmaById($id)
	{
		$sql = "SELECT * FROM arma WHERE ID = :armaId";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':armaId', $id);
		$sql->execute();

		return $sql->fetchObject(get_class($this));
	}

}