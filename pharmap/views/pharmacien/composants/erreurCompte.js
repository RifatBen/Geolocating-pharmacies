var nom = document.forms["vform1"]["nom"];
var prenom = document.forms["vform1"]["prenom"];
var nompharma = document.forms["vform3"]["nompharma"];
var tel = document.forms["vform3"]["tel"];
var old_pass = document.forms["vform2"]["old-pass"];
var new_pass = document.forms["vform2"]["new-pass"];
var confirm_pass = document.forms["vform2"]["confirm-pass"];

var nom_err = document.getElementById("nom-err");
var prenom_err = document.getElementById("prenom-err");
var nompharma_err = document.getElementById("nompharma-err");
var tel_err = document.getElementById("tel-err");
var old_pass_err = document.getElementById("old-pass-err");
var new_pass_err = document.getElementById("new-pass-err");
var confirm_pass_err = document.getElementById("confirm-pass-err");

nom.addEventListener("blur", nomValide, true);
prenom.addEventListener("blur", prenomValide, true);
nompharma.addEventListener("blur", nompharmaValide, true);
tel.addEventListener("blur", telValide, true);
new_pass.addEventListener("blur", newPassValide, true);
confirm_pass.addEventListener("blur", confirmPassValide, true);

function Valider1() {

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

}

function Valider3() {

  if(tel.value.length > 24 || !telStructure(tel.value)) {
    tel.style.borderColor = "red";
    tel_err.textContent = "veuillez introduire un numéro de téléphone valide";
    tel.focus();
    return false;
  }

  if(nompharma.value.length > 255 || !nomStructure(nompharma.value)) {
    nompharma.style.borderColor = "red";
    nompharma_err.textContent = "veuillez introduire un nom valide";
    nompharma.focus();
    return false;
  }

}

function Valider2() {

  if(new_pass.value.length < 8 || new_pass.value.length > 24) {
    new_pass.style.borderColor = "red";
    new_pass_err.textContent = "le mot de passe doit avoir entre 8 et 24 caractères";
    new_pass.focus();
    return false;
  }
  if(new_pass.value != confirm_pass.value) {
    confirm_pass.style.borderColor = "red";
    confirm_pass_err.textContent = "les deux mot de passe ne sont pas identique";
    confirm_pass.focus();
    return false;
  }

}

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

function nompharmaValide() {
  if(nompharma.value.length <= 255 && nomStructure(nompharma.value)) {
    nompharma.style.borderColor = "lightgray";
    nompharma_err.innerHTML = "";
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

function newPassValide() {
  if(new_pass.value.length >= 8 && new_pass.value.length <= 24) {
    new_pass.style.borderColor = "lightgray";
    new_pass_err.innerHTML = "";
    return true;
  }
}
function confirmPassValide() {
  if(new_pass.value == confirm_pass.value) {
    confirm_pass.style.borderColor = "lightgray";
    confirm_pass_err.innerHTML = "";
    return true;
  }
}



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