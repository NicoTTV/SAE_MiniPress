'use strict';


import {getAuteur, getAuteurById} from "./user.js";
import {status2} from "./recherche.js";


export let articles; // Variable pour stocker les articles
export let activable=true;
export let categoID;


/* Récupération des articles */
fetch('http://localhost:41004/api/articles')
    .then(response => response.json())
    .then(data => {
        articles = data.articles; // Stockage des articles dans la variable

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
    activable=false;
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

    /* Résumé */
    const summary = document.createElement('p');
    summary.textContent = markdownParser(article.resume);
    fullArticleContainer.appendChild(summary);

    /* Image */
    const image = document.createElement('img');
    image.src = '/img/' + article.image;
    fullArticleContainer.appendChild(image);

    /* Contenu */
    const content = document.createElement('p');
    content.textContent = markdownParser(article.contenu);
    fullArticleContainer.appendChild(content);

    /* Ajout de l'article complet à la liste des articles */
    articleList.appendChild(fullArticleContainer);
}


/* Fonction pour afficher les articles */
export async function displayArticles(arti) {
    activable=true;
    const articleList = document.getElementById('articles');
    //articleList.innerHTML = ''; // Réinitialisation de la liste des articles
    const fake = document.createElement('ul');
    fake.setAttribute('id','articles');

    /* Affichage pour chaque article */
    for (const article of arti) {
        const articleItem = document.createElement('div');

        /* Titre */
        const title = document.createElement('h2');
        title.textContent = article.titre;
        title.addEventListener('click', async (event) => {
            const articleUrl = article.links.self.href;
            // Récupération de l'URL de l'article
            const response = await fetch(`http://localhost:41004${articleUrl}`)
                .then(response => response.json())
                .then(art => {
                    return art.article[0];
                });
            await displayFullArticle(response);
        });
        articleItem.appendChild(title);

        /* Date de création */
        const creationDate = document.createElement('p');
        creationDate.textContent = `Date de création : ${article.date_de_creation}`;
        articleItem.appendChild(creationDate);

        /* Auteur */
        const author = document.createElement('p');
        const pseudo_user = await getAuteurById(article.id_user);
        author.textContent = `Auteur : ${pseudo_user}`;
        author.addEventListener('click',async (event)=>{
            categoID = articles.filter(item => item.id_user && item.id_user.includes(article.id_user));
            displayArticles(categoID);
        });
        articleItem.appendChild(author);

        /* Ajout d'un gestionnaire d'événement au clic sur le titre de l'article */

        /* Ajout de l'article à la liste */
        fake.appendChild(articleItem);
    }
    articleList.innerHTML = fake.innerHTML;
}


/* Fonction pour mettre à jour l'affichage des articles */
export function updateArticleList(categoryId) {
    activable=true;
    if (categoryId === 'all') {
        categoID=articles;
        displayArticles(articles); // Afficher tous les articles
    } else {
        // Récupérer les articles de la catégorie sélectionnée
        fetch(`http://localhost:41004/api/categories/${categoryId}/articles`)
            .then(response => response.json())
            .then(category => {
                category.articles.sort((a, b) => new Date(b.date_de_creation) - new Date(a.date_de_creation));
                const articlesByCategory = category.articles;
                categoID=articlesByCategory;// Récupérer les articles de la catégorie
                displayArticles(articlesByCategory);
            })
            .catch(error => {
                console.error('Une erreur s\'est produite lors de la récupération des articles de la catégorie:', error);
            });
    }
}


document.getElementById("myForm").addEventListener("submit", async function (event) {
    event.preventDefault(); // Empêche le rechargement de la page
    const myInput = document.getElementById('myInput');
    const inputValue = myInput.value.toLowerCase();
    const filteredByTitre = articles.filter(item => item.titre.toLowerCase().includes(inputValue));
    if (status2 === 1) {
        categoID = filteredByTitre;
    } else {
        const filteredByResume = articles.filter(item => item['resume'].toLowerCase().includes(inputValue));
        categoID = [...new Set([...filteredByTitre, ...filteredByResume])];
    }
    displayArticles(categoID);
});

function markdownParser(text){
    const toHTML = text
        .replace(/^### (.*$)/gim, '<h3>$1</h3>') // h3 tag
        .replace(/^## (.*$)/gim, '<h2>$1</h2>') // h2 tag
        .replace(/^# (.*$)/gim, '<h1>$1</h1>') // h1 tag
        .replace(/\*\*(.*)\*\*/gim, '<b>$1</b>') // bold text
        .replace(/\*(.*)\*/gim, '<i>$1</i>'); // italic text
    return toHTML.trim(); // using trim method to remove whitespace
}