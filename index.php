<?php
/**
 *  Teste PHP
 * 
 *  @author     Guilherme Gaspar <guiigaspar@live.com>
 *  @copyright  2019
 *  @file       index.php
 *  @desc       Arquivo inicial - Registra autoload
 *              e instancia classe core
 */

session_start();
require 'config.php';
require 'vendor/autoload.php';

$core = new Core\Core();
$core->run();
?>