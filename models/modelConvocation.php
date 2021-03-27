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

	public function SupprimerBrouillon($data)
	{
		$bdd=$this->getBdd();
		$date=$_POST['dateConvoc'];	
		$equipe=$data[5];
		$bdd->query("DELETE FROM Convocations c WHERE c.date='$date' AND c.equipe='$equipe'");
	}

	public function ajoutBrouillon($data)
	{
		$bdd=$this->getBdd();
		$joueurs="";
		for($i=6;$i<sizeof($data);++$i){
			$joueurs.=$data[$i].";";
		}
		$date=$_POST['dateConvoc'];
		$bdd->query("INSERT INTO Convocations VALUES ('$date','$data[0]','$data[5]','$data[1]','$data[2]','$data[3]','$data[4]','$joueurs','Brouillon')");
	}	

	public function getConvocations()
	{
		$bdd=$this->getBdd();
		$bdd = $bdd->query('SELECT date , equipe , joueurs , type FROM Convocations');
		return $bdd->fetchAll(PDO::FETCH_ASSOC);
	}
}