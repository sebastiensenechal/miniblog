<?php
namespace SebastienSenechal\Miniblog; // La classe sera dans ce namespace

use \SebastienSenechal\Miniblog\Model\PostManager;
use \SebastienSenechal\Miniblog\Model\CommentManager;

require_once 'Autoloader.php';
Autoloader::register();


class CommentsController {

  // Liste des commentaires
  public function adminListComments()
  {
      $commentManager = new CommentManager();
      $comments = $commentManager->getAllComments();
      require ('./view/backend/listCommentsView.php');
  }



  // Page des commentaires en attentes d'approbation
  public function adminCommentsReport()
  {
    $commentManager = new CommentManager();
    $reportComments = $commentManager->getReportComments();
    require ('./view/backend/reportCommentsView.php');
  }



  // Page des commentaires en attentes d'approbation
  public function adminCommentsStandby()
  {
    $commentManager = new CommentManager();
    $standbyComments = $commentManager->getStandbyComments();
    require ('./view/backend/standbyCommentsView.php');
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



  public function approvedReportComment() // Retirer le signalement
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $reportComment = $commentManager->approvedReportComment($_GET['id']);

    header('Location: ./index.php?action=adminCommentsReport');
  }


  public function approvedComment() // Retirer le signalement
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $approvedComments = $commentManager->approvedComment($_GET['id']);

    header('Location: ./index.php?action=adminCommentsStandby');
  }


  // Signaler un commentaire
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
      // Si erreur, elle remonte jusqu'au bloc try du router (index.php)
      throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else
    {
      // Si pas d'erreur, on redirige le contributeur vers le post avec son commentaire
      header('Location: index.php?action=post&id=' . $postId);
    }
  }


  // Signaler un commentaire
  public function reportingComment()
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $reportComment = $commentManager->reportComment($_GET['id']);
    header('Location: index.php?action=post&id=' . $_GET['id_post']);
  }


}
