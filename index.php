<?php
/**
 *  Teste PHP
 * 
 *  @author     Guilherme Gaspar <guiigaspar@live.com>
 *  @copyright  2018
 *  @file       index.php
 *  @desc       Arquivo inicial - Registra autoload
 *              e instancia classe core
 */

session_start();
require 'config.php';
require 'vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$core = new Core\Core();
$core->run();
?>