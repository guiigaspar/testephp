<?php

namespace Models;

use Core\Model;

class ArmaLimitacao extends Model
{
	private $ID;
	private $ArmaID;
	private $Propriedade;
	private $Condicao;
	private $PersonagemID;

	public function __construct()
	{
		parent::__construct();
	}

	public function getID()
	{
		return $this->ID;
	}

	public function getArmaID()
	{
		return $this->ArmaID;
	}

	public function getPropriedade()
	{
		return $this->Propriedade;
	}

	public function getCondicao()
	{
		return $this->Condicao;
	}

	public function getPersonagemID()
	{
		return $this->PersonagemID;
	}

	public function getLimitacaoByArmaId($armaId)
	{
		$sql = "SELECT * FROM armaLimitacao WHERE ArmaID = :armaId";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':armaId', $armaId);
		$sql->execute();

		return $sql->fetchObject(get_class($this));
	}

}