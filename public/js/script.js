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