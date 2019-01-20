// afficher - masquer
var x = document.getElementById("divacacher");
var y = document.getElementById("divafficher");
var z = document.getElementById("action");

function affiche() {
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    z.textContent = "Masquer le menu d'options";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    z.textContent = "Afficher le menu d'options";
  }
}

window.onresize = function(event) {
  var width = document.body.clientWidth;
  if(width >= 768) {
    x.style.display = "block";
    y.style.display = "block";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    z.textContent = "Afficher le menu d'options";
  }
};

document.getElementById('localisation').addEventListener('click', function() {
  afficheRes();
});

window.onload = function() {
  var width = document.body.clientWidth;
  if(width < 768) {
    x.style.display = "block";
    y.style.display = "none";
    z.textContent = "Masquer le menu d'options";
  }
  afficheRech();
};



// recherche - resultats
var rech = document.getElementById("recherche");
var res = document.getElementById("resultat");

function afficheRech() {
  rech.style.display = "block";
  res.style.display = "none";
}

function afficheRes() {
  rech.style.display = "none";
  res.style.display = "block";
}

function clickMap() {
  var width = document.body.clientWidth;
  if(width < 768)
    z.click();
}