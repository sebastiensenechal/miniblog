<?php
namespace SebastienSenechal\Miniblog; // La classe sera dans ce namespace

use \SebastienSenechal\Miniblog\Model\PostManager;
use \SebastienSenechal\Miniblog\Model\CommentManager;

require_once 'Autoloader.php';
Autoloader::register();


class PostController {

  // Liste des articles
  public function adminListPosts()
  {
      $postManager = new PostManager();
      $posts = $postManager->getPosts();

      $listPostsView = 'view/backend/listPostsView';
      require($listPostsView . '.php');
  }


  public function adminPost()
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    $postView = 'view/backend/postView';
    require($postView . '.php');
  }



  // Vue d'un nouvel article
  public function adminNewPost()
  {
    $newPostView = 'view/backend/newPostView';
    require($newPostView . '.php');
  }



  // Ajouter un article
  public function addPost($author, $title, $content, $excerpt)
  {
    $postManager = new PostManager();

    $createPost = $postManager->createPost($author, $title, $content, $excerpt);

    header('Location: ./index.php?action=adminListPosts');
  }


  // Page de mise à jour, d'édition d'article
  public function adminUpdatePost()
  {
    $postManager = new PostManager();

    $post = $postManager->getPost($_GET['id']);

    $updatePostView = 'view/backend/updatePostView';
    require($updatePostView . '.php');
  }


  // Mettre à jour / Editer un article
  public function updatePost($id, $author, $title, $content, $excerpt)
  {
    $postManager = new PostManager();

    $updatePost = $postManager->updatePost($id, $author, $title, $content, $excerpt);

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
      $postManager = new PostManager();
      $commentManager = new CommentManager();

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
      $postManager = new PostManager(); // Création d'un objet (namespace "\SebastienSenechal\Miniblog\Model\")
      $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

      $listPostsView = 'view/frontend/listPostsView';
      require($listPostsView . '.php');
    }


    // Affiche un billet avec ses commentaires
    public function post()
    {
      $postManager = new PostManager();
      $commentManager = new CommentManager();

      $post = $postManager->getPost($_GET['id']);
      $comments = $commentManager->getComments($_GET['id']);

      $listPostsView = 'view/frontend/postView';
      require($listPostsView . '.php');
    }

}
