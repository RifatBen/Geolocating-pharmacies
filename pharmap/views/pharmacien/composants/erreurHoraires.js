var ouverture = document.forms["vform4"]["ouverture"];
var fermeture = document.forms["vform4"]["fermeture"];
var debut = document.forms["vform5"]["debut"];
var fin = document.forms["vform5"]["fin"];
var gdate = document.forms["vform6"]["date"];
var gdebut = document.forms["vform6"]["debut"];
var gfin = document.forms["vform6"]["fin"];

gdebut.defaultValue = "20:00";
gfin.defaultValue = "08:00";

var ouverture_err = document.getElementById("ouverture-err");
var fermeture_err = document.getElementById("fermeture-err");
var debut_err = document.getElementById("debut-err");
var fin_err = document.getElementById("fin-err");
var gdate_err = document.getElementById("gdate-err");
var gdebut_err = document.getElementById("gdebut-err");
var gfin_err = document.getElementById("gfin-err");

ouverture.addEventListener("blur", ouvertureValide, true);
fermeture.addEventListener("blur", fermetureValide, true);
debut.addEventListener("blur", debutValide, true);
fin.addEventListener("blur", finValide, true);
gdate.addEventListener("blur", gdateValide, true);
gdebut.addEventListener("blur", gdebutValide, true);
gfin.addEventListener("blur", gfinValide, true);

function Valider4() {
  if(!timeStructure(ouverture.value)) {
    ouverture.style.borderColor = "red";
    ouverture_err.textContent = "veuillez introduire un temps valide";
    ouverture.focus();
    return false;
  }
  if(!timeStructure(fermeture.value)) {
    fermeture.style.borderColor = "red";
    fermeture_err.textContent = "veuillez introduire un temps valide";
    fermeture.focus();
    return false;
  }
}

function Valider5() {
  if(!dateStructure(debut.value)) {
    debut.style.borderColor = "red";
    debut_err.textContent = "veuillez introduire une date valide";
    debut.focus();
    return false;
  }
  if(!dateStructure(fin.value) || fin.value <= debut.value) {
    fin.style.borderColor = "red";
    fin_err.textContent = "veuillez introduire une date valide";
    fin.focus();
    return false;
  }
}

function Valider6() {
  if(!dateStructure(gdate.value)) {
    gdate.style.borderColor = "red";
    gdate_err.textContent = "veuillez introduire une date valide";
    gdate.focus();
    return false;
  }
  if(!timeStructure(gdebut.value)) {
    gdebut.style.borderColor = "red";
    gdebut_err.textContent = "veuillez introduire un temps valide";
    gdebut.focus();
    return false;
  }
  if(!timeStructure(gfin.value)) {
    gfin.style.borderColor = "red";
    gfin_err.textContent = "veuillez introduire un temps valide";
    gfin.focus();
    return false;
  }
}

function ouvertureValide() {
  if(timeStructure(ouverture.value)) {
    ouverture.style.borderColor = "lightgray";
    ouverture_err.innerHTML = "";
    return true;
  }
}
function fermetureValide() {
  if(timeStructure(fermeture.value)) {
    fermeture.style.borderColor = "lightgray";
    fermeture_err.innerHTML = "";
    return true;
  }
}

function debutValide() {
  if(dateStructure(debut.value)) {
    debut.style.borderColor = "lightgray";
    debut_err.innerHTML = "";
    return true;
  }
}
function finValide() {
  if(dateStructure(fin.value) && fin.value > debut.value) {
    fin.style.borderColor = "lightgray";
    fin_err.innerHTML = "";
    return true;
  }
}

function gdateValide() {
  if(dateStructure(gdate.value)) {
    gdate.style.borderColor = "lightgray";
    gdate_err.innerHTML = "";
    return true;
  }
}
function gdebutValide() {
  if(timeStructure(gdebut.value)) {
    gdebut.style.borderColor = "lightgray";
    gdebut_err.innerHTML = "";
    return true;
  }
}
function gfinValide() {
  if(timeStructure(gfin.value)) {
    gfin.style.borderColor = "lightgray";
    gfin_err.innerHTML = "";
    return true;
  }
}

function timeStructure(a) {
  var regex = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/;
  if(regex.test(a))
    return true;
  else
    return false;
}
function dateStructure(a) {
  var regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
  if(regex.test(a))
    return true;
  else
    return false;
}