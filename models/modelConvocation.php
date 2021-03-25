<?php

require_once("Model.php");

class modelConvocation extends Model
{
	private $_abs;
	public function __construct()
	{
			$bdd=$this->getBdd();
			$bdd=$bdd->query('SELECT j.id as id , nom , prenom , motif ,date as dateAbs FROM joueurs j LEFT JOIN  absences a ON j.id=a.id ');
			$groupement = array() ;
			while($ligne=$bdd->fetch(PDO::FETCH_ASSOC)){
				if(array_key_exists($ligne['id'],$groupement)){
					array_push($groupement[$ligne['id']],array($ligne['nom'],$ligne['prenom'],$ligne['motif'],$ligne['dateAbs']));
				}
				else {
					$groupement[$ligne['id']]= array();
					array_push($groupement[$ligne['id']],array($ligne['nom'],$ligne['prenom'],$ligne['motif'],$ligne['dateAbs']));
				}
			}
			$this->_abs=$groupement;
	}

	public function getAllAbs(){
		return $this->_abs;
	}
}