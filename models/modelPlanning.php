<?php

require_once("Model.php");
	
class modelPlanning extends Model
{

	private $_joueurs;

	public function __construct()
	{
		$bdd=$this->getBdd();
		$this->_joueurs=$bdd->query('SELECT id, nom , prenom FROM joueurs');
	}

	public function Joueurs(){
		return $this->_joueurs;
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

	public function actualisationBDD(){
		$index=1;
		$indexid=(string)$index;
		$bdd=$this->getBdd();
		$datemodif=$_POST['calendrier'];
		$query=$bdd->query("SELECT a.id , a.date , a.motif FROM abscences a WHERE a.date='$datemodif'");
		while(isset($_POST[$indexid])){
			$query=$bdd->query("SELECT a.id , a.date , a.motif FROM abscences a WHERE a.date='$datemodif' AND a.id=$index");
			$query=$query->fetchAll(PDO::FETCH_ASSOC);
			if(count($query)!=0){
					if($query[0]['motif']!=$_POST[$indexid] && $_POST[$indexid]!='present'){
						$bdd->query("UPDATE abscences SET motif='$_POST[$indexid]'WHERE a.date='$datemodif' AND a.id=$index");	
					}
					else if ($_POST[$indexid]=='present'){
						$bdd->query("DELETE FROM abscences a WHERE a.date='$datemodif' AND a.id=$index");
					}
			}
			else if($_POST[$indexid]!='present'){
				$bdd->query("INSERT INTO abscences VALUES ($index,'$_POST[$indexid]','$datemodif')");
			}
			++$index ;
			$indexid=(string)$index;
		}
	}
}

?>