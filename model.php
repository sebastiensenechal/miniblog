<?php

function getPosts()
{
  // Connexion à la base de données
  try {
  	$bdd = new PDO('mysql:host=localhost;dbname=miniblog;charset=utf8', 'root', '');
  }
  catch(Exception $e) {
          die('Erreur : '.$e->getMessage());
  }

  // Récupérer les billets sur la base de données
  $req = $bdd->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

  return $req;
}



function getPost()
{
  // Récupérer un post en fonction de son ID
}


function getComments()
{
  // Récupère un commentaire associé à un ID
}
