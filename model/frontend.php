<?php

function getPosts()
{
  // Connexion à la base de données - $db est un objet PDO
  $db = dbConnect();

  // Récupérer les billets sur la base de données
  $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

  return $req;
}



function getPost($postId)
{
  // Connexion à la base de données - $db est un objet PDO
  $db = dbConnect();

  // Récupérer un post en fonction de son ID avec une requête préparé
  $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
  $req->execute(array($postId));
  $post = $req->fetch();

  return $post;
}



function getComments($postId)
{
  // COnnexion à la base de données - $db est un objet PDO
  $db = dbConnect();

  // Récupère un commentaire associé à un ID avec une requête préparé
  $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
  $comments->execute(array($postId));

  return $comments;
}


function dbConnect()
{
  try
  {
    $db = new PDO('mysql:host=localhost;dbname=miniblog;charset=utf8', 'root', 'root');
    return $db;
  }
  catch(Exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }
}
