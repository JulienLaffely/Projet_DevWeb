<?php
	require_once('views/View.php');

	class ControllerCalendrier
	{
		public function __construct()
		{
					if(isset($_POST['Delete'])) $this->deleteCSV();
					if(isset($_POST['MajCSV'])) $this->MajCSV();
					$this->_view = new View('Calendrier');
					$this->_view->generate();
					$this->AfficheCalendrier();
		}

		public function AfficheCalendrier()
		{
			echo "<form method='post'>";
			$i=0;
			if(($csv=fopen("Matchs.csv","r"))!==FALSE)
			{
				while(($ligne=fgetcsv($csv,1000,";"))!==FALSE)
				{
					if($ligne[0]=="COMPETITION")
					{		
						echo "<table id='tablec'>
							  <tr>
							  	<td id='tdc'><b>$ligne[0]</b></td>
							  	<td id='tdc'><b>$ligne[1]</b></td>
							  	<td id='tdc'><b>$ligne[2]</b></td>
							  	<td id='tdc'><b>$ligne[3]</b></td>
							  	<td id='tdc'><b>$ligne[4]</b></td>
							  	<td id='tdc'><b>$ligne[5]</b></td>
							  	<td id='tdc'><b>$ligne[6]</b></td>
							  	<td id='tdc'><b>Supression</b></td>
							  </tr>";
					}
					else
					{
						if($ligne[3]!=""){
							$date=str_replace("/", "-", $ligne[3]);
							/*$date=explode("-", $date);
							$aux=$date[0];
							$date[0]=$date[2];
							$date[2]=$aux;
							$date=implode("-", $date);*/
						}
						else $date="";

						$compet="competition".strval($i);
						$Eq="equipe".strval($i);
						$EqA="equipeAdv".strval($i);
						$LaDate="Date".strval($i);
						$Heure="Heure".strval($i);
						$Terrain="Terrain".strval($i);
						$Site="Site".strval($i);
						echo "
							<tr>
								<td id='tdc'>
									<select  name ='$compet' style='opacity:0.8;'>
										<option value='Coupe Departementale'>Coupe Départementale</option>
										<option value='Coupe Intercommunale'>Coupe Intercommunale</option>
										<option value='Championnat Departementale'>Championnat Départementale</option>
										<option value='Amical'>Amical</option>
									</select>
								</td>
								<td id='tdc'>
									<select name='$Eq' style='opacity:0.8;'>
										<option value='SENIORS_1'>SENIORS_1</option> 
										<option value='SENIORS_2'>SENIORS_2</option> 
										<option value='SENIORS_3'>SENIORS_3</option> 
									</select>
								</td>
								<td id='tdc'>
									<select name='$EqA' style='opacity:0.8;'>";
									if(($equipA=fopen("Liste_equipes_terrain_site.csv","r"))!==FALSE)
									{
										while(($eq=fgetcsv($equipA,1000,";"))!==FALSE)
										{
											if($eq[0]!="Equipes")
											{
												echo "<option value='$eq[0]'>$eq[0]</option>";
											}
										}
										fclose($equipA);
									}
									echo "
									</select>
								</td>
								<td id='tdc'>
									<input type='date' name='$LaDate' min='2021-08-01' max='2022-07-31' value='$date' style='opacity:0.8;'/>
								</td>
								<td id='tdc'>
									<input name='$Heure' type='time' min='08:00' max='20:00' value='$ligne[4]' style='opacity:0.8;' />
								</td>
								<td id='tdc'>
									<select name ='$Terrain' style='opacity:0.8;'>";
									if(($terrain=fopen("Liste_equipes_terrain_site.csv","r"))!==FALSE)
									{
										while(($ter=fgetcsv($terrain,1000,";"))!==FALSE)
										{
											if($ter[2]!="Terrain"&&$ter[2]!="")
											{
												echo "<option value='$ter[2]'>$ter[2]</option>";
											}
										}
										fclose($terrain);
									}
									echo "
									</select>
								</td>
								<td id='tdc'>
									<select name ='$Site' style='opacity:0.8;'>";
									if(($site=fopen("Liste_equipes_terrain_site.csv","r"))!==FALSE)
									{
										while(($si=fgetcsv($site,1000,";"))!==FALSE)
										{
											if($si[1]!="Site")
											{
												echo "<option value='$si[1]'>$si[1]</option>";
											}
										}
										fclose($site);
									}
									echo "
									</select>
								</td>
								<script>AffichageCalendrier('$ligne[0]','$ligne[1]','$ligne[2]','$ligne[5]','$ligne[6]',$i)</script>";
								$i++;
								$DEL="SupMatch_n".strval($i);
								echo "
									<td id='tdc'>
										<input type='submit' name='Delete' value='$DEL' style='width:110px;'/>  
									</td>
								";
					}
				}
				echo "</table></br></br>";
				echo "<center><input type='submit' value='Modifier le calendrier' name='MajCSV' style='height:70px;width:150px;background-color:green;' /></center></br>";
				fclose($csv);
			}
			echo "<input type='hidden' name='nbMatch' value=$i /> </form>"
				 ;
		}

		public function deleteCSV()
		{
			$numDelete=intval(substr($_POST['Delete'],10));
			$nbligne = 0;
			if (($fichier = fopen("Matchs.csv", "r")) !== FALSE) {
    			while (($ligne = fgetcsv($fichier,1000, ";")) !== FALSE) {      
	   				$lignes[$nbligne] = $ligne;
	   				$nbligne++;
    			}
    			fclose($fichier);
				unset($lignes[$numDelete]);
			}
			if (($fichierbis = fopen("Matchs.csv", "w")) !== FALSE){
				foreach ($lignes as $chaqueligne) {
    				fputcsv($fichierbis, $chaqueligne,";");
				}
				fclose($fichierbis);
			}
		}

		public function group_by($key, $data) {
   			$result = array();

    		foreach($data as $val) {
        		if(array_key_exists($key, $val)){
            		$result[$val[$key]][] = $val;
        		}else{
            		$result[""][] = $val;
        		}
    		}
			return $result;
		}



		public function MajCSV()
		{
			$indice=0;
			$calendrier = [];
			while($indice!=$_POST['nbMatch'])
			{
				$calendrier[$indice]=[];
				$competMaj=$_POST['competition'.strval($indice)];
				$EqMaj=$_POST['equipe'.strval($indice)];
				$EqAMaj=$_POST['equipeAdv'.strval($indice)];
				$LaDateMaj=$_POST['Date'.strval($indice)];
				$HeureMaj=$_POST['Heure'.strval($indice)];
				$TerrainMaj=$_POST['Terrain'.strval($indice)];
				$SiteMaj=$_POST['Site'.strval($indice)];


				$calendrier[$indice][0]=$competMaj;
				$calendrier[$indice][1]=$EqMaj;
				$calendrier[$indice][2]=$EqAMaj;
				if(date("l",strtotime($_POST['Date'.strval($indice)]))!="Sunday")
				{
					if($_POST['Date'.strval($indice)]==""){
						echo "<script>alert('Le match qui oppose $EqMaj et $EqAMaj le $LaDateMaj ne pourra pas avoir lieu car il n\'est pas programmer. Le match est donc enregistrer mais sans date. Vous ne pourrez donc pas créer de convocation pour celui ci tant que la date n\'aura pas été modifier !')</script>";
					}
					else echo "<script>alert('Le match qui oppose $EqMaj et $EqAMaj le $LaDateMaj ne pourra pas avoir lieu car ce n\'est pas un dimanche. Le match est donc enregistrer mais sans date. Vous ne pourrez donc pas créer de convocation pour celui ci tant que la date n\'aura pas été modifier !')</script>";
					$calendrier[$indice][3]="";
				}
				else $calendrier[$indice][3]=$LaDateMaj;
				$calendrier[$indice][4]=$HeureMaj;
				$calendrier[$indice][5]=$TerrainMaj;
				$calendrier[$indice][6]=$SiteMaj;

				$indice++;
			}
			$calendrierGrouperParDate= $this->group_by(3,$calendrier);
			foreach ($calendrierGrouperParDate as $key => $value ) {
				$dateCourante=$key;
				if((count($value)>3)&&($key!="")){
					echo "<script>alert('Trop de match programmé le $dateCourante ! Un maximum de 3 matchs (1 par équipe) par jour est accépté ! Veuillez reprogrammez les matchs concerné.')</script>";
					foreach ($calendrier as &$ligne) {
						if ($ligne[3]==$dateCourante) $ligne[3]="";
					}
				}
				else {
					if($dateCourante!=""){
						if(count($value)==3)
						{
							if($value[1][1]==$value[0][1] || $value[1][1]==$value[2][1] || $value[2][1]==$value[0][1]){
								echo "<script>alert('Attention ! Une equipe joue au moins deux fois le $dateCourante ! Les 3 matchs sont donc pour l\'instant réatribué dans l\'ordre des equipes. Merci de réatribuez les equipes pour cette date.')</script>";
								$compt=0;
								foreach ($calendrier as &$ligne) {
									if ($ligne[3]==$dateCourante && $compt==0){ $ligne[1]="SENIORS_1";++$compt;}
									else if($ligne[3]==$dateCourante && $compt==1){ $ligne[1]="SENIORS_2";++$compt;}
									else if ($ligne[3]==$dateCourante && $compt==2){ $ligne[1]="SENIORS_3";++$compt;}
								}

							}
							else if($value[1][2]==$value[0][2] || $value[1][2]==$value[2][2] || $value[2][2]==$value[0][2]){
								echo "<script>alert('Attention ! Plusieurs equipes jouent contre le même adversaire le $dateCourante ! Les adversaires de chaque equipe sont pour l\'instant modifié pour qu\'ils soient différent à cette date. Merci de réatribuez des adversaires à chque équipe pour cette date.')</script>";
								$compt=0;
								foreach ($calendrier as &$ligne) {
									if ($ligne[3]==$dateCourante && $compt==0){ $ligne[2]="FC Argentre";++$compt;}
									else if($ligne[3]==$dateCourante && $compt==1){ $ligne[2]="FC Bonchamp";++$compt;}
									else if ($ligne[3]==$dateCourante && $compt==2){ $ligne[2]="FC Brece";++$compt;}
								}
							}
							else if((($value[1][5]==$value[0][5])&&($value[1][6]==$value[0][6]))||(($value[1][5]==$value[0][5])&&($value[1][6]==$value[0][6]))||(($value[1][5]==$value[0][5])&&($value[1][6]==$value[0][6]))){
								echo "<script>alert('Attention ! Au moins deux équipes jouent sur le même terrain le $dateCourante ! Réatribution automatique de terrain différent pour les matchs de cette date.')</script>";
								$compt=0;
								foreach ($calendrier as &$ligne) {
									if ($ligne[3]==$dateCourante && $compt==0){ $ligne[5]="Stade Chirac";$ligne[6]="Argentre";++$compt;}
									else if($ligne[3]==$dateCourante && $compt==1){ $ligne[5]="Stade du chat";$ligne[6]="Bonchamp";++$compt;}
									else if ($ligne[3]==$dateCourante && $compt==2){ $ligne[5]="Stade du chien";$ligne[6]="Brece";++$compt;}
								}
							}

						}else if(count($value)==1)
							  {
							  	if($value[1][1]==$value[0][1]){
							  		echo "<script>alert('Attention ! Une equipe joue deux fois le $dateCourante ! Les 2 matchs sont donc pour l\'instant réatribué dans l\'ordre des equipes. Merci de réatribuez les equipes pour cette date.')</script>";
							  		$compt=0;
									foreach ($calendrier as &$ligne) {
										if ($ligne[3]==$dateCourante && $compt==0){ $ligne[1]="SENIORS_1";++$compt;}
										else if($ligne[3]==$dateCourante && $compt==1){ $ligne[1]="SENIORS_2";++$compt;}
									}
							  	}
							  	else if($value[1][2]==$value[0][2]){
							  		echo "<script>alert('Attention ! Les deux equipes jouent contre le même adversaire le $dateCourante ! Les adversaires de chaque equipe sont pour l\'instant modifié pour qu\'ils soient différent à cette date. Merci de réatribuez des adversaires à chque équipe pour cette date.')</script>";
							  		$compt=0;
									foreach ($calendrier as &$ligne) {
										if ($ligne[3]==$dateCourante && $compt==0){ $ligne[2]="FC Argentre";++$compt;}
										else if($ligne[3]==$dateCourante && $compt==1){ $ligne[2]="FC Bonchamp";++$compt;}
									}
							  	}
							  	else if(($value[1][5]==$value[0][5])&&($value[1][6]==$value[0][6])){
							  		echo "<script>alert('Attention ! Les deux équipes jouent sur le même terrain le $dateCourante ! Réatribution automatique de terrain différent pour les matchs de cette date.')</script>";
							  		$compt=0;
									foreach ($calendrier as &$ligne) {
										if ($ligne[3]==$dateCourante && $compt==0){ $ligne[5]="Stade Chirac";$ligne[6]="Argentre";++$compt;}
										else if($ligne[3]==$dateCourante && $compt==1){ $ligne[5]="Stade du chat";$ligne[6]="Bonchamp";++$compt;}
									}
							  	}
							  }
					}
				}
			}
			function trieTableau($a,$b){
				return strtotime($a[3]) - strtotime($b[3]);
			}
			usort($calendrier,"trieTableau");
			if (($fichierCSV = fopen("Matchs.csv", "w")) !== FALSE){
				$Entete=["COMPETITION","EQUIPE","EQUIPE ADVERSE","DATE","HEURE","TERRAIN","SITE"] ;
				fputcsv($fichierCSV, $Entete,";");
				foreach ($calendrier as $ligneCSV) {
    				fputcsv($fichierCSV, $ligneCSV,";");
				}
				fclose($fichierCSV);
			}

		}
	}
?>