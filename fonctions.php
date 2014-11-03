<?php
	function isValide(&$annee, &$groupe, &$numsem)
	{
		// Cette fonction vérifie si les données reçues via
		// GET sont correctes et les change si besoin

		if(!is_numeric($groupe) || empty($groupe) && $groupe != 0)
			$groupe = 3;

		if(empty($annee) || !is_numeric($annee))
			$annee = 2;

		if(empty($numsem) || $numsem > 47 || !is_numeric($numsem))
		{
			// On vérifie quelle semaine pour savoir quelle conversion
			// appliquer

			if(date('W') < 35)
				$numsem = date('W') + 17; // 2015
			else
				$numsem = date('W') - 35; // 2014

			// Si c'est dimanche on passe à la semaine suivante
			// Si c'est samedi et plus de 12h on passe à la semaine suivante

			if(date('w') == 0 || date('w') == 6 && date('G') > 12)
				++$numsem;
		}


		require 'conf/db.php';

		$req = $db->query('SELECT COUNT(ID) 
						   FROM GROUPE
						   WHERE ANNEE=' .$annee.'
						   AND GROUPE=' .$groupe. '');

		$count = implode($req->fetch(PDO::FETCH_ASSOC));

		if($count == 0)
		{
			// Si c'est vide, on complète avec le groupe #SWAG

			$annee = 2;
			$groupe = 3;
		}

	}// isValide()
?>