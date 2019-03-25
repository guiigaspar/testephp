<?php
/**
 *  Teste PHP
 *
 *  @author     Guilherme Gaspar <guiigaspar@live.com>
 *  @copyright  2019
 *  @file       Controller.php
 *  @desc       Classe Controller - Manuseio de informações
 *              e lógica da página
 */

namespace Core;

class Controller
{
	public function loadView($viewName, $viewData = array())
	{
		extract($viewData);
		include 'Views/'.$viewName.'.php';
	}
	
	public function loadViewInTemplate($viewName, $viewData = array())
	{
	    include 'Views/template.php';
	}
}
