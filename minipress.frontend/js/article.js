'use strict';


import {getAuteurById} from "./user.js";


let articles; // Variable pour stocker les articles


/* Récupération des articles */
fetch('http://localhost:41004/api/articles')
    .then(response => response.json())
    .then(data => {
        articles = data; // Stockage des articles dans la variable
        // console.log(articles);

        /* Tri des articles par date chronologique (dateCreation) dans l'ordre inverse */
        articles.sort((a, b) => new Date(b.date_de_creation) - new Date(a.date_de_creation));

        // Appel de la fonction updateArticleList('all') une fois les articles récupérés
        updateArticleList('all');
    })
    .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des articles:', error);
    });


/* Fonction pour afficher l'article complet */
async function displayFullArticle(article) {
    /* Effacement du contenu précédent de la liste des articles */
    const articleList = document.getElementById('articles');
    articleList.innerHTML = '';

    /* Création des éléments pour afficher l'article complet */
    const fullArticleContainer = document.createElement('div');

    /* Titre */
    const title = document.createElement('h2');
    title.textContent = article.titre;
    fullArticleContainer.appendChild(title);

    /* Date de création */
    const creationDate = document.createElement('p');
    creationDate.textContent = `Date de création : ${article.date_de_creation}`;
    fullArticleContainer.appendChild(creationDate);

    /* Auteur */
    const author = document.createElement('p');
    const pseudo_user = await getAuteurById(article.id_user);
    author.textContent = `Auteur : ${pseudo_user}`;
    fullArticleContainer.appendChild(author);

    /* Contenu */
    const content = document.createElement('p');
    content.textContent = article.contenu;
    fullArticleContainer.appendChild(content);

    /* Ajout de l'article complet à la liste des articles */
    articleList.appendChild(fullArticleContainer);
}


/* Fonction pour afficher les articles */
async function displayArticles(articles) {
    const articleList = document.getElementById('articles');
    articleList.innerHTML = ''; // Réinitialisation de la liste des articles

    /* Affichage pour chaque article */
    for (const article of articles) {
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
        const pseudo_user = await getAuteurById(article.id_user);
        author.textContent = `Auteur : ${pseudo_user}`;
        articleItem.appendChild(author);

        /* Résumé */
        const summary = document.createElement('p');
        summary.textContent = article.resume;
        articleItem.appendChild(summary);

        /* Ajout d'un gestionnaire d'événement au clic sur le titre de l'article */
        articleItem.addEventListener('click', (event) => {
            displayFullArticle(article);
        });

        /* Ajout de l'article à la liste */
        articleList.appendChild(articleItem);
    }
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