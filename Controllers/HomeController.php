<?php
/**
 *  Teste PHP
 *
 *  @author     Guilherme Gaspar <guiigaspar@live.com>
 *  @copyright  2019
 *  @file       HomeController.php
 *  @desc       
 */

namespace Controllers;
use \Core\Controller;

class NotFoundController extends Controller
{
	public function index()
	{
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.BASE_URL.'/jogo/tropa');
	}
}