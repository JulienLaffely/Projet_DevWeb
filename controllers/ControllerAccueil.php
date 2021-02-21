<?php
	require_once('views/View.php');

	class ControllerAccueil
	{
		private $_view;

		public function __construct()
		{
				$this->_view = new View('Accueil');
				$this->_view->generate();
		}

		public function alerteconnexion(){
			echo "<script type='text/javascript'>alert('Veuillez remplir les deux champs !');</script>";
		}

	}	

?>