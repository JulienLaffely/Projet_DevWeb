<?php

abstract class Model
{
	private static $_bdd;

	// Instancie la connexion à la bdd
	private static function setBdd()
	{
		$identifiants = explode("\n",file_get_contents("identifiants.txt"));
		$root="";
		$mdp="";
		for( $i = 0 ; $i<strlen(substr($identifiants[0], 15))-2;++$i){
			$root.=$identifiants[0][$i+15];
		}
		for( $i = 0 ; $i<strlen(substr($identifiants[1], 7))-2;++$i){
			$mdp.=$identifiants[1][$i+7];
		}
		self::$_bdd = new PDO('mysql:host=localhost;dbname=Club;charset=utf8',$root,$mdp);
		self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}

	// Récupere la connexion à la bdd
	protected function getBdd()
	{
		if(self::$_bdd == null)
			self::setBdd();
		return self::$_bdd;
	}
}

?>