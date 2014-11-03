<?php
class Planning
{
	// Représentent les attributs de la table planning

	var $id;
	var $numsem;
	var $lastsave;

	// Identifiant pour le planning
	var $identifier;

	public function __construct($id = 10, $numsem = 1)
	{
		// Récupération des différentes informations
		if(is_numeric($_GET['an']) && $_GET['an'] < 3 )
			$annee = $_GET['an'];
		else
			$annee = 2;

		if(is_numeric($_GET['groupe']) && $_GET['groupe'] < 6)
			$groupe = $_GET['groupe'];
		else
			$groupe = 3;

		if(is_numeric($_GET['numsem']) && $_GET['numsem'] < 60)
			$numsem = $_GET['numsem'];
		else
			$numsem = intval($_GET['numsem']);

	
		$this->id = intval($id);
		$this->numsem = intval($numsem);

		// Connexion à la base de données
		require 'conf/db.php';

		// Récupération de la dernière sauvegarde
		$ls = $db->query('SELECT LASTSAVE
						  FROM PLANNING
						  WHERE ID =' .$this->id. '
						  AND NUMSEM=' .$this->numsem. '');
		
		$lst = $ls->fetch(PDO::FETCH_ASSOC);

		// Vérifie si le timestamp est nul ou non (pour les planning non enregistrés)

		if(!empty($lst))
			$this->lastsave = implode($lst);
		else
			$this->lastsave = 0;

		$this->identifier = file_get_contents('conf/ident');

	}// __construct()

	// Getters

	public function getLastSave(){return $this->lastsave;}
	public function getId(){return $this->id;}
	public function getNumSem(){return $this->numsem;}

	public function isSaved()
	{
		// Fonction qui permet de savoir si un planning a été sauvegardé ou non

		// Connexion à la base de données
		require 'conf/db.php';

		$req = $db->query('SELECT COUNT(ID) 
						   FROM PLANNING
						   WHERE ID=' .$this->id. ' 
						   AND NUMSEM=' .$this->numsem.'');

		// Récupération du résultat
		$res = implode($req->fetch(PDO::FETCH_ASSOC));

		if($res == 0)
			$result = false;
		else
			$result = true;

		return $result;

	}// isSaved()

	// Setters

	private function setLastSave($ls){$this->lastsave = $ls;}
	private function setNumSem($ns){$this->numsem = $ns;}

	private function save()
	{
		
		// Fonction qui sauvegarde l'image du planning, met à jour la base de données
		// fait le café et vous cire les chaussures.
		// retourne si la sauvegarde s'est bien passé ou non


		// Nommage du fichier
		$nom = 'img_planning/' .$this->id. '_' . $this->numsem. '.png';
		$fp = fopen ($nom, 'w+');
		
		// Récupération des infos du groupe en question
		$gr = new Groupes();
		$gr->byId($this->id);

		// URL du fichier
		$url = 'http://planning.univ-amu.fr/ade/imageEt?identifier=' .$this->identifier. '&projectId=8&idPianoWeek=' .$this->numsem. '&idPianoDay=0,1,2,3,4,5&idTree=' 
		.$gr->idtree. '&width=900&height=600&lunchName=REPAS&displayMode=1057855&showLoad=false&ttl=1405063872880000&displayConfId=59';
		 
		// timeout pour éviter les requêtes trop longues
		$ch = curl_init(str_replace(" ","%20",$url));
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		 
		// On écrit #SWAG
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		
		// Réponse de la requete (au cas où on en aurait quelque chose à foutre :D)
		$data = curl_exec($ch);

		// Done
		curl_close($ch);
		if(filesize($nom) != 0)
		{
			// Connexion à la base de données
			require 'conf/db.php';

			if($this->isSaved())
				$db->exec('UPDATE PLANNING
						   SET LASTSAVE =' .date('U'). '
						   WHERE ID = ' .$this->id. '
						   AND NUMSEM = ' .$this->numsem. '');
			else
				$db->exec('INSERT INTO PLANNING
						   VALUES (' .$this->id.',' .$this->numsem. ',' .date('U'). ')');
			$result = true;
		}
		else
			$result = false;

		return $result;
	}// save()

	public function afficher()
	{
		// Fonction qui affiche le planning, tout en determinant si il faut save ou non.
		// Elle ne retourne que la balise <img> avec le lien de l'image

		require 'conf/db.php';
		// On vérifie si le fichier est déjà dans la base ou non

		if($this->isSaved())
		{
			// On vérifie si la sauvegarde est récente ou non (ici - de 15 minutes)
			$lastmaj = time() - $this->lastsave;
			
			if($lastmaj > 900)
				$this->save();

			// Si lastmaj < 600s inutile de sauvegarder à nouveau
		}
		else
			$this->save();
		// Si la sauvegarde est impossible et que le fichier est indispo sur l'ENT
		// alors c'est un peu dommage (mais un script de sauvegarde sera bientôt dispo
		// pour corriger ce problème et éviter des plannings indisponibles)

		$nom = 'img_planning/' .$this->id. '_' . $this->numsem. '.png';

		$balise = '<img class="img-responsive" src="' .$nom. '" alt="planning">';

		echo $balise;

	}// afficher()

	public function listerSemaines()
	{
		// Cette fonction permet de lister les semaines en affichant celles stockées dans la BD

		// Connexion à la base de données
		require 'conf/db.php';

		$req = $db->query("SELECT ID, TITRE 
						   FROM SEMAINE");

		// Début de la liste déroulante ...
        echo '<form method="GET" action="index.php">';
        echo '<center><label>Sélectionner la semaine : </label><center>';
        echo '<select class="liste" name="semaine" onchange="listeSemaine(this.value)">';

		while($result = $req->fetch(PDO::FETCH_ASSOC))
		{
			if($result['ID'] == $this->numsem)
               echo '<option value="' .$result['ID']. '" selected="selected">';
            else
               echo '<option value="' .$result['ID']. '">';

           	echo $result['TITRE'];
           	echo '</option>';
		}
        echo '</select>';
        echo '</form>';

	}

}// Planning
?>
