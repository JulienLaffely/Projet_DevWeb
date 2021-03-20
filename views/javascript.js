var jours = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

function date()  {
  		var input = document.getElementById("calendrier").value;
  		var date = new Date(input);
  		var jourDeLaSemaine = date.getUTCDay();

  		if (jours[jourDeLaSemaine]!="Sunday"){
  			alert("Veuillez choisir un dimanche !");
  			document.getElementById("calendrier").value="2021-08-01";
  		}
}