'use strict';

import { updateArticleList } from './article.js';

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


/* Affichage des catégories dans l'interface */
function displayCategories(categories) {
    const categoryList = document.getElementById('categories');

    /* Création d'un lien pour afficher tous les articles (catégorie "all") */
    const allCategoryLink = document.createElement('a');
    allCategoryLink.textContent = 'Tous les articles';
    allCategoryLink.href = '#';
    allCategoryLink.dataset.categoryId = 'all';
    allCategoryLink.addEventListener('click', (event) => {
        event.preventDefault();
        const categoryId = event.target.dataset.categoryId;
        updateArticleList(categoryId);
    });

    const allCategoryItem = document.createElement('li');
    allCategoryItem.appendChild(allCategoryLink);
    categoryList.appendChild(allCategoryItem);

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




