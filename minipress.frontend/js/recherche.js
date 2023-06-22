import { activable,categoID, displayArticles } from "./article.js";

let status=1;
export let status2 =1;

const pack = document.getElementById('date');
pack.addEventListener('click', async (event) => {
    if(activable){
    let bob = categoID.reverse();
        if (status === 2) {
            status = 1;
            // Afficher bob dans l'ordre inversé
            displayArticles(bob);
            pack.innerHTML = '<p>Date Décroissante</p>';
        } else {
            status = 2;
            // Afficher bob dans l'ordre normal
            displayArticles(categoID);
            pack.innerHTML = '<p>Date Croissante</p>';
        }
    }
});

const pack2 = document.getElementById('rech');
pack2.addEventListener('click', async (event) => {
    if(activable){
        if(status2===2){
            status2=1;
            pack2.innerHTML = '<p>Titre</p>';
        } else {
            status2=2;
            pack2.innerHTML = '<p>Titre & Auteur</p>';
        }
    }
});