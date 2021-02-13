<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?= $t ?></title>
		<link rel="stylesheet" href="views/style.css">
		<link href='https://fonts.googleapis.cm/css.family=Open+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<header>
			<center><h1>Bienvenue sur le site de l'AC Montreuil-juigné</h1></center>
		</header>
			<!--<?= $content ?>-->
			<form>
				<fieldset>
					<legend>Authentification</legend>
					<label style="margin-left: 50px">Adresse mail : </label>
					<input type="mail" name="maile"/>
					<label style="margin-left: 50px">Mot de passe : </label>
					<input type="password" name="pswd" />
					<input type="submit" value="Connexion" name="log" style="margin-left: 130px"/>

				</fieldset>
			</form>
		<footer>
				<p><b>Crée par Julien le giga boss</b></p>
		</footer>
	</body>
</html>