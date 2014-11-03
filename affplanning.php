<?php

	require 'fonctions.php';
	
	// Récupérations de la requête GET
	// et vérification de la validité
	
	isValide($_GET['an'], $_GET['groupe'], $_GET['numsem']);

	$annee = $_GET['an'];
	$groupe = $_GET['groupe'];
	$numsem = $_GET['numsem'];

?>
<div class="container">
	<div class="jumbotron">
	<?php
		if($groupe == 0)
			echo '<center><h2 id="groupe">Année ' .$annee. '</h2></center>';
		else
			echo '<center><h2 id="groupe">Année ' .$annee. ' Groupe ' .$groupe. '</h2></center>';
		
		$gr = new Groupes($annee, $groupe);
		$pl = new Planning($gr->getId(), $numsem);
		$pl->listerSemaines();
		$pl->afficher();
	?>	
<script> 
	window.history.pushState('', '', '?an=' + <?php echo $annee;?> + '&groupe=' + <?php echo $groupe; ?> + '&numsem=' + <?php echo $numsem; ?>);
</script>
		
