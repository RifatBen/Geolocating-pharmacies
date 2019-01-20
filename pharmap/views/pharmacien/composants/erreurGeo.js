var latitude = document.forms["vform"]["lat"];
var longitude = document.forms["vform"]["lng"];

var position_err = document.getElementById("position-err");

latitude.addEventListener("blur", positionValide, true);

function Valider() {
  if(latitude.value == "" || longitude.value == "") {
    position_err.textContent = "veuillez introduire l'adresse de votre pharmacie";
    return false;
  } else {
    return true;
  }
}

function positionValide() {
  if(latitude.value != "" && longitude.value != "") {
    position_err.innerHTML = "";
    return true;
  }
}