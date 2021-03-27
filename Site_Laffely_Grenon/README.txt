Bonjour M.Lesaint

Pour commencer vous allez devoir importer le fichier club.sql dans votre phpmyadmin MYSQL et non MariaDB.

Ensuite vous allez devoir rentrer vos identifiants dans le fichier "identifiants.txt".
Veuillez bien les mettre entre les guillemets déja disposé.

Et voila ! Vous n'avez plus qu'a ouvir le dossier racine du projet (Site_Laffely_Grenon) dans votre local host !

Pour vous connecter vous avez deux paires d'identifiants , une en tant que secretaire et l'autre en tant qu'Entraineur.

Secretaire : DLesaintS ViveLinfo49
Entraineur : DLesaintE ViveLinfo49

// Notre Projet

Disclaimer ! Par manque de temps nous ne nous sommes pas concentrer sur la beauté du site mais sur les fonctionnalités demandé !
De plus nous vous recommandons d'utiliser firefox qui est plus rapide pour l'affichage de certaines pages.

Bievenue sur le site de l'AC Grelaf (Grenon et Laffely)

Pour chaque input de type date vous ne pouvez entrer que des dimanches.

La page d'accueil affiche toutes toutes les convocations qui ont été valider par l'entraineur.

Lorsque vous vous connecter vous arrivez sur une page vierge et vous avez à disposition plusieurs bouttons qui correspondent à chaque page.

La page de convocations permet à l'entraineur de gerer chaque rencontre pour une date donné (3 matchs maximum par date).
Une convocation peut etre enregistrer en tant que brouillon si par exemple il n'a pas encore choisi la totalité des joueurs qui participeront au match.
Ou encore si l'heure du match n'est pas encore défini. Chaque enregistrement de brouillon ecrase la précédente pour la même rencontre.
L'entraineur peut valider une convocation avec un nombre de joueurs situé entre 11 et 14 inclus. Lorsque une convocation est valider il ne peut plus choisir de joueurs ni enregistrer de brouillon.
Le secretaire n'a accès à la page qu'en lecture.
Certaines convocations sont déja réaliser comme vous pourrez le constater.

Le calendrier permet à la secretaire de modifier toutes les rencontres qu'elle désire.
Il faut appuyer sur le bouton en bas de la page pour enregistrer les modifications.
Cependant, chaque date ne peux accueillir que 3 matchs (1 par senior).
Pour une date donné, plusieurs equipes ne peuvent pas avoir le même adversaires et ne peuvent pas jouer sur le meme couple (terrain site).
Toutes ces exceptions sont prisent en compte par le site et vous prévient.
La secretaire peut également supprimer ou ajouter des rencontres.
Attention ! De base le calendrier est complet donc à chaque ajout vous aurez des incohérences et donc vous ne pourrez pas créer de convocations pour ces matchs.
Il faut donc d'abord supprimer des rencontres pour ensuite en rajouter.
L'entraineur peut uniquement lire cette page.

La page d'effectif est une page simple qui affiche tous les joueurs inscrit au club avec une posibilité d'ajouter un joueur pour la secrétaire.
L'entraineur ne peut pas ajouter de joueur.

La page qui contient le planning des absences est une page qui affiche tous les joueurs du club pour chaque date et qui permet de modifier le status d'absences de chaque joueur.
Si vous voulez sauvegarder les modifications et changer de date , il faut d'abord sauvegarder avec le bouton situer en bas du tableau.
Tous les roles peuvent faire des modifications.

///

Le code n'est pas optimisé par manque de temps. Nous nous excusons donc d'avance pour ce code assez "indigeste" (notamment pour le fichier javascript).
