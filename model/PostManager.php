<?php
class PostManager
{

  public function getPosts()
  {
    // Connexion à la base de données - $db est un objet PDO
    $db = $this->dbConnect();

    // Récupérer les billets sur la base de données
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    return $req;
  }


  public function getPost($postId)
  {
    // Connexion à la base de données - $db est un objet PDO
    $db = $this->dbConnect();

    // Récupérer un post en fonction de son ID avec une requête préparé
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
  }


  private function dbConnect()
  {
    $db = new PDO('mysql:host=localhost;dbname=miniblog;charset=utf8', 'root', 'root');
    return $db;
  }
}
