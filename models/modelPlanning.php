<?php

require_once("Model.php");
	
class modelPlanning extends Model
{

	public $_joueurs;

	public function __construct()
	{
		$bdd=$this->getBdd();
		$this->_joueurs=$bdd->query('SELECT id, nom , prenom FROM joueurs');
	}

	public function GetAbsJoueur($id,$date) {
		$bdd=$this->getBdd();
		$return = $bdd->query("SELECT a.date , a.motif FROM abscences a WHERE a.id='$id' AND a.date='$date'");
		return $return;
	}

	public function GetAllAbs(){
		$bdd=$this->getBdd();
		$query=$bdd->query("SELECT a.id , a.date , a.motif FROM abscences a");
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function actualisationBDD($typedactu,$motif,$id){

	}
}

?>