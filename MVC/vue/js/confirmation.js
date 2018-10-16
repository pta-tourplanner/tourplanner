// Bracnhement de l'événement CLICK sur les boutons SUPPRIMER
window.onload = function () {
    // var links = document.querySelectorAll('.btn, .btn-danger');
    var links = document.querySelectorAll('[class="btn btn-danger"]');    
    console.log(links.length);

    for(var i = 0 ; i < links.length; i++){
        links[i].addEventListener('click', confirmation, false);
    }
};

// Fonction de suppresion
function confirmation(evt){
    var reponse = confirm('Voulez-vous supprimer cette ligne ?');
    if (reponse){
        html.location(evt.target.href);
    } else {
        evt.preventDefault();
    }
}