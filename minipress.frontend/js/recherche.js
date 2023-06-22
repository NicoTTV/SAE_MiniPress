import { categoID, articles, displayArticles } from "./article.js";

let status=1;

const pack = document.getElementById('date');
pack.addEventListener('click', async (event) => {
    let bob = articles.reverse();
    if (categoID = 0) {
        if (pack.innerHTML == '<p>Date Croissante</p>') {
            status = 1;
            // Afficher bob dans l'ordre inversé
            displayArticles(bob);
            pack.innerHTML = '<p>Date Décroissante</p>';
        } else {
            status = 2;
            // Afficher bob dans l'ordre normal
            displayArticles(articles);
            pack.innerHTML = '<p>Date Croissante</p>';
        }
    } else {
        await fetch(`http://localhost:41004/api/categories/${categoryId}/articles`)
            .then(response => response.json())
            .then(category => {
                if(status){

                }
                const articlesByCategory = category.articles;
                // Récupérer les articles de la catégorie
                displayArticles(articlesByCategory);
            })
            .catch(error => {
                console.error('Une erreur s\'est produite lors de la récupération des articles de la catégorie:', error);
            });
    }
});
