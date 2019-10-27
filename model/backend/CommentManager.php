<?php
namespace SebastienSenechal\Miniblog\Model\Backend; // La classe sera dans ce namespace


require_once('model/backend/Manager.php');


class CommentManager extends Manager
{
  public function getComments($id_post)
  {
    // COnnexion à la base de données - $db est un objet PDO
    $db = $this->dbConnect();

    // Récupère un commentaire associé à un ID avec une requête préparé
    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($id_post));

    return $comments;
  }


  public function postComment($id_post, $author, $comment)
  {
    // Connexion à la base de données - $db est un objet PDO
    $db = $this->dbConnect();

    // Requête pour insérer les données dans la base
    $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($id_post, $author, $comment)); // L'ID du commentaire et la date sont généré automatiquement

    return $affectedLines;
  }


  public function getLastComment()
  {
    $db = $this->dbConnect();

    $comment = $db->query('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT 0, 3');

    return $comment;
  }

}
