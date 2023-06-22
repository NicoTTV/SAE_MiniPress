import { articles, displayArticles } from "./article.js";

let status=1;

const pack = document.getElementById('date');
pack.addEventListener('click', (event) => {
    let bob = articles.reverse();
    if (pack.innerHTML == '<p>Date Croissante</p>') {
        status=1;
        // Afficher bob dans l'ordre inversé
        displayArticles(bob);
        pack.innerHTML = '<p>Date Décroissante</p>';
    } else {
        status=2;
        // Afficher bob dans l'ordre normal
        displayArticles(articles);
        pack.innerHTML = '<p>Date Croissante</p>';
    }
});
