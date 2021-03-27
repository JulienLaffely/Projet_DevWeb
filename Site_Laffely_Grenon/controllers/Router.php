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
			if(isset($_POST['Brouillon'])||isset($_POST['ConvocVal']) ||isset($_POST['Supp'])){
				require_once('controllers/ControllerConvocation.php');
				$this->_ctrl = new ControllerConvocation();
			}
			else if(isset($_POST['Delete'])||isset($_POST['MajCSV'])||isset($_POST['AjoutMatch'])){
				require_once('controllers/ControllerCalendrier.php');
				$this->_ctrl = new ControllerCalendrier();
			}
			else if(isset($_POST['NewJoueur'])){
				require_once('controllers/ControllerEffectif.php');
				$this->_ctrl = new ControllerEffectif();
			}	
			else if(isset($_POST['modifabs'])){
				require_once('controllers/ControllerPlanning.php');
				$this->_ctrl = new ControllerPlanning();
			}
			else if(isset($_POST['onglet'])){
				switch($_POST['onglet']){
					case "Calendrier" :
						require_once('controllers/ControllerCalendrier.php');
						$this->_ctrl = new ControllerCalendrier();
						break;
					case "Planning Absences" :
						require_once('controllers/ControllerPlanning.php');
						$this->_ctrl = new ControllerPlanning();
					break;
					case "Convocation" :
						require_once('controllers/ControllerConvocation.php');
						$this->_ctrl = new ControllerConvocation();
					break;
					case "Accueil" :
						require_once('controllers/ControllerAccueil.php');
						$this->_ctrl = new ControllerAccueil();
					break;
					case "Effectif" :
						require_once('controllers/ControllerEffectif.php');
						$this->_ctrl = new ControllerEffectif();
					break;
				}
			}
			else if(isset($_POST['log'])){
				if(!empty($_POST['login'])&&!empty($_POST['pswd']))
				{

					$controller = "Connexion";
					$controllerClass = "Controller".$controller;
					$controllerFile = "controllers/".$controllerClass.".php";

					if(file_exists($controllerFile))
					{
						require_once($controllerFile);
						$this->_ctrl = new $controllerClass($_POST['login'],$_POST['pswd']);
						if($this->_ctrl->connexionreussi()==false){
							require_once('controllers/ControllerAccueil.php');
							$this->_ctrl = new ControllerAccueil();
						}
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