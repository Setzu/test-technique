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

ini_set('display_errors', 0);

mysql_connect('localhost', 'blanchard_4cfy9', 'wVCeoW64uPCHDH9zoy7GJkXP70pSnJPT');
mysql_select_db('blanchard_4cfy9');

session_start();


if($_GET['action'] == 'login') {
	$result = mysql_query('SELECT * FROM user WHERE username = "'.$_POST['username'].'"');
	$set = mysql_fetch_array($result);
	if($set['password'] == md5($_POST['password'])) {
		$_SESSION['id_user'] = $set['id_user'];
		// TODO: Rediriger vers la page principale
	}
} elseif($_GET['action'] == 'logout') {
	session_destroy();
	// TODO: Rediriger vers la page de login
} elseif(isset($_SESSION['id_user'])) {
	echo str_replace(array_keys($params), $params, file_get_contents('main.html'));
} else {
	echo str_replace(array_keys($params), $params, file_get_contents('login.html'));
}
?>
