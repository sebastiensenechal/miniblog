<?php
use \SebastienSenechal\Miniblog\Model\PostManager;
use \SebastienSenechal\Miniblog\Model\CommentManager;

require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');


class CommentsController {

  // Liste des commentaires
  public function adminListComments()
  {
      $commentManager = new CommentManager();
      $comments = $commentManager->getAllComments();
      $listCommentsView = 'view/backend/listCommentsView';
      require($listCommentsView . '.php');
  }



  // Page des commentaires en attentes d'approbation
  public function adminCommentsReport()
  {
    $commentManager = new CommentManager();
    $reportComments = $commentManager->getReportComments();
    $reportCommentsView = 'view/backend/reportCommentsView';
    require($reportCommentsView . '.php');
  }



  // Page des commentaires en attentes d'approbation
  public function adminCommentsStandby()
  {
    $commentManager = new CommentManager();
    $standbyComments = $commentManager->getStandbyComments();
    $standbyCommentsView = 'view/backend/standbyCommentsView';
    require($standbyCommentsView . '.php');
  }



  // Supprimer un commentaire
  public function deleteComment($id)
  {
    $commentManager = new CommentManager();
    $deleteComment = $commentManager->deleteComment($id);
    if($deleteComment === false)
    {
        throw new Exception('Impossible de supprimer le commentaire' );
    }
    else
    {
        header('Location: ./index.php?action=adminListComments');
    }
  }



  public function approvedReportComment() // Retirer le signalement d'un commentaire
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $reportComment = $commentManager->approvedReportComment($_GET['id']);

    setcookie('message_report', '');
    unset($_COOKIE['message_report']);

    header('Location: ./index.php?action=adminCommentsReport');
  }


  public function approvedComment() // Approuve un commentaire soumi
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $approvedComments = $commentManager->approvedComment($_GET['id']);

    header('Location: ./index.php?action=adminCommentsStandby');
  }


  // Désactiver un commentaire
  public function disableComment()
  {
    $commentManager = new CommentManager();

    $disableComment = $commentManager->disableComment($_GET['id']);
    header('Location: ./index.php?action=adminListComments');
  }



  // **************** FRONTEND ****************



  // Ajout d'un commentaire dans la base
  public function addComment($postId, $author, $comment)
  {
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false)
    {
      throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else
    {
      setcookie('message', "Merci, votre commentaire a bien été soumi.", time() + 5, null, null, false, true);

      header('Location: index.php?action=post&id=' . $postId . '#post-comments');
    }
  }


  // Signaler un commentaire
  public function reportingComment()
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $reportComment = $commentManager->reportComment($_GET['id']);

    setcookie('message_report', "Merci, votre signalement sera pris en compte.");

    header('Location: index.php?action=post&id=' . $_GET['id_post'] . '#post-comments');
  }


}
