var nom = document.forms["vform"]["nom"];
var prenom = document.forms["vform"]["prenom"];
var email = document.forms["vform"]["email"];
var password = document.forms["vform"]["password"];
var nompharma = document.forms["vform"]["nompharma"];
var numero = document.forms["vform"]["numero"];
var tel = document.forms["vform"]["tel"];
var latitude = document.forms["vform"]["lat"];
var longitude = document.forms["vform"]["lng"];
var ouverture = document.forms["vform"]["ouverture"];
var fermeture = document.forms["vform"]["fermeture"];

ouverture.defaultValue = "08:00";
fermeture.defaultValue = "20:00";

var nom_err = document.getElementById("nom-err");
var prenom_err = document.getElementById("prenom-err");
var email_err = document.getElementById("email-err");
var password_err = document.getElementById("password-err");
var nompharma_err = document.getElementById("nompharma-err");
var numero_err = document.getElementById("numero-err");
var tel_err = document.getElementById("tel-err");
var position_err = document.getElementById("position-err");
var ouverture_err = document.getElementById("ouverture-err");
var fermeture_err = document.getElementById("fermeture-err");

nom.addEventListener("blur", nomValide, true);
prenom.addEventListener("blur", prenomValide, true);
email.addEventListener("blur", emailValide, true);
password.addEventListener("blur", passValide, true);
nompharma.addEventListener("blur", nompharmaValide, true);
numero.addEventListener("blur", numeroValide, true);
tel.addEventListener("blur", telValide, true);
latitude.addEventListener("blur", positionValide, true);
ouverture.addEventListener("blur", ouvertureValide, true);
fermeture.addEventListener("blur", fermetureValide, true);

// ------------------------------------
// fonction de verifications des champs

function Valider() {

  if(nom.value.length > 255 || !nomStructure(nom.value)) {
    nom.style.borderColor = "red";
    nom_err.textContent = "veuillez introduire un nom valide";
    nom.focus();
    return false;
  }

  if(prenom.value.length > 255 || !nomStructure(prenom.value)) {
    prenom.style.borderColor = "red";
    prenom_err.textContent = "veuillez introduire un prénom valide";
    prenom.focus();
    return false;
  }
  
  if(email.value.length > 255 || !emailStructure(email.value)) {
    email.style.borderColor = "red";
    email_err.textContent = "veuillez introduire une adresse électronique valide";
    email.focus();
    return false;
  }
  if(password.value.length < 8 || password.value.length > 24) {
    password.style.borderColor = "red";
    password_err.textContent = "le mot de passe doit avoir entre 8 et 24 caractères";
    password.focus();
    return false;
  }
  
  if(nompharma.value.length > 255 || !nomStructure(nompharma.value)) {
    nompharma.style.borderColor = "red";
    nompharma_err.textContent = "veuillez introduire un nom valide";
    nompharma.focus();
    return false;
  }
  if(numero.value.length == 0) {
    numero.style.borderColor = "red";
    numero_err.textContent = "veuillez introduire un numéro d'inscription valide";
    numero.focus();
    return false;
  }
  if(tel.value.length > 24 || !telStructure(tel.value)) {
    tel.style.borderColor = "red";
    tel_err.textContent = "veuillez introduire un numéro de téléphone valide";
    tel.focus();
    return false;
  }
  
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

  if(latitude.value == "" || longitude.value == "") {
    position_err.textContent = "veuillez introduire l'adresse de votre pharmacie";
    return false;
  } else {
    return true;
  }
}

// -----------------------------------
// fonctions de validations des champs

function nomValide() {
  if(nom.value.length <= 255 && nomStructure(nom.value)) {
    nom.style.borderColor = "lightgray";
    nom_err.innerHTML = "";
    return true;
  }
}
function prenomValide() {
  if(prenom.value.length <= 255 && nomStructure(prenom.value)) {
    prenom.style.borderColor = "lightgray";
    prenom_err.innerHTML = "";
    return true;
  }
}
function emailValide() {
  if(email.value.length <= 255 && emailStructure(email.value)) {
    email.style.borderColor = "lightgray";
    email_err.innerHTML = "";
    return true;
  }
}
function passValide() {
  if(password.value.length >= 8 && password.value.length <= 24) {
    password.style.borderColor = "lightgray";
    password_err.innerHTML = "";
    return true;
  }
}

function nompharmaValide() {
  if(nompharma.value.length <= 255 && nomStructure(nompharma.value)) {
    nompharma.style.borderColor = "lightgray";
    nompharma_err.innerHTML = "";
    return true;
  }
}
function numeroValide() {
  if(numero.value.length > 0) {
    numero.style.borderColor = "lightgray";
    numero_err.innerHTML = "";
    return true;
  }
}
function telValide() {
  if(tel.value.length <= 24 && telStructure(tel.value)) {
    tel.style.borderColor = "lightgray";
    tel_err.innerHTML = "";
    return true;
  }
}

function positionValide() {
  if(latitude.value != "" && longitude.value != "") {
    position_err.innerHTML = "";
    return true;
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

// ---------------------------------------
// fonctions de verification de structures

function nomStructure(a) {
	var regex = /^[a-zA-ZéèÉÈêô ]+$/;
	if(regex.test(a))
		return true;
	else
		return false;
}

function emailStructure(a) {
	var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	if(regex.test(a))
		return true;
	else
		return false;
}

function telStructure(a) {
  var regex = /^[0-9 ]+$/;
  if(regex.test(a))
    return true;
  else
    return false;
}

function timeStructure(a) {
  var regex = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/;
  if(regex.test(a))
    return true;
  else
    return false;
}