<?php
// Contient les controleurs dans des fonctions.
// Il est utilisé par le routeur qui se charge d'appeler les bons controllers (fonctions).


require_once('./model/backend/PostManager.php');
require_once('./model/backend/CommentManager.php');
require_once('./model/backend/UserManager.php');



// Dashbord
function dashbord()
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
  $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

  $post = $postManager->getLastPost();
  $comment = $commentManager->getLastComment();

  require('view/backend/indexView.php');
}

function adminPost()
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
  $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

  $post = $postManager->getPost($_GET['id']);
  $comments = $commentManager->getComments($_GET['id']);

  require ('view/backend/postView.php');
}
