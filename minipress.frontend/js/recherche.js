import { articles, displayArticles } from "./article.js";

console.log("ANANAS");

const pack = document.getElementById('date');
pack.addEventListener('click', (event) => {
    let bob = articles.reverse();
    if (pack.innerHTML == '<p>Date Croissante</p>') {
        // Afficher bob dans l'ordre inversé
        displayArticles(bob);
        pack.innerHTML = '<p>Date Décroissante</p>';
    } else {
        // Afficher bob dans l'ordre normal
        displayArticles(articles);
        pack.innerHTML = '<p>Date Croissante</p>';
    }
});
