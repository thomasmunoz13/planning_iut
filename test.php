<?php
require 'conf/db.php';
$result['ANNEE'] = 1;
$req2 = $db->query('SELECT COUNT(GROUPE) 
                  FROM GROUPE
                  WHERE ANNEE=' .$result['ANNEE']. '');

        // Récupération du résultat dans la variable $count
        
        $count = implode($req2->fetch(PDO::FETCH_ASSOC));
        echo $count;

    // Affiche la liste des années/groupes dans la barre de menu
        echo "lol";
while($result = $req2->fetch(PDO::FETCH_ASSOC))
{
  print_r($result);

echo $result['ANNEE'];
}




?>