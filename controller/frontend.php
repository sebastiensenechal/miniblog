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
