# Journal de bord 📖  

## 🟣03.05.2021
**7h30** : Début du TPI. J'ai commencé cette première journée en fixant les objectifs pour la journée et je ferai cette démarche tous les matins. Aujourd'hui, l'objectif est de prendre connaissance des infos principales présentes dans l'énoncé (Matériel à dispo, descriptif du projet, livrables) et d'en déterminer l'ensemble des tâches à réaliser pour mener à bien le projet, et ensuite me mettre à la doc. selon le temps à disposition. La première étape de la méthode des 6 étapes, *S'informer*, devrait donc être effectuée à la fin de la matinée. 

**8h30** : J'ai une question par rapport à l'énoncé qui spécifie un nombre précis d'heures pour respectivement l'analyse, l'implémentation, les tests et la documentation, suis-je obligé de les respecter à la lettre dans mon planning ? J'ai posé la question à Mr. Jossi, et il m'a répondu que c'était pour donner un ordre d'idée afin de m'aider à réaliser mon planning. Je peux donc procéder à la création de ce dernier en gardant à l'esprit ces estimations pour ne pas me retrouver avec un planning irréaliste.

**9h40** : Je pense avoir terminé la liste des tâches et le planning prévisionnel du projet. Je pense qu'il est assez réaliste. J'ai également créé le dépôt GitHub du projet. Je vais en pause. 

**10h05** :  Je me mets à la documentation avec un squelette fait durant les cours d'atelier de préparation précédant la semaine du TPI. Il contient des chapitre généraux que l'on retrouve dans toutes les documentations que j'ai déjà pu effectuer : *Sommaire, Introduction, Rappel de l'énoncé, Diagrammes de Gantt, Fonctionnalités principales, Bibliographie/Source.*

**10h55** : Je crée le journal de bord et je commence par y ajouter ce que j'ai fait depuis le début ce matin. Je suis toujours sur la doc. 

**12h40** : De retour de pause, je me remets sur la doc, j'ai déjà plus ou moins terminé les chapitres *Sommaire* et *Rappel de l'énoncé* car étant assez basiques. 

**13h20** : Je me suis mit à faire les visuels que je mettrai dans la doc tels que les maquettes utilisateur de chaque page du site et les pages de titre de chaque chapitre de la doc. 

**14h15** : J'ai fini la plupart des maquettes vues utilisateur (manque 2 ou 3). J'aimerais bien trouver un moyen de mettre des pages de titre entre chaque gros chapitre dans ma documentation pour faciliter la navigation du lecteur, mais j'ai un problème avec l'en-tête qui gêne. Je règlerai ce problème plus tard, ma priorité était d'avancer un maximum sur la documentation et tout ce qui est autour pour avoir une bonne base et pouvoir commencer l'implémentation tranquillement ensuite.

**14h50** : J'ai rapidement check ce que j'avais fait jusqu'à maintenant en corrigeant certaines choses. Je vais créer le squelette du projet dans Visual Studio Code et débuter l'implémentation gentiment. Je retournerai peut-être à la documentation plus tard si je pense avoir un bon début pour aujourd'hui. Dans tous les cas, je pense que les objectifs que je m'étais fixé pour la journée sont remplis. J'ai crée le dépôt, la liste des tâches, le planning prévisionnel, une première partie de la documentation et je m'attaque maintenant au code.  

**15h30** : Après demande à mon maître d'apprentissage, je dois bien lui envoyer mon travail effectué à la fin de la journée. Je vais continuer mon début d'implémentation en cette fin d'après-midi avant de lui envoyer.

**16h40** : Fin de la première journée, j'ai fini la base de données et j'ai commencé l'implémentation.

## 🟣04.05.2021
**7h30** : J'avais un petit trou de mémoire concernant l'utilisation de bootstrap alors j'ai regardé une ou deux vidéos explicatives sur le chemin de l'école. Je vais me concentrer sur la maquette du style à appliquer à toutes mes pages pour l'instant et je passerai à l'implémentation des pages en elles-même plus tard. Pour aujourd'hui, je vais me fixer l'objectif d'avoir un style complet pour toutes mes pages, une page d'accueil redirigeant vers les autres pages correctement, et une création d'utilisateur qui fonctionne correctement avec la base de données.

**9h40** : La page d'accueil est terminée et redirige correctement vers les autres pages (vides pour le moment). J'ai un bon début de style bootstrap avec une barre de navigation qui fonctionne comme prévu dans les maquettes vue utilisateur. A voir la partie bdd maintenant.

**11h40** : Le style est finalisé, je suis passé sur la création d'utilisateur. Le formulaire est créé et je suis en train de gérer toutes les exceptions telles que "syntaxe email incorrecte" ou encore "les 2 mdp ne concordent pas". Je continuerai après ma pause.
  
**12h40** : Je continue comme prévu là-dessus.

**16h40** : J'ai continué à travailler sur le formulaire de création d'utilisateur, il y a un problème au niveau de l'ordre dans lequel les données sont enregistrées que j'ai détecté, je le règlerai demain matin. À part ça, le formulaire et ses conditions fonctionnent. L'objectif de la journée est presque entièrement rempli, le style s'applique correctement aux pages du site, la page d'accueil est complète et redirige vers chaque autre page. J'ai malheureusement perdu un peu de temps sur le formulaire à cause d'erreurs bêtes de requètes de la base de données, mais je suis quand même satisfait d'avoir rempli mes objectifs de la journée dans les temps du planning prévisionnel.

## 🟣05.05.2021
**7h30** : Début de la journée, je vais me concentrer sur le fait de régler ce problème de formulaire register. Pour résumer, la table utilisateur est réglée de telle sorte à ce qu'elle doive reçevoir les données dans cet ordre précis : idUtilisateur, pseudo, mot de passe, email, admin. Le problème est simplement que j'envoie l'email à la place du mdp et vice-versa. Une fois ce problème réglé, je passerai sur la page login afin d'accorder les 2. J'essaierai d'avancer le plus possible sur cette dernière, l'objectif étant (selon le planning prévisionnel) d'avoir les 2 pages entièrement fonctionnelles avant demain soir.

**7h59** : J'ai réussi à régler le problème dans le code comme dans la base de données, un autre problème était que j'avais réglé le champ "mot de passe" de telle sorte à ce qu'il n'accepte que des chaines d'une 40aine de caractères, n'ayant pas prévu que j'allais le hasher avant de l'insérer (c'est à dire le transformer en une chaine de caractères aléatoires pour le protéger mais par conséquent augmenter considérablement son nombre de caractères).

**8h04** : Après phase de test, toutes les fonctionnalités du formulaire register marchent sans exception. Je me mets maintenant au login afin de compléter tout le côté login/register et pouvoir passer plus tard au coeur du site : le forum.

**9h40** : Le formulaire de login demande bien le pseudo, mot de passe et email de l'utilisateur et il respecte les mêmes critères de validité que sur la page Register. Je continuerai après ma pause.

**11h40** : J'ai bien avancé sur le login et je pense pouvoir finaliser ça dans l'après-midi. Si c'est le cas, il me restera à faire fonctionner la gestion d'utilisateurs dans son ensemble(création, connection, accès aux pages selon si connecté ou non, possibilité de se déconnecter lorsque connecté, etc...) et tester le tout. 

**12h40** : Je continue comme prévu sur le login.

**13h15** : J'arrive à faire passer les informations dans la boucle et à renvoyer un message de confirmation de login, mais les données n'arrivent nul part et on ne se connecte pas. Aussi, on peut entrer n'importe quelles données et la confirmation de connexion s'affichera quand même, ce qui n'est pas bon. Je continue.

**14h35** : La session retient bien toutes les infos entrées (pseudo, mdp, email). A partir de là, le reste devrait poser moins de problèmes. 

**16h40** : Lorsqu'on se login, les infos sont retenues et gardées à travers toutes les pages, ce qui fait que l'utilisateur est bien connecté. La page déconnexion marche parfaitement également. Il reste ce problème de validation du login que je dois régler. J'ai déjà créé le formulaire de création de critique.

## 🟣06.05.2021
**12h40** : Je ne me suis pas rendu à l'école ce matin, ne me sentant pas bien ni en mesure de travailler. Je reprends donc le travail maintenant, avec pour objectif de boucler cette partie login avant la fin de l'après-midi. 
 
 **13h38** : J'ai demandé à Mr.Jossi si le fait que le formulaire login ne demande que le mot de passe et l'email posait problème, et il m'a repondu que non, car la plupart des sites marchent en effet de cette manière. Cela m'arrange, car mes fonctions posaient problème à ce niveau, et désormais, je n'ai qu'à vérifier si l'user existe selon le mdp et l'email qu'on a entré.  
 
**13h45** : Problème : il faut recupérer et faire passer le pseudo aussi lorsqu'on se connecte avec un mdp et un email, ce qui ne se passe pas pour l'instant. Les autres données sont bien envoyées sur les autres pages aussi.

**14h30** : Visioconférence avec les experts. J'ai fait une mise au point avec eux. Pour le moment, aucun problème ou confusion à signaler. Je continue mon travail en espérant finaliser cette tâche avant demain.

**14h54** : J'ai réglé le problème cité à **13h45**, désormais, le pseudo passe également si on arrive à se connecter. J'ai cependant un autre problème : On peut se connecter au site avec le mot de passe d'un compte et l'email d'un autre. La tâche avance, désormais, seules les infos existantes dans la bdd sont acceptées. Maintenant, il faut qu'elles concordent.

## ⚪Congé du 07-09.05.2021

## 🟣10.05.2021
**7h40** : Je dois avouer que la perte de temps sur la page login m'a légèrement stressé. Ce weekend, j'ai pensé à certaines manières de régler le problème de vérifications des champs que me pose cette page depuis quelques jours, et je les ai testé en arrivant ce matin. Changer la condition de verification des champs était bien la chose à faire mais je ne trouvais pas comment. Je l'ai changé afin qu'elle vérifie la taille de l'array (tableau de données) qu'envoyait le bouton submit sur lequel on clique. Si elle est de 0, ça veut dire que l'array est vide et que, par conséquent, on a envoyé aucune donnée et le login a échoué. Cette méthode marche pour le moment. J'ai donc réglé le problème de la page login et peux passer à l'implémentation du reste du site pour le moment. Mon objectif de la journée serait d'avoir un début de page "Créer un post" avec une liste de films insérée dans la base de données. Le formulaire devrait nous proposer de choisir un film existant dans la bdd et de rédiger une critique avec une note à son sujet. Je vais commencer par ajouter les films dans la bdd.

**8h30** : Je me demande comment ajouter une image dans le champ du même nom manuellement dans la bdd. Je sais comment m'y prendre lorsqu'il s'agit d'en ajouter une via un formulaire, mais ici ce n'est pas le cas. J'ai donc posé la question à M. Jossi. En attendant la réponse, je continue sur la documentation.

**10h05** : J'ai reçu un appel de M. Jossi pour réponde à ma question. Il m'a également donné des conseils sur la structure de mon git. J'ai noté : des liens pas à jour, de la redondance (plusieurs répertoires pour la même chose), le code en .zip au lieu d'être en dur.

**12h40** : J'ai le style de la page et la bdd.

**15h30** : M. Jossi m'a communiqué par mail une liste de choses qui ne vont pas dans mon travail et que je dois améliorer comme un planning mauvais ou des requètes SQL pas toujours sécurisées entre autres. Je m'arrête de travailler sur ce que je faisais jusqu'à ce que tout soit réglé. L'objectif est de régler cela avant sa visite prévue pour mercredi. 

## 🟣11.05.2021
**7h30** : Comme prévu, je vais me concentrer sur les problèmes pointés par M. Jossi avant de me remettre sur les pages sur lesquelles je travaille. 

**8h46** : J'ai posé plusieurs questions à mon maître d'apprentissage sur l'énoncé et le planning prévisionnel, j'aurais besoin de sa réponse pour savoir si les modifications sont valides. En attendant, je continue sur la documentation pour m'avancer au maximum. 

**11h40** : J'ai fait une nouvelle version de mes plannings et continué la documentation. Je continuerai sur la correction des problèmes pointés par M. Jossi pendant l'après-midi.

**16h40** : J'ai bien avancé sur la page de création de posts, je devrais pouvoir la faire marcher demain. Afficher ces derniers sur la page Forum ne devrait pas poser de problèmes non-plus. Je testerai certaines choses demain matin pour finaliser la page création de posts.

## 🟣12.05.2021
**7h30** : Aujourd'hui, mes objectifs sont de finaliser la page de création de posts et avancer le plus possible sur le reste.

**9h19** : J'ai réglé plusieurs problèmes :  
Général : Il est maintenant impossible de se rendre sur les pages suivantes sans être connecté : Profil, Créer post, Déconnexion.
Page login : le pseudo était mal envoyé ce qui faisait que je ne pouvais le récuperer dans les autres pages comme la page profil (pour le modifier notamment). C'est désormais réglé.
Page profil : Les informations de l'utilisateur apparaissent dans son profil et devraient bientôt être modifiables.
Page créer post : Les informations du post sont bien récupérées après qu'on ait cliqué sur le bouton submit. Il reste maintenant à régler les conditions de validation pour qu'elles soient envoyées dans la base.

**12h40** : Il semblerait qu'il y ait deux ou trois erreurs dans mes fonctions qui posent problème dans la modification d'utilisateur ainsi que dans la création de posts. Je dois me renseigner sur comment les faire marcher avec ma base de données. Si je les règle, deux des plus grosses tâches du projet seront accomplies, et il ne me restera que :  
🔴 La lecture de posts : simple echo de code HTML avec dedans les données de post récupérées précédemment.   
🔴 L'affichage de notre vidéothèque : pareil mais ici avec la modification/suppression en plus. Une fois ma fonction de modification d'utilisateur finie, il ne me restera qu'à l'adapter aux données d'un film à la place.  
🔴 La page info des films : Ici aussi, simple code html comblé par les données du film en question. 

Après cela, une phase de tests devrait 
## ⚪Congé du 13-16.05.2021

## 🟣17.05.2021

## 🟣18.05.2021

## 🟣19.05.2021

## 🟣20.05.2021  
