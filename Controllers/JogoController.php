<?php
/**
 *  Teste PHP
 *
 *  @author     Guilherme Gaspar <guiigaspar@live.com>
 *  @copyright  2019
 *  @file       JogoController.php
 *  @desc       Controle do módulo de Jogo
 */

namespace Controllers;

use Core\Controller;
use Models\Personagem;
use Models\PersonagemClasse;
use Models\Arma;
use Models\ArmaLimitacao;

class JogoController extends Controller
{
	public function index()
	{
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.BASE_URL.'/jogo/tropa');
	}

	public function tropa()
	{
		$dados = array(
			'personagemList' => (new Personagem)->getAllPersonagemSoc()
		);

		if(isset($_POST['submit']))
		{
			if(!isset($_POST['tropa']) || count($_POST['tropa']) != 5)
			{
				$dados['errMsg'] = 'Selecione 5 Personagens.';
				$this->loadViewInTemplate('jogo/tropa', $dados);
				exit;
			}

			$hobbitClassId = (new PersonagemClasse)->getClasseByName('Hobbit');

			if(empty($hobbitClassId->getID()))
			{
				$dados['errMsg'] = 'Ocorreu um erro interno. Parece que não há uma classe de personagens hobbit.';
				$this->loadViewInTemplate('jogo/tropa', $dados);
				exit;
			}

			$hobbits = (new Personagem)->getPersonagemByClasseId($hobbitClassId->getID());

			if(count($hobbits) == 0)
			{
				$dados['errMsg'] = 'Ocorreu um erro interno. Parece que não há hobbits cadastrados na base.';
				$this->loadViewInTemplate('jogo/tropa', $dados);
				exit;
			}

			$temHobbit = false;

			foreach($hobbits as $hobbitObj)
			{
				if(in_array($hobbitObj->getID(), $_POST['tropa']))
				{
					$temHobbit = true;
					break;
				}
			}

			if(!$temHobbit)
			{
				$dados['errMsg'] = 'Selecione ao menos 1 Hobbit.';
				$this->loadViewInTemplate('jogo/tropa', $dados);
				exit;
			}

			foreach($_POST['tropa'] as $personagemId)
			{
				$tropaSociedade[] = array(
					'personagemId' => $personagemId
				);
			}

			$_SESSION['tropaSociedade'] = $tropaSociedade;
			$_SESSION['step'] = 'tropa';
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.BASE_URL.'/jogo/armas');
			exit;

		}
		else
		{
			unset($_SESSION['tropaSociedade']);
			unset($_SESSION['tropaOrcs']);
		}

		$this->loadViewInTemplate('jogo/tropa', $dados);
	}

	public function armas()
	{
		//Verificações de Segurança
		if(!isset($_SESSION['tropaSociedade']))
		{
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.BASE_URL.'/jogo/tropa');
			exit;
		}

		$dados = array();

		//Armas foram enviadas
		if(isset($_POST['armas']))
		{
			$tropaSociedade = $_SESSION['tropaSociedade'];

			foreach($_POST['armas'] as $key => $armaId)
				$tropaSociedade[$key]['armaId'] = $armaId;

			$_SESSION['tropaSociedade'] = $tropaSociedade;

			$_SESSION['step'] = 'armas';
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.BASE_URL.'/jogo/reconhecimento');
			exit;
		}

		if(!isset($_SESSION['step']) || $_SESSION['step'] != 'tropa')
		{
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.BASE_URL.'/jogo/tropa');
			exit;
		}

		unset($_SESSION['step']);

		//Manuseio de Personagens
		foreach($_SESSION['tropaSociedade'] as $tropa)
			$dados['personagemList'][] = (new Personagem)->getPersonagemById($tropa['personagemId']);

		//Manuseio de Armas
		$armasDisponiveis = (new Arma)->getAll();

		$sorteiaArmas = array_rand($armasDisponiveis, 5);

		foreach($sorteiaArmas as $armaIndex)
			$dados['armasList'][] = $armasDisponiveis[$armaIndex];

		$this->loadViewInTemplate('jogo/armas', $dados);
	}

	/*
	 * Verifica se a arma é permitada para o personagem pela sua Limitação (se houver)
	*/
	private function verificaLimitacaoArma($armaId, $personagemId)
	{
		if(!is_numeric($armaId) || !is_numeric($personagemId))
			return false;

		$compativel = true;

		//Verifica se a arma possui alguma limitação
		$limitacaoObj = (new ArmaLimitacao)->getLimitacaoByArmaId($armaId);

		//Verifica limitação por Personagem
		if(!empty($limitacaoObj->getPersonagemID()))
		{
			if($limitacaoObj->getPersonagemID() != $personagemId)
				$compativel = false;
		}

		//Verifica limitação por Propriedade
		else if(!empty($limitacaoObj->getPropriedade()))
		{
			$personagemObj = (new Personagem)->getPersonagemById($personagemId);

			//Analisa qual a condição para verificar
			switch($limitacaoObj->getPropriedade())
			{
				case 'Forca':
					$answer = eval('return '.$personagemObj->getForca().' '.$limitacaoObj->getCondicao().';');
					break;

				case 'Destreza':
					$answer = eval('return '.$personagemObj->getDestreza().' '.$limitacaoObj->getCondicao().';');
					break;

				case 'Magia':
					$answer = eval('return '.$personagemObj->getMagia().' '.$limitacaoObj->getCondicao().';');
					break;
			}

			//Verifica condição
			if(!$answer)
				$compativel = false;
		}

		return $compativel;
	}

	public function reconhecimento()
	{
		//Verificações de Segurança
		if(!isset($_SESSION['tropaSociedade']) || !isset($_SESSION['step']) || $_SESSION['step'] != 'armas')
		{
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.BASE_URL.'/jogo/tropa');
			exit;
		}

		//Trata lista de personagens Orcs disponíveis
		$orcsList = (new Personagem)->getAllPersonagemOrc();

		foreach($orcsList as $orcObj)
			$orcsDisponiveis[] = $orcObj->getID();

		//Por padrão, adiciona um Uruk-Hai a tropa de Orcs
		$tropaOrcs[] = array('personagemId' => 11);

		//Escolhe +4 aleatórios para tropa de Orcs
		for($i = 0; $i < 4; $i++)
		{
			//Seleciona um Orc aleatório, verificando se não há 2 'Olho De Sauron'
			do
			{
				$permite = true;

				$sorteia = array_rand($orcsDisponiveis, 1);

				//Corre a lista para verificação
				foreach($tropaOrcs as $item)
				{
					if($item['personagemId'] == 10 && $orcsDisponiveis[$sorteia] == 10)
					{
						$permite = false;
						break;
					}
				}

				if($permite)
					$tropaOrcs[] = array('personagemId' => $orcsDisponiveis[$sorteia]);
			}
			while(!$permite);
		}

		//Trata lista de armas disponíveis
		$armasList = (new Arma)->getAll();

		foreach($armasList as $armaObj)
			$armasDisponiveis[] = $armaObj->getID();

		//Distribui armas para cada personagem da tropa de Orcs
		foreach($tropaOrcs as $key => $tropaArray)
		{
			//Escolhe uma arma, até que a mesma atenda a limitação para o personagem
			do
			{
				$sorteia = array_rand($armasDisponiveis, 1);

				$tropaOrcs[$key]['armaId'] = $armasDisponiveis[$sorteia];
			}
			while(!$this->verificaLimitacaoArma($armasDisponiveis[$sorteia], $tropaArray['personagemId']));
		}

		$_SESSION['tropaOrcs'] = $tropaOrcs;
		$_SESSION['step'] = 'reconhecimento';

		$this->loadViewInTemplate('jogo/reconhecimento', array('tropaOrcsList' => $tropaOrcs));
	}

	public function recuar()
	{
		unset($_SESSION['tropaSociedade']);
		unset($_SESSION['tropaOrcs']);

		$frases = array(
			'Poucas pessoas têm a coragem de ser covardes diante de testemunhas.',
			'Os covardes morrem várias vezes antes da sua morte, mas o homem corajoso experimenta a morte apenas uma vez.',
			'O medo tem alguma utilidade, mas a covardia não.',
			'Pessoas falsas são como cobras. Elas picam e fogem, pois são muito covardes para ficar e nos dar a oportunidade de pisar em suas cabeças!'
		);

		$sorteia = array_rand($frases, 1);

		$this->loadViewInTemplate('jogo/recuar', array('frase' => $frases[$sorteia]));
	}

	public function batalha()
	{
		//Verificações de Segurança
		if(!isset($_SESSION['tropaSociedade']) || !isset($_SESSION['tropaOrcs'])  ||
			!isset($_SESSION['step']) || $_SESSION['step'] != 'reconhecimento')
		{
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.BASE_URL.'/jogo/tropa');
			exit;
		}

		$pontosSociedade = 0;
		$pontosOrcs = 0;

		//Soma pontos - Tropa Sociedade
		foreach($_SESSION['tropaSociedade'] as $itemTropa)
		{
			$personagemObj = (new Personagem)->getPersonagemById($itemTropa['personagemId']);
			$armaObj = (new Arma)->getArmaById($itemTropa['armaId']);

			//Soma pontos do personagem
			$pontosSociedade += $personagemObj->getForca() + $personagemObj->getDestreza() + $personagemObj->getMagia();

			//Verifica se a arma é compatível com o personagem pela sua limitação
			if($this->verificaLimitacaoArma($armaObj->getID(), $personagemObj->getID()))
			{
				$armaForca = rand($armaObj->getForcaMin(), $armaObj->getForcaMax());
				$armaDestreza = rand($armaObj->getDestrezaMin(), $armaObj->getDestrezaMax());
				$armaMagia = rand($armaObj->getMagiaMin(), $armaObj->getMagiaMax());

				//Soma pontos da arma
				$pontosSociedade += $armaForca + $armaDestreza + $armaMagia;
			}
		}

		//Soma pontos - Tropa Orcs
		foreach($_SESSION['tropaOrcs'] as $itemTropa)
		{
			$personagemObj = (new Personagem)->getPersonagemById($itemTropa['personagemId']);
			$armaObj = (new Arma)->getArmaById($itemTropa['armaId']);

			$somaPontos = false;

			/*
			 * Os pontos do Olho De Sauron só serão somados a tropa de orcs se
			 * na tropa da sociedade tiver o Frodo usando o Um Anel como arma
			*/
			//Olho De Sauron - ID 10
			if($personagemObj->getID() == 10)
			{
				foreach($_SESSION['tropaSociedade'] as $itemTropaSoc)
				{
					//Frodo - ID 1 / Um Anel - ID 10
					if($itemTropaSoc['personagemId'] == 1 && $itemTropaSoc['armaId'] == 10)
					{
						$somaPontos = true;
						break;
					}
				}
			}
			else
				$somaPontos = true;

			//Se permitido, soma pontos do personagem
			if($somaPontos)
				$pontosOrcs += $personagemObj->getForca() + $personagemObj->getDestreza() + $personagemObj->getMagia();

			//Verifica se a arma é compatível com o personagem pela sua limitação
			if($this->verificaLimitacaoArma($armaObj->getID(), $personagemObj->getID()))
			{
				$armaForca = rand($armaObj->getForcaMin(), $armaObj->getForcaMax());
				$armaDestreza = rand($armaObj->getDestrezaMin(), $armaObj->getDestrezaMax());
				$armaMagia = rand($armaObj->getMagiaMin(), $armaObj->getMagiaMax());

				//Soma pontos da arma
				$pontosOrcs += $armaForca + $armaDestreza + $armaMagia;
			}
		}
		
		//echo 'Pontos Sociedade: '.$pontosSociedade.'<br>';
		//echo 'Pontos Orcs: '.$pontosOrcs;

		if($pontosSociedade > $pontosOrcs)
		{
			$titulo = 'Vitória';
			$classe = 'alert-success';
			$texto = 'A tropa de Mordor foi massacrada como vermes que são!';
		}
		else if($pontosSociedade == $pontosOrcs)
		{
			$titulo = 'Empate';
			$classe = 'alert-warning';
			$texto = 'Empate !';
		}
		else
		{
			$titulo = 'Derrota';
			$classe = 'alert-danger';
			$texto = 'Essa sociedade é uma vergonha, a Terra Médias está perdida!';
		}

		$dados = array(
			'titulo' => $titulo,
			'classe' => $classe,
			'texto' => $texto
		);

		unset($_SESSION['tropaSociedade']);
		unset($_SESSION['tropaOrcs']);
		unset($_SESSION['step']);

		$this->loadViewInTemplate('jogo/batalha', $dados);
	}
}