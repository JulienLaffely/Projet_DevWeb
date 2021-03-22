<?php

require_once("Model.php");
	
class modelEffectif extends Model
{
	private $_joueurs;
	public function __construct()
	{
		$bdd=$this->getBdd();
		$this->_joueurs=$bdd->query('SELECT nom , prenom FROM joueurs');
	}

	public function getAllJoueurs(){
		return $this->_joueurs;
	}

	public function ActualisationBDD()
	{
		
	}

}
?>