<?php
/*******************************************************************************
Fonctionnement du script :

L'exercice se fait en deux temps :
1. CSS
- Deux captures d'écran présentent les pages intégrées, page_login.png et 
page_main.png, le rendu final doit se rapprocher le plus possible de ces
captures.

2. Développement
- Page de connexion
- Lors d'une connexion réussie, la date de dernière connexion est mise à jour et
on est redirigé sur la page principale si le mot de passe dans la base
correspond au mot de passe entré et si l'utilisateur fait partie du groupe 2.
Si l'authentification échoue, on retourne sur la page de connexion et un message
d'erreur s'affiche.
- Une fois connecté, une phrase mal orthographiée est affichée. Cliquer dessus la
corrige.
- On peut ensuite se déconnecter, on est alors redirigé vers la page de connexion.


Les modifications se font uniquement dans ce fichier index.php, dans le fichier style.css
et dans le fichier script.js.
Des images peuvent être ajoutées. Les fichiers html ne sont pas modifiables.
 *******************************************************************************/

// Affiche les erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoloader
spl_autoload_register(function ($class_name) {
    if (file_exists('src/Stdlib/' . $class_name . '.php')) {
        require 'src/Stdlib/' . $class_name . '.php';

        return true;
    } elseif (file_exists('src/Controller/' . $class_name . '.php')) {
        require 'src/Controller/' . $class_name . '.php';

        return true;
    } elseif (file_exists('src/Model/' . $class_name . '.php')) {
        require 'src/Model/' . $class_name . '.php';

        return true;
    }

    return false;
});

try {
    try {
        Router::dispatch();
    } catch (\Exception $e) {
        die($e->getMessage());
    }
} catch(\Exception $e) { ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-not-found">
                    <h3 class="page-not-found">
                        <?= 'Une erreur est survenue, veuillez réessayez ultérieurement.'; ?>
                    </h3>
                </div>
                <a href="" class="btn btn-danger btn-retour" style="float: right;">Retour</a>
            </div>
        </div>
    </div>

<?php } ?>