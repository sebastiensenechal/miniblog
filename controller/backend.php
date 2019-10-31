<?php
// Contient les controleurs dans des fonctions.
// Il est utilisé par le routeur qui se charge d'appeler les bons controllers (fonctions).


require('./model/backend/PostManager.php');
require('./model/backend/CommentManager.php');
require('./model/backend/UserManager.php');



// Tableau de bord
function dashbord()
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
  $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

  $post = $postManager->getLastPost();
  $comment = $commentManager->getLastComment();

  require('view/backend/indexView.php');
}



// Liste des articles
function adminListPosts()
{
    $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
    $posts = $postManager->getPosts();
    require('view/backend/listPostsView.php');
}
// Liste des commentaires
function adminListComments()
{
    $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();
    $comments = $commentManager->getAllComments();
    require ('view/backend/listCommentsView.php');
}



function adminPost()
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
  $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

  $post = $postManager->getPost($_GET['id']);
  $comments = $commentManager->getComments($_GET['id']);

  require ('view/backend/postView.php');
}



// Vue d'un nouvel article
function adminNewPost()
{
  require ('view/backend/newPostView.php');
}



// Ajouter un article
function addPost($author, $title, $content)
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();

  $createPost = $postManager->createPost($author, $title, $content);

  header('Location: ./index.php?action=adminListPosts');
}


// Page de mise à jour, d'édition d'article
function adminUpdatePost()
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();

  $post = $postManager->getPost($_GET['id']);

  require ('view/backend/updatePostView.php');
}


// Mettre à jour / Editer un article
function updatePost($id, $author, $title, $content)
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
function deletePost($id_post)
  {
    $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
    $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

    $deletePost = $postManager->deletePost($id_post);
    $deleteComments = $commentManager->deleteComments($id_post);
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
