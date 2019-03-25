<?php
/**
 *  Teste PHP
 *
 *  @author     Guilherme Gaspar <guiigaspar@live.com>
 *  @copyright  2019
 *  @file       Controller.php
 *  @desc       Classe Model - Controle de conexão
 *              com banco de dados
 */

namespace Core;

class Model
{
    protected $db;

    public function __construct()
    {
    	global $config;

		try
		{
			$this->db = new \PDO("mysql:host=".$config['mysql']['host'].";dbname=".$config['mysql']['database'].";", $config['mysql']['dbuser'] , $config['mysql']['dbpass']);
		}
		catch(PDOException $e)
		{
			echo 'PDO Exception: '.$e->getMessage();
			exit;
		}
    }
}