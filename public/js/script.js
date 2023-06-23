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
function updateTotalPrice() {
    var total = 0;
    var selects = document.getElementsByTagName("select");
    
    for (var i = 0; i < selects.length; i++) {
      var select = selects[i];
      var price = parseFloat(select.parentNode.parentNode.querySelector('.card-text').textContent.trim());
      var quantity = parseInt(select.value);
      total += price * quantity;
    }
    document.getElementById("total").value = total.toFixed(2) + " €";
  }
  window.addEventListener("load", updateTotalPrice);
  var selects = document.getElementsByTagName("select");
  for (var i = 0; i < selects.length; i++) {
    selects[i].addEventListener("change", updateTotalPrice);
  }
  