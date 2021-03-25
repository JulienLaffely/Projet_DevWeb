<?php
	require_once('views/View.php');
	require_once('models/modelConvocation.php');

	class ControllerConvocation
	{
		private $_model ;

		public function __construct()
		{
					$this->_model = new modelConvocation();
					$this->_view = new View('Convocation');
					$this->_view->generate();
					$this->Affichage();
		}

		public function Affichage()
		{
			if(($FichierCsv=fopen("Matchs.csv","r"))!==FALSE)
			{
				while(($ligne=fgetcsv($FichierCsv,1000,";"))!==FALSE)
				{
					$FeuilleDeMatch[]=$ligne;
				}
				fclose($FichierCsv);

				$Matchs=fopen('Matchs.json','w+');
				fwrite($Matchs,json_encode($FeuilleDeMatch));
				fclose($Matchs);
			}


			if(isset($_POST['dateConvoc'])){
				$date=$_POST['dateConvoc'];
			}else $date='2021-08-01';

			$dateDebut=explode("-", $date);
			$aux=$dateDebut[2];
			$dateDebut[2]=$dateDebut[0];
			$dateDebut[0]=$aux;
			$dateDebut=implode("/", $dateDebut);
			echo "<form method='post'>
					<input type='date' id='dateConvoc' min='2021-08-01' max='2022-07-31' value='$date' name='dateConvoc' onchange='ActualisationDesTables()'/></br></br></br>
					<table id='tableConvoc'  >
						<tr>
							<td id='tdConvoc' style='visibility:hidden;'></td>
							<td id='tdConvoc' name='datetab'>$dateDebut</td>
							<td id='tdConvoc' name='datetab'>$dateDebut</td>
							<td id='tdConvoc' name='datetab'>$dateDebut</td>
							<td id='tdConvoc'>Exempts</td>
							<td id='tdConvoc'>Non-Licencié</td>
							<td id='tdConvoc'>Blessure</td>
							<td id='tdConvoc'>Suspendu</td>
							<td id='tdConvoc'>Absent</td>
						</tr>
						<tr>
							<td id='tdConvoc'><b>COMPETITION</b></td>
							<td id='tdConvoc' name='case1' ></td>
							<td id='tdConvoc' name='case1'></td>
							<td id='tdConvoc' name='case1'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
						</tr>
						<tr>
							<td id='tdConvoc'><b>ADVERSAIRE</b></td>
							<td id='tdConvoc' name='case2'></td>
							<td id='tdConvoc' name='case2'></td>
							<td id='tdConvoc' name='case2'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
						</tr>
						<tr>
							<td id='tdConvoc'><b>SITE</b></td>
							<td id='tdConvoc' name='case3' ></td>
							<td id='tdConvoc' name='case3'></td>
							<td id='tdConvoc' name='case3'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
						</tr>
						<tr>
							<td id='tdConvoc'><b>TERRAIN</b></td>
							<td id='tdConvoc' name='case4' ></td>
							<td id='tdConvoc' name='case4'></td>
							<td id='tdConvoc' name='case4'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
						</tr>
						<tr>
							<td id='tdConvoc'><b>HEURE</b></td>
							<td id='tdConvoc' name='case5' ></td>
							<td id='tdConvoc' name='case5'></td>
							<td id='tdConvoc' name='case5'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
						</tr>
						<tr>
							<td id='tdConvoc'><b>EQUIPE</b></td>
							<td id='tdConvoc' name='case6'></td>
							<td id='tdConvoc' name='case6'></td>
							<td id='tdConvoc' name='case6'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
							<td id='tdConvoc'></td>
						</tr>
						
						
					</table>
				  </form>
			<script>ActualisationDesTables()</script>";	  
		}
	}