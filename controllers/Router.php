<?php
require_once('views/View.php');

class Router
{
	private $_ctrl;
	private $_view ;

	public function routeReq()
	{
		try
		{
			// Le routeur est inclus selon l'action de l'utilisateur
			if(isset($_POST['log'])){
				if(!empty($_POST['login'])&&!empty($_POST['pswd']))
				{

					$controller = "Connexion";
					$controllerClass = "Controller".$controller;
					$controllerFile = "controllers/".$controllerClass.".php";

					if(file_exists($controllerFile))
					{
						require_once($controllerFile);
						$this->_ctrl = new $controllerClass($_POST['login'],$_POST['pswd']);
					}
					else 
						throw new Exception('Page introuvable');
				}
				else {
					require_once('controllers/ControllerAccueil.php');
					$this->_ctrl = new ControllerAccueil();
					$this->_ctrl->alerteconnexion();
				}
			}
			else
			{
				require_once('controllers/ControllerAccueil.php');
				$this->_ctrl = new ControllerAccueil();
			}
		}
		// Gestion des ereurs
		catch(Exception $e)
		{
			$errorMsg = $e->getMessage();
			require_once('views/viewError.php');
			$this->_view = new View('Error');
			$this->_view->generate(array('errorMsg' => $errorMsg));
		}
	}
}

?>