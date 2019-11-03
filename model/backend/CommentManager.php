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

  public function getAllComments()
  {
    $db = $this->dbConnect();

    $comments = $db->query('SELECT id, post_id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC');
    return $comments;
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


  // Mettre à jour un commentaire
  public function updateComment($id_comment, $id_post, $author, $comment)
    {
      $db = $this->dbConnect();

      $comments = $db->prepare('UPDATE comments SET post_id= :post_id, author= :author, comment= :comment, comment_date= NOW() WHERE id= :id_comment');
      $comments->bindParam('post_id', $id_post, \PDO::PARAM_INT);
      $comments->bindParam('author',$author, \PDO::PARAM_STR);
      $comments->bindParam('comment',$comment, \PDO::PARAM_STR);
      $comments->bindParam('id_comment', $id_comment, \PDO::PARAM_INT);
      $updateComment = $comments->execute();
      return $updateComment;
    }


    // fonction Approuver commentaire
    // ...


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

    $comment = $db->query('SELECT author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %H:%i:%s\') AS comment_date_fr FROM comments ORDER BY comment_date DESC LIMIT 0, 3');

    return $comment;
  }

}
