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
    $comments = $db->prepare('SELECT id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? AND reporting = 0 ORDER BY comment_date DESC');
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


  public function postComment($postId, $author, $comment)
  {
    // Connexion à la base de données - $db est un objet PDO
    $db = $this->dbConnect();

    $comment = str_replace('<script', '&lt;script', $comment);
    $comment = str_replace('</script', '&lt;/script', $comment);
    $comment = str_replace('<?', '&lt;?', $comment);
    $comment = str_replace('?>', '>&gt;', $comment);

    // Requête pour insérer les données dans la base
    $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $comment)); // L'ID du commentaire et la date sont généré automatiquement

    return $affectedLines;
  }

  public function reportComment($id_comment)
  {
      $db = $this->dbConnect();

      $comments = $db->prepare('UPDATE comments SET reporting = 1 WHERE id= ?');
      $report = $comments->execute(array($id_comment));

      return $report;
  }


  public function updateComment($id_comment, $id_post, $author, $comment)
  {
      $db = $this->dbConnect();

      $comments = $db->prepare('UPDATE comments SET post_id= :id_post, author= :author, comment= :comment, comment_date= NOW() WHERE id= ?');
      $updateComment = $comments->execute(array($id_comment));

      return $updateComment;
  }

}
