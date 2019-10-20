<?php
// Contient les controleurs dans des fonctions.
// Il est utilisé par le routeur qui se charge d'appeler les bons controllers (fonctions).


require_once('model/PostManager.php');
require_once('model/CommentManager.php');


// Affiche la liste des billets
function listPosts()
{
  $postManager = new PostManager(); // Création d'un objet
  $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

  require('./view/frontend/listPostsView.php');
}


// Affiche un billet avec ses commentaires
function post()
{
  $postManager = new PostManager();
  $commentManager = new CommentManager();

  $post = $postManager->getPost($_GET['id']);
  $comments = $commentManager->getComments($_GET['id']);

  require('./view/frontend/postView.php');
}


// Ajout d'un commentaire dans la base
function addComment($postId, $author, $comment)
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
