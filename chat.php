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

	<p>
	Minichat.<br />
	</p>
	

	<form action="chatpost.php" method="post">
		<p>
			Pseudo :  <input type="text" name="nom" id="nom" value= "<?php echo htmlspecialchars ($_SESSION['nom']); ?>" /><br />
			Message : <input type="text" name="message" id="message" />
			<input type="submit" value="Valider" />
		</p>
	</form>	

	<?php
		try
		{
			// On se connecte à la base de données
			$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
				die('Erreur : '.$e->getMessage());
		}

		// On récupère tout le contenu de la table jeux_video
		$reponse = $bdd->query('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires ORDER BY date_commentaire DESC');

		// On affiche chaque entrée une à une
		while ($donnees = $reponse->fetch())
		{
				?>
				<p>
				Le <?php echo $donnees['date_commentaire_fr']; ?>:
				<strong><?php echo htmlspecialchars ($donnees['auteur']); ?></strong> :
				<?php echo htmlspecialchars ($donnees['commentaire']); ?><br />
				</p>
			<?php
		}

		$reponse->closeCursor(); // Termine le traitement de la requête

	?>

 	 </body>
</html>