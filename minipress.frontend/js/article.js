'use strict';


let articles; // Variable pour stocker les articles


/* Récupération des articles */
fetch('http://localhost:41004/api/articles')
    .then(response => response.json())
    .then(data => {
        articles = data; // Stockage des articles dans la variable

        /* Tri des articles par date chronologique (dateCreation) dans l'ordre inverse */
        articles.sort((a, b) => new Date(b.date_de_creation) - new Date(a.date_de_creation));

        // Appel de la fonction updateArticleList('all') une fois les articles récupérés
        updateArticleList('all');
    })
    .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des articles:', error);
    });


/* Fonction pour afficher les articles */
function displayArticles(articles) {
    const articleList = document.getElementById('articles');
    articleList.innerHTML = ''; // Réinitialisation de la liste des articles

    /* Affichage pour chaque article */
    articles.forEach(article => {
        const articleItem = document.createElement('div');

        /* Titre */
        const title = document.createElement('h2');
        title.textContent = article.titre;
        articleItem.appendChild(title);

        /* Date de création */
        const creationDate = document.createElement('p');
        creationDate.textContent = `Date de création : ${article.date_de_creation}`;
        articleItem.appendChild(creationDate);

        /* Auteur */
        const author = document.createElement('p');
        author.textContent = `Auteur : ${article.id_user}`;
        articleItem.appendChild(author);

        /* Ajout de l'article à la liste */
        articleList.appendChild(articleItem);
    });
}


/* Fonction pour mettre à jour l'affichage des articles */
export function updateArticleList(categoryId) {
    if (categoryId === 'all') {
        displayArticles(articles); // Afficher tous les articles
    } else {
        // Récupérer les articles de la catégorie sélectionnée
        fetch(`http://localhost:41004/api/categories/${categoryId}/articles`)
            .then(response => response.json())
            .then(articlesByCategory => {
                displayArticles(articlesByCategory);
            })
            .catch(error => {
                console.error('Une erreur s\'est produite lors de la récupération des articles de la catégorie:', error);
            });
    }
}