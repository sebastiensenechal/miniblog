<?php
require_once('./model/frontend/PostManager.php');
require_once('./model/frontend/CommentManager.php');

require_once('./model/backend/PostManager.php');
require_once('./model/backend/CommentManager.php');


class PostController {

  // Liste des articles
  public function adminListPosts()
  {
      $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
      $posts = $postManager->getPosts();
      require('./view/backend/listPostsView.php');
  }


  public function adminPost()
  {
    $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
    $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require ('./view/backend/postView.php');
  }



  // Vue d'un nouvel article
  public function adminNewPost()
  {
    require ('./view/backend/newPostView.php');
  }



  // Ajouter un article
  public function addPost($author, $title, $content)
  {
    $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();

    $createPost = $postManager->createPost($author, $title, $content);

    header('Location: ./index.php?action=adminListPosts');
  }


  // Page de mise à jour, d'édition d'article
  public function adminUpdatePost()
  {
    $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();

    $post = $postManager->getPost($_GET['id']);

    require ('view/backend/updatePostView.php');
  }


  // Mettre à jour / Editer un article
  public function updatePost($id, $author, $title, $content)
  {
    $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();

    $updatePost = $postManager->updatePost($id, $author, $title, $content);

    if ($updatePost === false)
    {
        throw new Exception('Impossible de mettre à jour l\'article' );
    }
    else
    {
        header('Location: ./index.php?action=adminListPosts');
    }
  }

    // Supprimer un article
  public function deletePost($id)
    {
      $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
      $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

      $deletePost = $postManager->deletePost($id);
      $deleteComments = $commentManager->deleteComments($id);
      if($deletePost === false)
      {
          throw new Exception('Impossible de supprimer le chapitre' );
      }
      elseif ($deleteComments === false)
      {
          throw new Exception('Impossible de supprimer les commentaire du chapitre' );
      }
      else
      {
          header('Location: ./index.php?action=adminListPosts');
      }
    }







    // ************* FRONTEND
    // Affiche la liste des billets
    public function listPosts()
    {
      $postManager = new \SebastienSenechal\Miniblog\Model\Frontend\PostManager(); // Création d'un objet (namespace "\SebastienSenechal\Miniblog\Model\")
      $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

      require('./view/frontend/listPostsView.php');
    }


    // Affiche un billet avec ses commentaires
    public function post()
    {
      $postManager = new \SebastienSenechal\Miniblog\Model\Frontend\PostManager();
      $commentManager = new \SebastienSenechal\Miniblog\Model\Frontend\CommentManager();

      $post = $postManager->getPost($_GET['id']);
      $comments = $commentManager->getComments($_GET['id']);

      require('./view/frontend/postView.php');
    }

}
