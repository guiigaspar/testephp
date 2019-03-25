<?php
/**
 *  Teste PHP
 * 
 *  @author     Guilherme Gaspar <guiigaspar@live.com>
 *  @copyright  2019
 *  @file       config.php
 *  @desc       Arquivo de configuração do Banco de Dados
 */

require 'environment.php';
global $config;
$config = array();

if(ENVIRONMENT == 'develop')
{
    // Developer/Debug Config
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    define("BASE_URL", "http://localhost/testephp");
    define("PROJECT_TITLE", "Teste PHP - Batalha da Sociedade Do Anel");

    $config['mysql']['host'] = 'localhost';
    $config['mysql']['port'] = '3389';
    $config['mysql']['dbuser'] = 'root';
    $config['mysql']['dbpass'] = '';
    $config['mysql']['database'] = 'jogo';
    
}
else if(ENVIRONMENT == 'production')
{
    // Production Config
    
    define("BASE_URL", "");
    define("PROJECT_TITLE", "");
    
    $config['sqlserver']['host'] = '';
    $config['sqlserver']['dbuser'] = '';
    $config['sqlserver']['dbpass'] = '';
    $config['sqlserver']['database'] = '';
    
    $config['mysql']['host'] = '';
    $config['mysql']['dbuser'] = '';
    $config['mysql']['dbpass'] = '';
    $config['mysql']['database'] = '';
}