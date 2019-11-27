<?php
namespace SebastienSenechal\Miniblog\Model;

use \SebastienSenechal\Miniblog\Model\Manager;

$manager = "Manager";
require_once $manager . '.php';


class CommentManager extends Manager
{
  public function getComments($id_post)
  {
    $db = $this->dbConnect();

    $comments = $db->prepare('SELECT id, author, comment, reporting, standby, DATE_FORMAT(comment_date, \'%d.%m.%Y à %Hh%i\') AS comment_date_fr FROM oc_comments WHERE post_id = ? AND standby = 0 ORDER BY comment_date DESC');
    $comments->execute(array($id_post));

    return $comments;
  }

  public function getComment($id_comment)
  {
    $db = $this->dbConnect();

    $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d.%m.%Y à %Hh%i\') AS comment_date_fr FROM oc_comments WHERE id= ?');
    $comments->execute(array($id_comment));
    $comment = $comments->fetch();

    return $comment;
  }

  public function getAllComments()
  {
    $db = $this->dbConnect();

    $comments = $db->query('SELECT id, post_id, author, comment, reporting, standby, DATE_FORMAT(comment_date, \'%d.%m.%Y à %Hh%i\') AS comment_date_fr FROM oc_comments WHERE reporting = 0 AND standby = 0 ORDER BY comment_date DESC');
    return $comments;
  }

  public function getReportComments()
  {
    $db = $this->dbConnect();

    $reportComments = $db->query('SELECT id, post_id, author, comment, reporting, DATE_FORMAT(comment_date, \'%d.%m.%Y à %Hh%i\') AS comment_date_fr FROM oc_comments WHERE reporting= 1 ORDER BY reporting DESC');
    return $reportComments;
  }

  public function getStandbyComments()
  {
    $db = $this->dbConnect();

    $standbyComments = $db->query('SELECT id, post_id, author, comment, standby, DATE_FORMAT(comment_date, \'%d.%m.%Y à %Hh%i\') AS comment_date_fr FROM oc_comments WHERE standby= 1 ORDER BY standby DESC');
    return $standbyComments;
  }


  public function postComment($postId, $author, $comment)
  {
    $db = $this->dbConnect();

    $db->quote($comment);

    $comments = $db->prepare('INSERT INTO oc_comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $comment));

    return $affectedLines;
  }


  function approvedReportComment($id_comment)
  {
    $db = $this->dbConnect();

    $comments = $db->prepare('UPDATE oc_comments SET reporting = 0 WHERE id= ?');
    $report = $comments->execute(array($id_comment));

    return $report;
  }


  function approvedComment($id_comment)
  {
    $db = $this->dbConnect();

    $comments = $db->prepare('UPDATE oc_comments SET standby = 0 WHERE id= ?');
    $approved = $comments->execute(array($id_comment));

    return $approved;
  }


  public function disableComment($id_comment)
  {
    $db = $this->dbConnect();

    $comments = $db->prepare('UPDATE oc_comments SET standby = 1 WHERE id= ?');
    $disable = $comments->execute(array($id_comment));

    return $disable;
  }


  public function deleteComment($id)
  {
    $db = $this->dbConnect();

    $comment = $db->prepare('DELETE FROM oc_comments WHERE id= ?');
    $deleteComment = $comment->execute(array($id));
    return $deleteComment;
  }


  public function deleteComments($id_post)
  {
    $db = $this->dbConnect();
    $comments = $db->prepare('DELETE FROM oc_comments WHERE post_id= ?');
    $deleteComments = $comments->execute(array($id_post));
    return $deleteComments;
  }


  public function getLastComment()
  {
    $db = $this->dbConnect();

    $comment = $db->query('SELECT author, comment, DATE_FORMAT(comment_date, \'%d.%m.%Y à %H:%i:%s\') AS comment_date_fr FROM oc_comments WHERE reporting = 0 AND standby = 0 ORDER BY comment_date DESC LIMIT 0, 3');

    return $comment;
  }


  public function reportComment($id_comment)
  {
    $db = $this->dbConnect();

    $comments = $db->prepare('UPDATE oc_comments SET reporting = 1 WHERE id= ?');
    $report = $comments->execute(array($id_comment));

    return $report;
  }

}
