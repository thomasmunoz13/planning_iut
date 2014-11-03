<?php

        // Informations de connexion à la base de données
	try
	{
	    // Définition du type de SGBD ainsi que le nom de la base de données
		$dns = 'mysql:host=localhost;
				dbname=planning';
    
        // Nom d'utilisateur et mot de passe pour la connexion à la base de données
		$utilisateur = '';
		$mdp = '';
    
        // Initialisation de la connexion
		$db = new PDO ($dns, $utilisateur, $mdp);
		
	    // Activation des erreurs PDO
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch (Exception $e)
	{
		echo 'La connexion à la base de données a échouée : ', $e->getMessage();
		die();
	}