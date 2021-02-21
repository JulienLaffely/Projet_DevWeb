<?php

require_once("Model.php");
	
class modelConnexion extends Model
{
	private $_log;
	private $_mdp;

	public function __construct($log,$mdp)
	{
				$this->_log=$log;
				$this->_mdp=$mdp;
	}

	public function connexionAutoriser() : bool{
		$bdd=$this->getBdd();
		$compte=$bdd->query('SELECT * FROM authentification');
		foreach ($compte as $ligne) {
			if(($ligne["login"]==$this->_log)&&($ligne["mdp"]==$this->_mdp)) return true;
		}
		return false ;
	}
}

?>