<?php
// Contient les controleurs dans des fonctions.
// Il est utilisé par le routeur qui se charge d'appeler les bons controllers (fonctions).


require('./model/backend/PostManager.php');
require('./model/backend/CommentManager.php');
require('./model/backend/UserManager.php');



// Dashbord
function dashbord()
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
  $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

  $post = $postManager->getLastPost();
  $comment = $commentManager->getLastComment();

  require('view/backend/indexView.php');
}



// Liste des Chapitres
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



// Page nouveau chapitre
function adminNewPost()
{
  require ('./view/backend/newPostView.php');
}



// Ajouter un chapitre
function addPost($author, $title, $content)
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();

  $createPost = $postManager->createPost($author, $title, $content);

  header('Location: ./index.php?action=adminListPosts');
}


// Page d'édition d'un chapitre
function adminUpdatePost()
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();

  $post = $postManager->getPost($_GET['id']);

  require ('view/backend/updatePostView.php');
}


// Editer un chapitre
function updatePost($id_post, $author, $title, $content)
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();

  $updatePost = $postManager->updatePost($id_post, $author, $title, $content);

  if ($updatePost === false)
  {
      throw new Exception('Impossible de mettre à jour l\'article' );
  }
  else
  {
      header('Location: ./index.php?action=adminListPosts');
  }
}
