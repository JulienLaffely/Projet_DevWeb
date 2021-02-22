<?php
	require_once('views/View.php');
	require_once('models/modelPlanning.php');

	class ControllerPlanning
	{
		public $_view;
		public $_model ;

		public function __construct()
		{	
					$this->_model = new modelPlanning();
					$this->_view = new View('Planning');
					$this->_view->generate();
		}

		public function afficheJoueurs(){
			echo "<table>";
			foreach ($this->_model->_joueurs as $joueur) {
				echo "<tr><td>".$joueur['nom']."</td></tr>";
			}
		}
	}