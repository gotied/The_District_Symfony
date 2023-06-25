function augmenterQuantite(platId) {
  var quantiteElement = document.getElementById('quantite-' + platId);
  var quantite = parseInt(quantiteElement.innerHTML);
  quantite += 1;
  quantiteElement.innerHTML = quantite;
  modifierQuantite(platId, quantite);
}

function diminuerQuantite(platId) {
  var quantiteElement = document.getElementById('quantite-' + platId);
  var quantite = parseInt(quantiteElement.innerHTML);
  if (quantite > 0) {
    quantite -= 1;
    quantiteElement.innerHTML = quantite;
    modifierQuantite(platId, quantite);
  }
}

function modifierQuantite(platId, quantite) {
  var url = '/modifier-quantite/' + platId + '/' + quantite;
  fetch(url)
    .then(response => response.json())
    .then(data => {
    })
    .catch(error => {
      console.error(error);
    });
}

function modifierTotal() {
  var total = 0;
  var selects = document.getElementsByTagName("select");
  for (var i = 0; i < selects.length; i++) {
    var select = selects[i];
    var prixInput = select.parentNode.querySelector('input[name="prix"]');
    var prix = parseFloat(prixInput.value);
    var quantite = parseInt(select.value);
    total += prix * quantite;
    var spanId = select.getAttribute("name").replace("quantite_", "");
    document.getElementById("total_" + spanId).textContent = (prix * quantite).toFixed(2) + " €";
  }
  document.getElementById("total").value = total.toFixed(2) + " €";
}
window.addEventListener("DOMContentLoaded", modifierTotal);

var selects = document.getElementsByTagName("select");
for (var i = 0; i < selects.length; i++) {
  selects[i].addEventListener("change", modifierTotal);
}

function preparerFormulaire() {
  var totalField = document.getElementById("total");
  var totalValue = totalField.value;
  totalValue = totalValue.replace(" €", "");
  totalField.value = totalValue;
}

