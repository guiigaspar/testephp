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
    
    define("BASE_URL", "http://localhost:8888/testephp");
    define("PROJECT_TITLE", "Teste PHP - Batalha da Sociedade Do Anel");

    $config['mysql']['host'] = 'localhost';
    $config['mysql']['port'] = '8889';
    $config['mysql']['dbuser'] = 'gaspar';
    $config['mysql']['dbpass'] = '123456';
    $config['mysql']['database'] = 'jogo';
    
}
else if(ENVIRONMENT == 'production')
{
    // Production Config
    
    define("BASE_URL", "");
    
    $config['sqlserver']['host'] = '';
    $config['sqlserver']['dbuser'] = '';
    $config['sqlserver']['dbpass'] = '';
    $config['sqlserver']['database'] = '';
    
    $config['mysql']['host'] = '';
    $config['mysql']['dbuser'] = '';
    $config['mysql']['dbpass'] = '';
    $config['mysql']['database'] = '';
}