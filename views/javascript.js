var jours = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
var anciennedate="2021-08-01";

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
          xhttp.open("GET","absents.json",true);
          xhttp.send();
          anciennedate=document.getElementById("calendrier").value;
      }
}


function dateActuel(){
  return document.getElementById("calendrier").value;
}

function actualisationSelect($id,$ligne){
    document.getElementById($id).value=$ligne;
}

function AffichageCalendrier($cp,$eq,$eqA,$ter,$site,$i){
  document.getElementsByName('competition'+$i.toString())[0].value=$cp;
  document.getElementsByName('equipe'+$i.toString())[0].value=$eq;
  document.getElementsByName('equipeAdv'+$i.toString())[0].value=$eqA;
  document.getElementsByName('Terrain'+$i.toString())[0].value=$ter;
  document.getElementsByName('Site'+$i.toString())[0].value=$site;
}

function DecouperCsv(data){
  let csvData = [];
    let lbreak = data.split("\n");
    lbreak.forEach(res => {
        csvData.push(res.split(";"));
    });
    return csvData;
}

function ActualisationDesTables()  {
      while(document.getElementById('tableConvoc').rows.length>7)
      {
        document.getElementById('tableConvoc').deleteRow(document.getElementById('tableConvoc').rows.length-1);
      }
      
      for(let i = 0 ; i<6 ;i++){
        document.getElementsByName("exempts")[i].innerHTML="";
        document.getElementsByName("abs")[i].innerHTML="";
        document.getElementsByName("sus")[i].innerHTML="";
        document.getElementsByName("ble")[i].innerHTML="";
        document.getElementsByName("nl")[i].innerHTML="";
      }


      let input = document.getElementsByName("dateConvoc")[0].value;
      let date = new Date(input);
      let jourDeLaSemaine = date.getUTCDay();

      if (jours[jourDeLaSemaine]!="Sunday"){
        alert("Veuillez choisir un dimanche !");
        document.getElementsByName("dateConvoc")[0].value=anciennedate;
      }
      else{
        anciennedate=input;
        let ladate=input.split("-");
        let aux = ladate[0];
        ladate[0]=ladate[2];
        ladate[2]=aux;
        input = ladate.join('/');
        document.getElementsByName("datetab")[0].innerHTML=input;
        document.getElementsByName("datetab")[1].innerHTML=input;
        document.getElementsByName("datetab")[2].innerHTML=input;

        var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if(xhttp.readyState == 4 && xhttp.status == 200){
              var contenu = JSON.parse(xhttp.response);
              let compt = 0;
              contenu.forEach(function(ligne){
                if(ligne[3].replaceAll("/","-")==document.getElementsByName("dateConvoc")[0].value){
                    document.getElementsByName("case1")[compt].innerHTML=ligne[0];
                    document.getElementsByName("case2")[compt].innerHTML=ligne[2];
                    document.getElementsByName("case3")[compt].innerHTML=ligne[6];
                    document.getElementsByName("case4")[compt].innerHTML=ligne[5];
                    document.getElementsByName("case5")[compt].innerHTML=ligne[4];
                    document.getElementsByName("case6")[compt].innerHTML=ligne[1];
                   compt++;
                }
              });
            }
          };
          xhttp.open("GET","Matchs.json",true);
          xhttp.send();

          var xhttp2 = new XMLHttpRequest();
          xhttp2.onreadystatechange = function() {
            if(xhttp2.readyState == 4 && xhttp2.status == 200){
              var contenu = JSON.parse(xhttp2.response);
              let comptEx = 0;
              let comptNl = 0;
              let comptSus = 0;
              let comptBle = 0;
              let comptAbs = 0;
              contenu.forEach(function(ligne){
                let bool = false;
                ligne.forEach(function(element){
                  if(element[3]==document.getElementsByName("dateConvoc")[0].value){
                    bool=true;
                    if(element[2]=="ABS")
                    {
                      if(comptAbs<6)document.getElementsByName('abs')[comptAbs].innerHTML=ligne[0][0]+" "+ligne[0][1];
                      else{
                        if(document.getElementsByName('abs')[comptAbs]==null){
                          var Table=document.getElementById('tableConvoc');
                          var newligne= Table.insertRow(comptAbs+1);
                          for(let i = 0 ; i<9;++i){
                          var cell = newligne.insertCell(i);
                          cell.setAttribute('id','tdConvoc');
                          if(i!=8)cell.setAttribute('style','visibility:hidden;');
                          if(i==4)cell.setAttribute('name','exempts');
                          if(i==5)cell.setAttribute('name','nl');
                          if(i==6)cell.setAttribute('name','ble');
                          if(i==7)cell.setAttribute('name','sus');
                          if(i==8)cell.setAttribute('name','abs');
                          }
                        }
                        else document.getElementsByName('abs')[comptAbs].setAttribute('style','visibility:visible;');
                        document.getElementsByName('abs')[comptAbs].innerHTML=ligne[0][0]+" "+ligne[0][1];
                      }
                      comptAbs++
                    }
                    if(element[2]=="SUS")
                    {
                      if(comptSus<6)document.getElementsByName('sus')[comptSus].innerHTML=ligne[0][0]+" "+ligne[0][1];
                      else{
                        if(document.getElementsByName('sus')[comptSus]==null){
                          var Table=document.getElementById('tableConvoc');
                          var newligne= Table.insertRow(comptSus+1);
                          for(let i = 0 ; i<9;++i){
                          var cell = newligne.insertCell(i);
                          cell.setAttribute('id','tdConvoc');
                          if(i!=7)cell.setAttribute('style','visibility:hidden;');
                          if(i==4)cell.setAttribute('name','exempts');
                          if(i==5)cell.setAttribute('name','nl');
                          if(i==6)cell.setAttribute('name','ble');
                          if(i==7)cell.setAttribute('name','sus');
                          if(i==8)cell.setAttribute('name','abs');
                          }
                        }
                        else document.getElementsByName('sus')[comptSus].setAttribute('style','visibility:visible;');
                        document.getElementsByName('sus')[comptSus].innerHTML=ligne[0][0]+" "+ligne[0][1];
                      }
                      comptSus++;
                    }
                    if(element[2]=="BLE")
                    {
                      if(comptBle<6)document.getElementsByName('ble')[comptBle].innerHTML=ligne[0][0]+" "+ligne[0][1];
                      else{
                        if(document.getElementsByName('ble')[comptBle]==null){
                          var Table=document.getElementById('tableConvoc');
                          var newligne= Table.insertRow(comptBle+1);
                          for(let i = 0 ; i<9;++i){
                          var cell = newligne.insertCell(i);
                          cell.setAttribute('id','tdConvoc');
                          if(i!=6)cell.setAttribute('style','visibility:hidden;');
                          if(i==4)cell.setAttribute('name','exempts');
                          if(i==5)cell.setAttribute('name','nl');
                          if(i==6)cell.setAttribute('name','ble');
                          if(i==7)cell.setAttribute('name','sus');
                          if(i==8)cell.setAttribute('name','abs');
                          }
                        }
                        else document.getElementsByName('ble')[comptBle].setAttribute('style','visibility:visible;');
                        document.getElementsByName('ble')[comptBle].innerHTML=ligne[0][0]+" "+ligne[0][1];
                      }
                      comptBle++;
                    }
                    if(element[2]=="NL")
                    {
                      if(comptNl<6)document.getElementsByName('nl')[comptNl].innerHTML=ligne[0][0]+" "+ligne[0][1];
                      else{
                        if(document.getElementsByName('nl')[comptNl]==null){
                          var Table=document.getElementById('tableConvoc');
                          var newligne= Table.insertRow(comptNl+1);
                          for(let i = 0 ; i<9;++i){
                          var cell = newligne.insertCell(i);
                          cell.setAttribute('id','tdConvoc');
                          if(i!=5)cell.setAttribute('style','visibility:hidden;');
                          if(i==4)cell.setAttribute('name','exempts');
                          if(i==5)cell.setAttribute('name','nl');
                          if(i==6)cell.setAttribute('name','ble');
                          if(i==7)cell.setAttribute('name','sus');
                          if(i==8)cell.setAttribute('name','abs');
                          }
                        }
                        else document.getElementsByName('nl')[comptNl].setAttribute('style','visibility:visible;');
                        document.getElementsByName('nl')[comptNl].innerHTML=ligne[0][0]+" "+ligne[0][1];
                      }
                      comptNl++;
                    }
                  }
                });
                if(bool==false){
                  if(comptEx<6)document.getElementsByName('exempts')[comptEx].innerHTML=ligne[0][0]+" "+ligne[0][1];
                  else{
                        if(document.getElementsByName('exempts')[comptEx]==null){
                          var Table=document.getElementById('tableConvoc');
                          var newligne= Table.insertRow(comptEx+1);
                          for(let i = 0 ; i<9;++i){
                          var cell = newligne.insertCell(i);
                          cell.setAttribute('id','tdConvoc');
                          if(i!=4)cell.setAttribute('style','visibility:hidden;');
                          if(i==4)cell.setAttribute('name','exempts');
                          if(i==5)cell.setAttribute('name','nl');
                          if(i==6)cell.setAttribute('name','ble');
                          if(i==7)cell.setAttribute('name','sus');
                          if(i==8)cell.setAttribute('name','abs');
                          }
                        }
                        else document.getElementsByName('exempts')[comptEx].setAttribute('style','visibility:visible;');
                        document.getElementsByName('exempts')[comptEx].innerHTML=ligne[0][0]+" "+ligne[0][1];
                    }
                  comptEx++;
                }
              });
            }
          };
          xhttp2.open("GET","FeuilleDesAbsences.json",true);
          xhttp2.send();

      }
}
