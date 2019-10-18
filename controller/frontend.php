<?php
// Contient les controleurs dans des fonctions.
// Il est utilisé par le routeur qui se charge d'appeler les bons controllers (fonctions).


require('./model/frontend.php');


// Affiche la liste des billets
function listPosts()
{
  $posts = getPosts();

  require('./view/frontend/listPostsView.php');
}


// Affiche un billet avec ses commentaires
function post()
{
  $post = getPost($_GET['id']);
  $comments = getComments($_GET['id']);

  require('./view/frontend/postView.php');
}


// Ajout d'un commentaire dans la base
function addComment($postId, $author, $comment)
{
  $affectedLines = postComment($postId, $author, $comment);

  if ($affectedLines === false)
  {
    die('Impossible d\'ajouter le commentaire');
  }
  else
  {
    // Si pas d'erreur, on redirige le contributeur vers le post avec son commentaire 
    header('Location: index.php?action=post&id=' . $postId);
  }
}
