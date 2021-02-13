<?php
	require_once('views/View.php');

	class ControllerAccueil
	{
		private $_joueurManager;
		private $_view;

		public function __construct($url)
		{
			if(isset($url) && count(array($url))>1)
				throw new Exception('Page introuvable');
			else 
				$this->joueurs();
		}

		private function joueurs()
		{
			$this->_joueurManager = new JoueurManager ;
			$joueurs = $this->_joueurManager->getJoueurs();

			$this->_view = new View('Accueil');
			$this->_view->generate(array('joueurs' => $joueurs));
		}
	}	

?>