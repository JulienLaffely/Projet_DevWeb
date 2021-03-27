<?php

require_once("Model.php");
	
class modelEffectif extends Model
{
	private $_joueurs;
	public function __construct()
	{
		
	}

	public function getAllJoueurs(){
		$bdd=$this->getBdd();
		return $bdd->query("SELECT nom , prenom , DATE_FORMAT(ddn,'%d-%m-%Y') FROM joueurs");
	}

	public function AjoutJoueurBDD()
	{
		$nom=$_POST['NomNewJoueur'];
		$prenom=$_POST['PrenomNewJoueur'];
		$ddn=$_POST['DdnNewJoueur'];
		if($nom==""||$prenom==""||$ddn==""){
			echo "<script>alert('Le nouveau joueur doit avoir un nom , un prenom et une date de naissance !')</script>";
		}
		else {
			$bdd=$this->getBdd();
			$query= $bdd->query("SELECT count(*) AS total FROM joueurs WHERE nom='$nom' AND prenom='$prenom' AND ddn='$ddn'");
			$query = $query->fetchAll(PDO::FETCH_ASSOC);
			if($query[0]['total']==0){
				$query = $bdd->query("SELECT count(*) AS IDS FROM joueurs");
				$query = $query->fetchAll(PDO::FETCH_ASSOC);
				$id=((int)($query[0]['IDS']))+1;
				$bdd->query("INSERT INTO joueurs VALUES ($id,'$nom','$prenom','$ddn')");
			}
			else{
				echo "<script>alert('Attention ! Joueur déja enregistrer dans le club !')</script>";
			}
		}
	}

}
?>