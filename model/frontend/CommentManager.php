<?php
namespace SebastienSenechal\Miniblog\Model\Frontend; // La classe sera dans ce namespace


require_once('model/frontend/Manager.php');


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

  public function getComment($id_comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments WHERE id= ?');
        $comments->execute(array($id_comment));
        $comment = $comments->fetch();
        return $comment;
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

  public function reportComment($id_comment)
  {
      $db = $this->dbConnect();
      $comments = $db->prepare('UPDATE comments SET reporting= :reporting WHERE id= :id_comment');
      $comments->bindValue(':reporting', 1, \PDO::PARAM_INT);
      $comments->bindParam(':id_comment', $id_comment, \PDO::PARAM_INT);
      $report = $comments->execute();
      return $report;
  }
  public function updateComment($id_comment, $id_post, $author, $comment)
  {
      $db = $this->dbConnect();
      $comments = $db->prepare('UPDATE comments SET id_post= :id_post, author= :author, comment= :comment, comment_date= NOW() WHERE id= :id_comment');
      $comments->bindParam('id_post', $id_chapter, \PDO::PARAM_INT);
      $comments->bindParam('author',$author, \PDO::PARAM_STR);
      $comments->bindParam('comment',$comment, \PDO::PARAM_STR);
      $comments->bindParam('id_comment', $id_comment, \PDO::PARAM_INT);
      $updateComment = $comments->execute();
      return $updateComment;
  }

}
