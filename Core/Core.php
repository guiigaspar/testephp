<?php
/**
 *  Teste PHP
 *
 *  @author     Guilherme Gaspar <guiigaspar@live.com>
 *  @copyright  2019
 *  @file       Core.php
 *  @desc       Classe Core
 */

namespace Core;

class Core
{
	public function run()
	{   
		$url = explode("index.php", $_SERVER['PHP_SELF']);
		$url = end($url);
		
		$params = array();
		
		if(!empty($url))
		{
			$url = explode('/', $url);
			array_shift($url);
			
			$currentController = $url[0].'Controller';
			array_shift($url);
			if(isset($url[0]))
			{
				$currentAction = $url[0];
				array_shift($url);
			}
			else
				$currentAction = 'index';
			
			if(count($url) > 0)
				$params = $url;
						
		} else{
			
			$currentController = 'HomeController';
			$currentAction = 'index';
		}
		
		$currentController = ucfirst($currentController);
		$prefix = "\Controllers\\";
		

		if(!file_exists('Controllers/'.$currentController.'.php') || !method_exists($prefix.$currentController, $currentAction))
		{
			$currentController = 'NotFoundController';
			$currentAction = 'index';
		}

		$newController = $prefix.$currentController;
		
		$c = new $newController();
		call_user_func_array(array($c , $currentAction), $params);
	}
}
?>