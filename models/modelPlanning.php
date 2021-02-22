<?php

require_once("Model.php");
	
class modelPlanning extends Model
{

	public $_joueurs;

	public function __construct()
	{
		$bdd=$this->getBdd();
		$this->_joueurs=$bdd->query('SELECT * FROM joueurs');
	}
}

?>