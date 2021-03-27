<?php

require_once("Model.php");

class modelAccueil extends Model
{
	private $_convocations;

	public function __construct()
	{
			$bdd=$this->getBdd();
			$bdd=$bdd->query("SELECT * FROM Convocations WHERE type='Valider'");
			$this->_convocations= $bdd->fetchAll(PDO::FETCH_ASSOC);
	}

	public function GetConvocations(){
		return $this->_convocations;
	}
}
?>