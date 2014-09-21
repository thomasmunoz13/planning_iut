<?php

class Groupes 
{
	// Représentent l'année et le groupe (correspondant à la base de données)

	var $id;
	var $annee;
	var $groupe;
	var $idtree;

	public function __construct($an = 2, $groupe = 3)
	{
		$this->annee = $an;
		$this->groupe = $groupe;

		// Connexion à la base de données
		require 'conf/db.php';

		// Exécution de la requête pour récup idTree
		$req = $db->query('SELECT ID, IDTREE
							  FROM GROUPE 
							  WHERE ANNEE=' .$this->annee. ' 
							  AND GROUPE=' .$this->groupe. '');

		// Récupération du résultat
		$result = $req->fetch(PDO::FETCH_ASSOC);
	
		$this->id = $result['ID'];
		$this->idtree = $result['IDTREE'];

	}// __construct()

	public function byId($id)
	{
		$this->id = $id;

		// Connexion à la base de données
		require 'conf/db.php';

		// Exécution de la requête pour récup idTree
		$idTree = $db->query('SELECT ANNEE, GROUPE, IDTREE 
							  FROM GROUPE 
							  WHERE ID = ' .$id. '');

		// Récupération du résultat
		$result = $idTree->fetch(PDO::FETCH_ASSOC);
		$this->annee = $result['ANNEE'];
		$this->groupe = $result['GROUPE'];
		$this->idtree = $result['IDTREE'];

	}// byId()

	public function getIdTree(){return $this->idtree;}
	public function getId(){return $this->id;}
	public function getAnnee(){return $this->annee;}
	public function getGroupe(){return $this->groupe;}

	public function listerGroupes()
	{
		// Fonction qui liste les groupes (LOL)
		// sous forme de menu (bootstrap)

		// Connexion à la base de données
		require 'conf/db.php';

		$req = $db->query('SELECT ANNEE, GROUPE
						   FROM GROUPE');

		// Affiche la liste des années/groupes dans la barre de menu

		while($result = $req->fetch(PDO::FETCH_ASSOC))
		{

			if($result['GROUPE'] == 0)
			{
				// Requete pour connaitre le nombre de groupes dans l'année courante
				$req2 = $db->query('SELECT COUNT(GROUPE) 
									FROM GROUPE
									WHERE ANNEE=' .$result['ANNEE']. '');

				// Récupération du résultat dans la variable $count
				
				$count = implode($req2->fetch(PDO::FETCH_ASSOC));

				// Parce qu'il y a toujours un groupe 0 (la promo entière)
				--$count;

			  	echo'<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		          Année ' .$result['ANNEE']. '
		          <span class="caret"></span></a>
		           <ul class="dropdown-menu" role="menu">
		            <li><a href="#" onclick="showPlanning(' .$result['ANNEE'].',' .$result['GROUPE'].',getParamValue(\'numsem\'));return false;">Année ' .$result['ANNEE']. '</a></li>
		            <li class="divider"></li>';
		    }
		    else 
		    {
		    	
		      	echo '<li><a href="#" onclick="showPlanning(' .$result['ANNEE'].',' .$result['GROUPE'].',getParamValue(\'numsem\')); return false;">Groupe ' .$result['GROUPE']. '</a></li>';
		         	
		        	// Pour le dernier groupe on ferme la liste
		           if($count == $result['GROUPE'])
		          		echo '</ul></li>';
		    }
		}


	}// listerGroupes()

}// Groupes

?>