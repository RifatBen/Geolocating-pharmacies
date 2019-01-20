var nom = document.forms["vform"]["nom"];
var prenom = document.forms["vform"]["prenom"];
var email = document.forms["vform"]["email"];
var password = document.forms["vform"]["password"];
var tel = document.forms["vform"]["tel"];

var nom_err = document.getElementById("nom-err");
var prenom_err = document.getElementById("prenom-err");
var email_err = document.getElementById("email-err");
var password_err = document.getElementById("password-err");
var tel_err = document.getElementById("tel-err");

nom.addEventListener("blur", nomValide, true);
prenom.addEventListener("blur", prenomValide, true);
email.addEventListener("blur", emailValide, true);
password.addEventListener("blur", passValide, true);
tel.addEventListener("blur", telValide, true);

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
  if(tel.value.length > 24 || !telStructure(tel.value)) {
    tel.style.borderColor = "red";
    tel_err.textContent = "veuillez introduire un numéro de téléphone valide";
    tel.focus();
    return false;
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
function telValide() {
  if(tel.value.length <= 24 && telStructure(tel.value)) {
    tel.style.borderColor = "lightgray";
    tel_err.innerHTML = "";
    return true;
  }
}

// ---------------------------------------
// fonctions de verification de structures

function nomStructure(a) {
	var regex = /^[a-zA-ZéèÉÈ ]+$/;
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