'use strict';


let auteurs; // Variable pour stocker les auteurs


/* Récupération des auteurs */
async function fetchAuteurs() {
    try {
        const response = await fetch('http://localhost:41004/api/user');
        auteurs = await response.json(); // Stockage des auteurs dans la variable
    } catch (error) {
        console.error('Une erreur s\'est produite lors de la récupération des auteurs:', error);
        throw error;
    }
}


/* Fonction pour obtenir un auteur par ID */
export async function getAuteurById(auteurId) {
    if (!auteurs) {
        await fetchAuteurs();
    }
    const auteur = auteurs.find(auteur => auteur.id_user === auteurId);
    if (auteur) {
        return auteur.pseudo;
    }
    // Gérer le cas où aucun auteur n'est trouvé avec l'auteurId spécifié
    return null;
}


export async function getAuteur(auteurPseudo) {
    if (!auteurs) {
        await fetchAuteurs();
    }
    const auteur = auteurs.find(auteur => auteur.pseudo.includes(auteurPseudo));
    if (auteur) {
        return auteur.id_user;
    }
    // Gérer le cas où aucun auteur n'est trouvé avec l'auteurId spécifié
    return null;
}