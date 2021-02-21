<?php
	require_once('views/View.php');
	require_once('models/modelConnexion.php');

	class ControllerConnexion
	{
		private $_view;
		private $_model;

		public function __construct($log,$mdp)
		{
				$this->_model = new modelConnexion($log,$mdp);
				if($this->_model->connexionAutoriser()){
					$this->_view = new View('Connexion');
					$this->_view->generate();
				}
				else{
					$this->alerteconnexion();
					$this->_view = new View('Accueil');
					$this->_view->generate();
				}
		}

		public function alerteconnexion(){
			echo "<script type='text/javascript'>alert('Identifiant ou mot de passe incorrect !');</script>";
		}

	}	

?>