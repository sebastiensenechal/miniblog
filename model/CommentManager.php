<?php
namespace SebastienSenechal\Miniblog\Model; // La classe sera dans ce namespace

use \SebastienSenechal\Miniblog\Model\Manager;
// require_once('Manager.php');
$manager = "Manager";
require_once $manager . '.php';


class CommentManager extends Manager
{
  public function getComments($id_post)
  {
    // COnnexion à la base de données - $db est un objet PDO
    $db = $this->dbConnect();

    // Récupère un commentaire associé à un ID avec une requête préparé
    $comments = $db->prepare('SELECT id, author, comment, reporting, standby, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE post_id = ? AND reporting = 0 AND standby = 0 ORDER BY comment_date DESC');
    $comments->execute(array($id_post));

    return $comments;
  }

  public function getComment($id_comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE id= ?');
        $comments->execute(array($id_comment));
        $comment = $comments->fetch();
        return $comment;
    }

  public function getAllComments()
  {
    $db = $this->dbConnect();

    $comments = $db->query('SELECT id, post_id, author, comment, reporting, standby, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE reporting = 0 AND standby = 0 ORDER BY comment_date DESC');
    return $comments;
  }

  public function getReportComments()
  {
    $db = $this->dbConnect();

    $reportComments = $db->query('SELECT id, post_id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE reporting= 1 ORDER BY reporting DESC');
    return $reportComments;
  }

  public function getStandbyComments()
  {
    $db = $this->dbConnect();

    $standbyComments = $db->query('SELECT id, post_id, author, comment, standby, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments WHERE standby= 1 ORDER BY standby DESC');
    return $standbyComments;
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


    // fonction Approuver commentaire
    function approvedReportComment($id_comment)
    {
      $db = $this->dbConnect();

      $comments = $db->prepare('UPDATE comments SET reporting = 0 WHERE id= ?');
      $report = $comments->execute(array($id_comment));

      return $report;
    }


    // fonction Approuver commentaire
    function approvedComment($id_comment)
    {
      $db = $this->dbConnect();

      $comments = $db->prepare('UPDATE comments SET standby = 0 WHERE id= ?');
      $approved = $comments->execute(array($id_comment));

      return $approved;
    }


    public function disableComment($id_comment)
    {
        $db = $this->dbConnect();

        $comments = $db->prepare('UPDATE comments SET standby = 1 WHERE id= ?');
        $disable = $comments->execute(array($id_comment));

        return $disable;
    }


    // Supprimer un commentaire
    public function deleteComment($id)
    {
        $db = $this->dbConnect();

        $comment = $db->prepare('DELETE FROM comments WHERE id= ?');
        $deleteComment = $comment->execute(array($id));
        return $deleteComment;
    }


    // Supprimer tous les commentaires d'un article (lorsqu'on supprimer un article)
    public function deleteComments($id_post)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('DELETE FROM comments WHERE post_id= ?');
        $deleteComments = $comments->execute(array($id_post));
        return $deleteComments;
    }


  // Afficher dernier commentaire
  public function getLastComment()
  {
    $db = $this->dbConnect();

    $comment = $db->query('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments WHERE reporting = 0 AND standby = 0 ORDER BY comment_date DESC LIMIT 0, 3');

    return $comment;
  }

  public function reportComment($id_comment)
  {
      $db = $this->dbConnect();

      $comments = $db->prepare('UPDATE comments SET reporting = 1 WHERE id= ?');
      $report = $comments->execute(array($id_comment));

      return $report;
  }

}
