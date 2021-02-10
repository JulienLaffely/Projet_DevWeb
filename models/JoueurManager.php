<?php
	class JoueurManager extends Model 
	{
		public function getJoueurs()
		{
			$this->getBdd();
			return $this->getAll('joueurs',"Joueur");
		}
	}
?>