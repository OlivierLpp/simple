<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Chat</title>
    </head>
<body>	

<?php
// Effectuer ici la requête qui insère le message
// Puis rediriger vers minichat.php comme ceci :

try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$nom = htmlspecialchars($_POST['nom']);
$message= htmlspecialchars($_POST['message']);

$_SESSION['nom']= $nom ;


$req = $bdd->prepare('INSERT INTO commentaires (auteur, commentaire,date_commentaire) VALUES(?, ?, NOW())');
$req->execute(array($nom ,$message));
   

header('Location: chat.php');
?>
 	 </body>
</html>