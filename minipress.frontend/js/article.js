'use strict'

let articles; // Variable qui contiendra les articles récupérés depuis l'API

/* Récupération des articles */
fetch('https://exemple.com/api/articles') // TODO: Remplacer l'URL par celle de l'API MiniPress.core
    .then(response => response.json())
    .then(data => {
        articles = data;

        /* Tri des articles par date chronologique (dateCreation) dans l'ordre inverse */
        articles.sort((a, b) => new Date(b.dateCreation) - new Date(a.dateCreation));

        /* Affichage des articles dans l'interface  */
        const articleList = document.getElementById('article-list');

        /* Affichage pour chaque article */
        articles.forEach(article => {
            const articleItem = document.createElement('div');

            /* Titre */
            const title = document.createElement('h2');
            title.textContent = article.title;
            articleItem.appendChild(title);

            /* Date de création */
            const creationDate = document.createElement('p');
            creationDate.textContent = `Date de création : ${article.dateCreation}`;
            articleItem.appendChild(creationDate);

            /* Auteur */
            const author = document.createElement('p');
            author.textContent = `Auteur : ${article.author}`;
            articleItem.appendChild(author);

            /* Ajout de l'article à la liste */
            articleList.appendChild(articleItem);
        });
    })
    .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des articles:', error);
    });

/* Récupération des catégories */
fetch('https://exemple.com/api/categories')// TODO: Remplacer l'URL par celle de l'API MiniPress.core
    .then(response => response.json())
    .then(data => {
        const categories = data;

        // Sélectionnez l'élément <ul> pour afficher les catégories
        const categoryList = document.getElementById('categories');

        // Parcourez les catégories et créez les éléments <li> correspondants
        categories.forEach(category => {
            const categoryItem = document.createElement('li');
            categoryItem.textContent = category.name;

            // Ajoutez chaque élément <li> à la liste des catégories
            categoryList.appendChild(categoryItem);
        });
    })
    .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des catégories:', error);
    });
