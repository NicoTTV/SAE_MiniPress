'use strict'

// let articles; // Variable qui contiendra les articles récupérés depuis l'API


/* Récupération des articles */
fetch('http://localhost:41004/api/articles')
    .then(response => response.json())
    .then(data => {
        let articles = data;

        /* Tri des articles par date chronologique (dateCreation) dans l'ordre inverse */
        articles.sort((a, b) => new Date(b.date_de_creation) - new Date(a.date_de_creation));

        /* Affichage des articles dans l'interface  */
        const articleList = document.getElementById('article-list');

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
    })
    .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des articles:', error);
    });


/* Récupération des catégories */
fetch('http://localhost:41004/api/categories')
    .then(response => response.json())
    .then(categories => {
        /* Affichage initial des catégories dans l'interface */
        displayCategories(categories);
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
        fetch(`http://localhost:41004/api/categories/${categoryId}/articles`)
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


/* Fonction pour mettre à jour l'affichage des articles */
function updateArticleList(categoryId) {
    fetch(`http://localhost:41004/api/categories/${categoryId}/articles`)
        .then(response => response.json())
        .then(articles => {
            const articleList = document.getElementById('articles');
            articleList.innerHTML = '';

            articles.forEach(article => {
                const articleItem = document.createElement('li');
                articleItem.textContent = article.titre;
                articleList.appendChild(articleItem);
            });
        })
        .catch(error => {
            console.error('Une erreur s\'est produite lors de la récupération des articles de la catégorie:', error);
        });
}


/* Fonction pour afficher les catégories dans l'interface */
function displayCategories(categories) {
    const categoryList = document.getElementById('categories');

    categories.forEach(category => {
        /* Création d'un lien pour chaque catégorie */
        const categoryLink = document.createElement('a');
        categoryLink.textContent = category.titre;
        categoryLink.href = '#'; // Ajout d'un lien fictif pour le fonctionnement des liens

        /* Attribution de l'ID de catégorie en tant qu'attribut de données pour le lien */
        categoryLink.dataset.categoryId = category.id;

        /* Ajout d'un gestionnaire d'événement au clic sur le lien de catégorie */
        categoryLink.addEventListener('click', (event) => {
            event.preventDefault(); // Empêcher le comportement par défaut du lien
            const categoryId = event.target.dataset.categoryId;
            updateArticleList(categoryId);
        });

        /* Création d'un élément <li> pour contenir le lien de catégorie */
        const categoryItem = document.createElement('li');
        categoryItem.appendChild(categoryLink);

        /* Ajout de chaque élément <li> à la liste des catégories */
        categoryList.appendChild(categoryItem);
    });
}
