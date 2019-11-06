<?php
require_once('./model/frontend/PostManager.php');
require_once('./model/frontend/CommentManager.php');
require_once('./model/backend/PostManager.php');
require_once('./model/backend/CommentManager.php');

class CommentsController {

  // Liste des commentaires
  public function adminListComments()
  {
      $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();
      $comments = $commentManager->getAllComments();
      require ('./view/backend/listCommentsView.php');
  }



  // Page des commentaires en attentes d'approbation
  public function adminCommentsReport()
  {
    $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();
    $reportComments = $commentManager->getReportComments();
    require ('./view/backend/reportCommentsView.php');
  }



  // Supprimer un commentaire
  public function deleteComment($id)
  {
    $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();
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



  public function approvedComment() // Retirer le signalement
  {
    $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
    $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $reportComment = $commentManager->approvedComment($_GET['id']);

    header('Location: ./index.php?action=adminCommentsReport');
  }



  // **************** FRONTEND ****************



  // Ajout d'un commentaire dans la base
  public function addComment($postId, $author, $comment)
  {
    $commentManager = new \SebastienSenechal\Miniblog\Model\Frontend\CommentManager();

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
    $postManager = new \SebastienSenechal\Miniblog\Model\Frontend\PostManager();
    $commentManager = new \SebastienSenechal\Miniblog\Model\Frontend\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $reportComment = $commentManager->reportComment($_GET['id']);
    header('Location: index.php?action=post&id=' . $_GET['id_post']);
  }

}
