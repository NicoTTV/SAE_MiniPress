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
fetch('https://exemple.com/api/categories') // TODO: Remplacer l'URL par celle de l'API MiniPress.core
    .then(response => response.json())
    .then(data => {
        const categories = data;

        /* Sélection de l'élément <ul> pour afficher les catégories */
        const categoryList = document.getElementById('categories');

        /* Parcours des catégories et création des éléments <li> correspondants */
        categories.forEach(category => {
            const categoryItem = document.createElement('li');
            categoryItem.textContent = category.name;

            /* Ajout de chaque élément <li> à la liste des catégories */
            categoryList.appendChild(categoryItem);
        });
    })
    .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des catégories:', error);
    });


/* Sélection de la liste des catégories */
const categoryList = document.getElementById('categories');

categoryList.addEventListener('click', event => {
    /* Vérifiez si l'élément cliqué est une catégorie */
    if (event.target.tagName === 'LI') {
        const categoryId = event.target.dataset.categoryId; // Récupérez l'ID de la catégorie sélectionnée

        /* Récupération des articles de la catégorie sélectionnée */
        fetch(`https://exemple.com/api/categories/${categoryId}/articles`) // TODO: Remplacer l'URL par celle de l'API MiniPress.core
            .then(response => response.json())
            .then(data => {
                const articles = data;

                /* Réinitialisation de la liste des articles */
                articleList.innerHTML = '';

                /* Affichage des articles de la catégorie dans l'interface web */
                articles.forEach(article => {

                    /* Informations de l'article */
                    const articleItem = document.createElement('div');
                    const title = document.createElement('h3');
                    const content = document.createElement('p');
                    title.textContent = article.title;
                    content.textContent = article.content;

                    /* Ajout des éléments à l'élément articleItem */
                    articleItem.appendChild(title);
                    articleItem.appendChild(content);

                    /* Ajout de l'article à la liste des articles */
                    articleList.appendChild(articleItem);
                });
            })
            .catch(error => {
                console.error('Une erreur s\'est produite lors de la récupération des articles de la catégorie:', error);
            });
    }
});
