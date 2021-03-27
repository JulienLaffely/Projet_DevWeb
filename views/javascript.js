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

function modifSelect1(){
  let SelectedOptions1=[];
  let SelectedOptions2=[];
  for(var i = 0 ; i < document.getElementsByTagName('select')[1].selectedOptions.length;++i){
    SelectedOptions1.push(document.getElementsByTagName('select')[1].selectedOptions[i].value);
  }
  for(var i = 0 ; i < document.getElementsByTagName('select')[2].selectedOptions.length;++i){
    SelectedOptions2.push(document.getElementsByTagName('select')[2].selectedOptions[i].value);
  }
  document.getElementsByTagName('select')[1].remove();
  document.getElementsByTagName('select')[1].remove();

    var parent2 = document.getElementsByName('placeSelect2')[0];
    var select2 = document.createElement("select");
    select2.multiple= 'true';
    parent2.appendChild(select2);
    select2.setAttribute('name',"select2");
    select2.setAttribute('onchange',"modifSelect2()");

    var parent3 = document.getElementsByName('placeSelect3')[0];
    var select3 = document.createElement("select");
    select3.multiple= 'true';
    parent3.appendChild(select3);
    select3.setAttribute('name',"select3");
    select3.setAttribute('onchange',"modifSelect3()");

  for(var i = 0 ; i< document.getElementsByName('exempts').length ;++i){
    if(document.getElementsByName('exempts')[i].children.length==1){
      if(!SelectedOptions1.includes(document.getElementsByName('exempts')[i].firstChild.innerHTML) && !SelectedOptions2.includes(document.getElementsByName('exempts')[i].firstChild.innerHTML)){
        document.getElementsByName('exempts')[i].innerHTML=document.getElementsByName('exempts')[i].firstChild.innerHTML;
        var option2 = document.createElement("option");
        option2.value=document.getElementsByName('exempts')[i].innerHTML;
        option2.text=document.getElementsByName('exempts')[i].innerHTML;
        select2.appendChild(option2);

        var option3 = document.createElement("option");
        option3.value=document.getElementsByName('exempts')[i].innerHTML;
        option3.text=document.getElementsByName('exempts')[i].innerHTML;
       select3.appendChild(option3);
      }
      else{
        if(SelectedOptions1.includes(document.getElementsByName('exempts')[i].firstChild.innerHTML)){
        var option2 = document.createElement("option");
        option2.value=document.getElementsByName('exempts')[i].firstChild.innerHTML;
       option2.text=document.getElementsByName('exempts')[i].firstChild.innerHTML;
       select2.appendChild(option2);}else{

       var option3 = document.createElement("option");
       option3.value=document.getElementsByName('exempts')[i].firstChild.innerHTML;
       option3.text=document.getElementsByName('exempts')[i].firstChild.innerHTML;
       select3.appendChild(option3);}
      }
    }
    else{  var option2 = document.createElement("option");
      option2.value=document.getElementsByName('exempts')[i].innerHTML;
      option2.text=document.getElementsByName('exempts')[i].innerHTML;
      select2.appendChild(option2);

      var option3 = document.createElement("option");
      option3.value=document.getElementsByName('exempts')[i].innerHTML;
      option3.text=document.getElementsByName('exempts')[i].innerHTML;
      select3.appendChild(option3);}
  }
  
  for(var i = 0 ; i< document.getElementsByName('exempts').length ;++i){
      for(var j = 0 ; j< document.getElementsByTagName('select')[0].selectedOptions.length ;++j){
        if(document.getElementsByName('exempts')[i].innerHTML==document.getElementsByTagName('select')[0].selectedOptions[j].value){
          document.getElementsByName('exempts')[i].innerHTML="<span style='visibility:hidden;'>"+document.getElementsByName('exempts')[i].innerHTML+"</span>";
          for(var k = 0 ; k<document.getElementsByTagName('select')[1].options.length;++k){
            if(document.getElementsByTagName('select')[1].options[k].value==document.getElementsByTagName('select')[0].selectedOptions[j].value)document.getElementsByTagName('select')[1].options[k].remove();
          }
          for(var l = 0 ; l<document.getElementsByTagName('select')[2].options.length;++l){
            if(document.getElementsByTagName('select')[2].options[l].value==document.getElementsByTagName('select')[0].selectedOptions[j].value)document.getElementsByTagName('select')[2].options[l].remove();
          }
        }
      }  
  }
  for(var i = 0 ; i<select2.options.length;++i){
    for(var j = 0 ; j<SelectedOptions1.length ; ++j){
      if(select2.options[i].value==SelectedOptions1[j])select2.options[i].selected=true;
    }
  }

  for(var i = 0 ; i<select3.options.length;++i){
    for(var j = 0 ; j<SelectedOptions2.length ; ++j){
      if(select3.options[i].value==SelectedOptions2[j])select3.options[i].selected=true;
    }
  }
  if(document.getElementsByName('case1')[0].innerHTML==""){document.getElementsByName('select1')[0].disabled=true;document.getElementsByName('Brouillon')[0].disabled=true;document.getElementsByName('ConvocVal')[0].disabled=true;document.getElementsByName('Supp')[0].disabled=true;}
  else{document.getElementsByName('select1')[0].disabled=false;document.getElementsByName('Brouillon')[0].disabled=false;document.getElementsByName('ConvocVal')[0].disabled=false;document.getElementsByName('Supp')[0].disabled=false;}
  if(document.getElementsByName('case1')[1].innerHTML==""){document.getElementsByName('select2')[0].disabled=true;document.getElementsByName('Brouillon')[1].disabled=true;document.getElementsByName('ConvocVal')[1].disabled=true;document.getElementsByName('Supp')[1].disabled=true;}
  else {document.getElementsByName('select2')[0].disabled=false;document.getElementsByName('Brouillon')[1].disabled=false;document.getElementsByName('ConvocVal')[1].disabled=false;document.getElementsByName('Supp')[1].disabled=false;}
  if(document.getElementsByName('case1')[2].innerHTML==""){document.getElementsByName('select3')[0].disabled=true;document.getElementsByName('Brouillon')[2].disabled=true;document.getElementsByName('ConvocVal')[2].disabled=true;document.getElementsByName('Supp')[2].disabled=true;}
  else {document.getElementsByName('select3')[0].disabled=false;document.getElementsByName('Brouillon')[2].disabled=false;document.getElementsByName('ConvocVal')[2].disabled=false;document.getElementsByName('Supp')[2].disabled=false;}

 let data=document.getElementsByName('case1')[0].innerHTML+";"+document.getElementsByName('case2')[0].innerHTML+";"+document.getElementsByName('case3')[0].innerHTML+";"+document.getElementsByName('case4')[0].innerHTML+";"+document.getElementsByName('case5')[0].innerHTML+";"+document.getElementsByName('case6')[0].innerHTML+";";
    for(let i = 0 ; i < document.getElementsByName('select1')[0].selectedOptions.length;++i){
      data+=(document.getElementsByName('select1')[0].selectedOptions[i].value+";");
    }
    document.getElementsByName('joueurs1')[0].value=data;
}

function modifSelect2(){
  let SelectedOptions1=[];
  let SelectedOptions2=[];
  for(var i = 0 ; i < document.getElementsByTagName('select')[0].selectedOptions.length;++i){
    SelectedOptions1.push(document.getElementsByTagName('select')[0].selectedOptions[i].value);
  }
  for(var i = 0 ; i < document.getElementsByTagName('select')[2].selectedOptions.length;++i){
    SelectedOptions2.push(document.getElementsByTagName('select')[2].selectedOptions[i].value);
  }
  document.getElementsByTagName('select')[0].remove();
  document.getElementsByTagName('select')[1].remove();

    var parent1 = document.getElementsByName('placeSelect1')[0];
    var select1 = document.createElement("select");
    select1.multiple= 'true';
    parent1.appendChild(select1);
    select1.setAttribute('name',"select1");
    select1.setAttribute('onchange',"modifSelect1()");

    var parent3 = document.getElementsByName('placeSelect3')[0];
    var select3 = document.createElement("select");
    select3.multiple= 'true';
    parent3.appendChild(select3);
    select3.setAttribute('name',"select3");
    select3.setAttribute('onchange',"modifSelect3()");

  for(var i = 0 ; i< document.getElementsByName('exempts').length ;++i){
    if(document.getElementsByName('exempts')[i].children.length==1){
      if(!SelectedOptions1.includes(document.getElementsByName('exempts')[i].firstChild.innerHTML) && !SelectedOptions2.includes(document.getElementsByName('exempts')[i].firstChild.innerHTML)){
        document.getElementsByName('exempts')[i].innerHTML=document.getElementsByName('exempts')[i].firstChild.innerHTML;
        var option1 = document.createElement("option");
        option1.value=document.getElementsByName('exempts')[i].innerHTML;
        option1.text=document.getElementsByName('exempts')[i].innerHTML;
       select1.appendChild(option1);

        var option3 = document.createElement("option");
        option3.value=document.getElementsByName('exempts')[i].innerHTML;
        option3.text=document.getElementsByName('exempts')[i].innerHTML;
        select3.appendChild(option3);
      }
      else{
        if(SelectedOptions1.includes(document.getElementsByName('exempts')[i].firstChild.innerHTML)){
        var option1 = document.createElement("option");
        option1.value=document.getElementsByName('exempts')[i].firstChild.innerHTML;
        option1.text=document.getElementsByName('exempts')[i].firstChild.innerHTML;
        select1.appendChild(option1);}else{

        var option3 = document.createElement("option");
        option3.value=document.getElementsByName('exempts')[i].firstChild.innerHTML;
        option3.text=document.getElementsByName('exempts')[i].firstChild.innerHTML;
        select3.appendChild(option3);}
      }
    }
    else {  var option1 = document.createElement("option");
      option1.value=document.getElementsByName('exempts')[i].innerHTML;
      option1.text=document.getElementsByName('exempts')[i].innerHTML;
      select1.appendChild(option1);

      var option3 = document.createElement("option");
      option3.value=document.getElementsByName('exempts')[i].innerHTML;
      option3.text=document.getElementsByName('exempts')[i].innerHTML;
      select3.appendChild(option3);}
  }
  
  for(var i = 0 ; i< document.getElementsByName('exempts').length ;++i){
      for(var j = 0 ; j< document.getElementsByTagName('select')[1].selectedOptions.length ;++j){
        if(document.getElementsByName('exempts')[i].innerHTML==document.getElementsByTagName('select')[1].selectedOptions[j].value){
          document.getElementsByName('exempts')[i].innerHTML="<span style='visibility:hidden;'>"+document.getElementsByName('exempts')[i].innerHTML+"</span>";
          for(var k = 0 ; k<document.getElementsByTagName('select')[0].options.length;++k){
            if(document.getElementsByTagName('select')[0].options[k].value==document.getElementsByTagName('select')[1].selectedOptions[j].value)document.getElementsByTagName('select')[0].options[k].remove();
          }
          for(var l = 0 ; l<document.getElementsByTagName('select')[2].options.length;++l){
            if(document.getElementsByTagName('select')[2].options[l].value==document.getElementsByTagName('select')[1].selectedOptions[j].value)document.getElementsByTagName('select')[2].options[l].remove();
          }
        }
      }  
  }
  for(var i = 0 ; i<select1.options.length;++i){
    for(var j = 0 ; j<SelectedOptions1.length ; ++j){
      if(select1.options[i].value==SelectedOptions1[j])select1.options[i].selected=true;
    }
  }

  for(var i = 0 ; i<select3.options.length;++i){
    for(var j = 0 ; j<SelectedOptions2.length ; ++j){
      if(select3.options[i].value==SelectedOptions2[j])select3.options[i].selected=true;
    }
  }
  if(document.getElementsByName('case1')[0].innerHTML==""){document.getElementsByName('select1')[0].disabled=true;document.getElementsByName('Brouillon')[0].disabled=true;document.getElementsByName('ConvocVal')[0].disabled=true;document.getElementsByName('Supp')[0].disabled=true;}
  else{document.getElementsByName('select1')[0].disabled=false;document.getElementsByName('Brouillon')[0].disabled=false;document.getElementsByName('ConvocVal')[0].disabled=false;document.getElementsByName('Supp')[0].disabled=false;}
  if(document.getElementsByName('case1')[1].innerHTML==""){document.getElementsByName('select2')[0].disabled=true;document.getElementsByName('Brouillon')[1].disabled=true;document.getElementsByName('ConvocVal')[1].disabled=true;document.getElementsByName('Supp')[1].disabled=true;}
  else {document.getElementsByName('select2')[0].disabled=false;document.getElementsByName('Brouillon')[1].disabled=false;document.getElementsByName('ConvocVal')[1].disabled=false;document.getElementsByName('Supp')[1].disabled=false;}
  if(document.getElementsByName('case1')[2].innerHTML==""){document.getElementsByName('select3')[0].disabled=true;document.getElementsByName('Brouillon')[2].disabled=true;document.getElementsByName('ConvocVal')[2].disabled=true;document.getElementsByName('Supp')[2].disabled=true;}
  else {document.getElementsByName('select3')[0].disabled=false;document.getElementsByName('Brouillon')[2].disabled=false;document.getElementsByName('ConvocVal')[2].disabled=false;document.getElementsByName('Supp')[2].disabled=false;}

let data=document.getElementsByName('case1')[1].innerHTML+";"+document.getElementsByName('case2')[1].innerHTML+";"+document.getElementsByName('case3')[1].innerHTML+";"+document.getElementsByName('case4')[1].innerHTML+";"+document.getElementsByName('case5')[1].innerHTML+";"+document.getElementsByName('case6')[1].innerHTML+";";
    for(let i = 0 ; i < document.getElementsByName('select2')[0].selectedOptions.length;++i){
      data+=(document.getElementsByName('select2')[0].selectedOptions[i].value+";");
    }
    document.getElementsByName('joueurs2')[0].value=data;
}

function modifSelect3(){
  let SelectedOptions1=[];
  let SelectedOptions2=[];
  for(var i = 0 ; i < document.getElementsByTagName('select')[0].selectedOptions.length;++i){
    SelectedOptions1.push(document.getElementsByTagName('select')[0].selectedOptions[i].value);
  }
  for(var i = 0 ; i < document.getElementsByTagName('select')[1].selectedOptions.length;++i){
    SelectedOptions2.push(document.getElementsByTagName('select')[1].selectedOptions[i].value);
  }
  document.getElementsByTagName('select')[0].remove();
  document.getElementsByTagName('select')[0].remove();

    var parent1 = document.getElementsByName('placeSelect1')[0];
    var select1 = document.createElement("select");
    select1.multiple= 'true';
    parent1.appendChild(select1);
    select1.setAttribute('name',"select1");
    select1.setAttribute('onchange',"modifSelect1()");

    var parent2 = document.getElementsByName('placeSelect2')[0];
    var select2 = document.createElement("select");
    select2.multiple= 'true';
    parent2.appendChild(select2);
    select2.setAttribute('name',"select2");
    select2.setAttribute('onchange',"modifSelect2()");

  for(var i = 0 ; i< document.getElementsByName('exempts').length ;++i){
    if(document.getElementsByName('exempts')[i].children.length==1){
      if(!SelectedOptions1.includes(document.getElementsByName('exempts')[i].firstChild.innerHTML) && !SelectedOptions2.includes(document.getElementsByName('exempts')[i].firstChild.innerHTML)){
        document.getElementsByName('exempts')[i].innerHTML=document.getElementsByName('exempts')[i].firstChild.innerHTML;
        var option1 = document.createElement("option");
        option1.value=document.getElementsByName('exempts')[i].innerHTML;
        option1.text=document.getElementsByName('exempts')[i].innerHTML;
        select1.appendChild(option1);

        var option2 = document.createElement("option");
        option2.value=document.getElementsByName('exempts')[i].innerHTML;
        option2.text=document.getElementsByName('exempts')[i].innerHTML;
        select2.appendChild(option2);
      }
      else{
        if(SelectedOptions1.includes(document.getElementsByName('exempts')[i].firstChild.innerHTML)){
        var option1 = document.createElement("option");
        option1.value=document.getElementsByName('exempts')[i].firstChild.innerHTML;
       option1.text=document.getElementsByName('exempts')[i].firstChild.innerHTML;
       select1.appendChild(option1);}else{

       var option2 = document.createElement("option");
       option2.value=document.getElementsByName('exempts')[i].firstChild.innerHTML;
       option2.text=document.getElementsByName('exempts')[i].firstChild.innerHTML;
       select2.appendChild(option2);}
      }
    }
    else{ 
      var option1 = document.createElement("option");
      option1.value=document.getElementsByName('exempts')[i].innerHTML;
      option1.text=document.getElementsByName('exempts')[i].innerHTML;
      select1.appendChild(option1);

      var option2 = document.createElement("option");
      option2.value=document.getElementsByName('exempts')[i].innerHTML;
      option2.text=document.getElementsByName('exempts')[i].innerHTML;
      select2.appendChild(option2);}
  }
  
  for(var i = 0 ; i< document.getElementsByName('exempts').length ;++i){
      for(var j = 0 ; j< document.getElementsByTagName('select')[2].selectedOptions.length ;++j){
        if(document.getElementsByName('exempts')[i].innerHTML==document.getElementsByTagName('select')[2].selectedOptions[j].value){
          document.getElementsByName('exempts')[i].innerHTML="<span style='visibility:hidden;'>"+document.getElementsByName('exempts')[i].innerHTML+"</span>";
          for(var k = 0 ; k<document.getElementsByTagName('select')[0].options.length;++k){
            if(document.getElementsByTagName('select')[0].options[k].value==document.getElementsByTagName('select')[2].selectedOptions[j].value)document.getElementsByTagName('select')[0].options[k].remove();
          }
          for(var l = 0 ; l<document.getElementsByTagName('select')[1].options.length;++l){
            if(document.getElementsByTagName('select')[1].options[l].value==document.getElementsByTagName('select')[2].selectedOptions[j].value)document.getElementsByTagName('select')[1].options[l].remove();
          }
        }
      }  
  }
  for(var i = 0 ; i<select1.options.length;++i){
    for(var j = 0 ; j<SelectedOptions1.length ; ++j){
      if(select1.options[i].value==SelectedOptions1[j])select1.options[i].selected=true;
    }
  }

  for(var i = 0 ; i<select2.options.length;++i){
    for(var j = 0 ; j<SelectedOptions2.length ; ++j){
      if(select2.options[i].value==SelectedOptions2[j])select2.options[i].selected=true;
    }
  }

  if(document.getElementsByName('case1')[0].innerHTML==""){document.getElementsByName('select1')[0].disabled=true;document.getElementsByName('Brouillon')[0].disabled=true;document.getElementsByName('ConvocVal')[0].disabled=true;document.getElementsByName('Supp')[0].disabled=true;}
  else{document.getElementsByName('select1')[0].disabled=false;document.getElementsByName('Brouillon')[0].disabled=false;document.getElementsByName('ConvocVal')[0].disabled=false;document.getElementsByName('Supp')[0].disabled=false;}
  if(document.getElementsByName('case1')[1].innerHTML==""){document.getElementsByName('select2')[0].disabled=true;document.getElementsByName('Brouillon')[1].disabled=true;document.getElementsByName('ConvocVal')[1].disabled=true;document.getElementsByName('Supp')[1].disabled=true;}
  else {document.getElementsByName('select2')[0].disabled=false;document.getElementsByName('Brouillon')[1].disabled=false;document.getElementsByName('ConvocVal')[1].disabled=false;document.getElementsByName('Supp')[1].disabled=false;}
  if(document.getElementsByName('case1')[2].innerHTML==""){document.getElementsByName('select3')[0].disabled=true;document.getElementsByName('Brouillon')[2].disabled=true;document.getElementsByName('ConvocVal')[2].disabled=true;document.getElementsByName('Supp')[2].disabled=true;}
  else {document.getElementsByName('select3')[0].disabled=false;document.getElementsByName('Brouillon')[2].disabled=false;document.getElementsByName('ConvocVal')[2].disabled=false;document.getElementsByName('Supp')[2].disabled=false;}

    let data=document.getElementsByName('case1')[2].innerHTML+";"+document.getElementsByName('case2')[2].innerHTML+";"+document.getElementsByName('case3')[2].innerHTML+";"+document.getElementsByName('case4')[2].innerHTML+";"+document.getElementsByName('case5')[2].innerHTML+";"+document.getElementsByName('case6')[2].innerHTML+";";
    for(let i = 0 ; i < document.getElementsByName('select3')[0].selectedOptions.length;++i){
      data+=(document.getElementsByName('select3')[0].selectedOptions[i].value+";");
    }
    document.getElementsByName('joueurs3')[0].value=data;
}

function ActualisationDesTables()  {

      while(document.getElementById('tableConvoc').rows.length>11)
      {
        document.getElementById('tableConvoc').deleteRow(document.getElementById('tableConvoc').rows.length-1);
      }
      for(var i = 6 ;i<10;++i ){
        document.getElementsByName("exempts")[i].setAttribute('style','visibility:hidden');
        document.getElementsByName("abs")[i].setAttribute('style','visibility:hidden');
        document.getElementsByName("sus")[i].setAttribute('style','visibility:hidden');
        document.getElementsByName("ble")[i].setAttribute('style','visibility:hidden');
        document.getElementsByName("nl")[i].setAttribute('style','visibility:hidden');
      }
      for(let i = 0 ; i<10 ;i++){
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
        document.getElementsByName("dateConvoc")[0].value=anciennedate
        ActualisationDesTables();
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
                if(ligne[0]!="COMPETITION"){
                if(ligne[3].replaceAll("/","-")==document.getElementsByName("dateConvoc")[0].value){
                    document.getElementsByName("case1")[compt].innerHTML=ligne[0];
                    document.getElementsByName("case2")[compt].innerHTML=ligne[2];
                    document.getElementsByName("case3")[compt].innerHTML=ligne[6];
                    document.getElementsByName("case4")[compt].innerHTML=ligne[5];
                    document.getElementsByName("case5")[compt].innerHTML=ligne[4];
                    document.getElementsByName("case6")[compt].innerHTML=ligne[1];
                    ++compt;
                }
                else{
                  if(compt!=3){
                    document.getElementsByName("case1")[compt].innerHTML="";
                    document.getElementsByName("case2")[compt].innerHTML="";
                    document.getElementsByName("case3")[compt].innerHTML="";
                    document.getElementsByName("case4")[compt].innerHTML="";
                    document.getElementsByName("case5")[compt].innerHTML="";
                    document.getElementsByName("case6")[compt].innerHTML="";
                  }
                }
                }
              });
            }
          };
          xhttp.open("GET","Matchs.json",false);
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
          xhttp2.open("GET","FeuilleDesAbsences.json",false);
          xhttp2.send();

          //CHARGEMENT DES SELECTIONS DE JOUEURS
          let boucle = 0 ;
          let joueurSelect = [];
          while(document.getElementsByName('exempts')[boucle]!=null ){ 
            if(document.getElementsByName('exempts')[boucle].innerText!="") joueurSelect.push(document.getElementsByName('exempts')[boucle].innerHTML);
            ++boucle;
          }
          var parent1 = document.getElementsByName('placeSelect1')[0];
          var select1 = document.createElement("select");
          select1.multiple= 'true';
          parent1.appendChild(select1);
          select1.setAttribute('name',"select1");
          select1.setAttribute('onchange',"modifSelect1()");
          for(var i = 0 ; i<joueurSelect.length ; i++){
            var option = document.createElement("option");
            option.value=joueurSelect[i];
            option.text=joueurSelect[i];
            select1.appendChild(option);

          }
          if(document.getElementsByName('select1').length==2){
            document.getElementsByName('select1')[0].remove();
          }

          var parent2 = document.getElementsByName('placeSelect2')[0];
          var select2 = document.createElement("select");
          select2.multiple= 'true';
          parent2.appendChild(select2);
          select2.setAttribute('name',"select2");
          select2.setAttribute('onchange',"modifSelect2()");
          for(var i = 0 ; i<joueurSelect.length ; i++){
            var option2 = document.createElement("option");
            option2.value=joueurSelect[i];
            option2.text=joueurSelect[i];
            select2.appendChild(option2);

          }
          if(document.getElementsByName('select2').length==2){
            document.getElementsByName('select2')[0].remove();
          }

          var parent3 = document.getElementsByName('placeSelect3')[0];
          var select3 = document.createElement("select");
          select3.multiple= 'true';
          parent3.appendChild(select3);
          select3.setAttribute('name',"select3");
          select3.setAttribute('onchange',"modifSelect3()");
          for(var i = 0 ; i<joueurSelect.length ; i++){
            var option3 = document.createElement("option");
            option3.value=joueurSelect[i];
            option3.text=joueurSelect[i];
            select3.appendChild(option3);

          }
          if(document.getElementsByName('select3').length==2){
            document.getElementsByName('select3')[0].remove();
          }

          //Desactivation des bouttons si des date sont vide
          if(document.getElementsByName('case1')[0].innerHTML==""){document.getElementsByName('select1')[0].disabled=true;document.getElementsByName('Brouillon')[0].disabled=true;document.getElementsByName('ConvocVal')[0].disabled=true;document.getElementsByName('Supp')[0].disabled=true;}
          else{document.getElementsByName('select1')[0].disabled=false;document.getElementsByName('Brouillon')[0].disabled=false;document.getElementsByName('ConvocVal')[0].disabled=false;document.getElementsByName('Supp')[0].disabled=false;}
           if(document.getElementsByName('case1')[1].innerHTML==""){document.getElementsByName('select2')[0].disabled=true;document.getElementsByName('Brouillon')[1].disabled=true;document.getElementsByName('ConvocVal')[1].disabled=true;document.getElementsByName('Supp')[1].disabled=true;}
           else {document.getElementsByName('select2')[0].disabled=false;document.getElementsByName('Brouillon')[1].disabled=false;document.getElementsByName('ConvocVal')[1].disabled=false;document.getElementsByName('Supp')[1].disabled=false;}
           if(document.getElementsByName('case1')[2].innerHTML==""){document.getElementsByName('select3')[0].disabled=true;document.getElementsByName('Brouillon')[2].disabled=true;document.getElementsByName('ConvocVal')[2].disabled=true;document.getElementsByName('Supp')[2].disabled=true;}
           else {document.getElementsByName('select3')[0].disabled=false;document.getElementsByName('Brouillon')[2].disabled=false;document.getElementsByName('ConvocVal')[2].disabled=false;document.getElementsByName('Supp')[2].disabled=false;}
      

          //Importation de la BDD pour chargement des selectedoptions

          var xhttp3 = new XMLHttpRequest();
          xhttp3.onreadystatechange = function() {
            if(xhttp3.readyState == 4 && xhttp3.status == 200){
              var convocations = JSON.parse(xhttp3.response);
              convocations.forEach(function(ligne){
                if(ligne['date']==document.getElementsByName('dateConvoc')[0].value)
                {
                  for(let i = 0 ; i < 3 ; ++i)
                  {
                      if(ligne['equipe']==document.getElementsByName('case6')[i].innerHTML)
                      {
                        let joueurs = ligne['joueurs'].split(';');
                        for(let j = 0 ; j<document.getElementsByTagName('select')[i].options.length;++j)
                        {
                          if(joueurs.includes(document.getElementsByTagName('select')[i].options[j].value))
                          {
                            document.getElementsByTagName('select')[i].options[j].selected=true;
                            if(i==0) modifSelect1();
                            else if(i==1) modifSelect2();
                              else modifSelect3();
                          }
                        }
                      }
                  }
                }
              });
            }
          };
          xhttp3.open("GET","Convocations.json",false);
          xhttp3.send();
      }
}
