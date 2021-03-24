var jours = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
let anciennedate="2021-08-01";

function dateP()  {
  		var input = document.getElementById("calendrier").value;
  		var date = new Date(input);
  		var jourDeLaSemaine = date.getUTCDay();
      let index;

  		if (jours[jourDeLaSemaine]!="Sunday"){
  			alert("Veuillez choisir un dimanche !");
  			document.getElementById("calendrier").value=anciennedate;
  		}
      else{
        let i = 1 ;
        while(document.getElementById(i.toString())!=null){
          document.getElementById(i.toString()).selectedIndex=0;
          ++i;
        }
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && xhttp.status == 200){
              var contenu = JSON.parse(xhttp.response);
              contenu.forEach(function(ligne){
                if(ligne.date==input){
                  if(ligne.motif=='ABS')index=1;
                  if(ligne.motif=='BLE')index=2;
                  if(ligne.motif=='NL')index=3;
                  if(ligne.motif=='SUS')index=4;
                  document.getElementById((ligne.id).toString()).selectedIndex=index;
                }
              });
            }
          };
          xhttp.open("GET","abscents.json",true);
          xhttp.send();
          anciennedate=document.getElementById("calendrier").value;
      }
}

function dateCon()  {
  		var input = document.getElementById("calendrier").value;
  		var date = new Date(input);
  		var jourDeLaSemaine = date.getUTCDay();

  		if (jours[jourDeLaSemaine]!="Sunday"){
  			alert("Veuillez choisir un dimanche !");
  			document.getElementById("calendrier").value="2021-08-01";
  		}
}

function dateActuel(){
  return document.getElementById("calendrier").value;
}

function actualisationSelect($id,$ligne){
    document.getElementById($id).value=$ligne;
}
