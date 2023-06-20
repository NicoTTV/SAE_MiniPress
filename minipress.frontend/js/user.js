'use strict';


let auteurs; // Variable pour stocker les auteurs


/* Récupération des auteurs */
fetch('http://localhost:41004/api/user')
    .then(response => response.json())
    .then(users => {
        auteurs = users; // Stockage des auteurs dans la variable
        console.log(auteurs);
    })
    .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des auteurs:', error);
    });


/* Fonction pour obtenir un auteur par ID */
export function getAuteurById(auteurId) {
    const auteur = auteurs.find(auteur => auteur.id_user === auteurId);
    if (auteur) {
        console.log(Object.values(auteur));
        return auteur.pseudo;
    }
    // Gérer le cas où aucun auteur n'est trouvé avec l'auteurId spécifié
    return null;
}
