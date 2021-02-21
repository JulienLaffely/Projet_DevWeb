<?php

abstract class Model
{
	private static $_bdd;

	// Instancie la connexion à la bdd
	private static function setBdd()
	{
		self::$_bdd = new PDO('mysql:host=localhost;dbname=Club;charset=utf8','root','');
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