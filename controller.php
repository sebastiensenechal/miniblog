<?php
// Contient les controleurs dans des fonctions.
// Il est utilisé par le routeur qui se charge d'appeler les bons controllers (fonctions).


require('model.php');


// Affiche la liste des billets
function listPosts()
{
  $posts = getPosts();

  require('listPostsView.php');
}


// Affiche un billet avec ses commentaires
function post()
{
  $post = getPost($_GET['id']);
  $comments = getComments($_GET['id']);

  require('postView.php');
}
