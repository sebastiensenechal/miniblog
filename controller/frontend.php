<?php
// Contient les controleurs dans des fonctions.
// Il est utilisé par le routeur qui se charge d'appeler les bons controllers (fonctions).


require_once('model/frontend/PostManager.php');
require_once('model/frontend/CommentManager.php');


// Affiche la liste des billets
function listPosts()
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Frontend\PostManager(); // Création d'un objet (namespace "\SebastienSenechal\Miniblog\Model\")
  $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

  require('./view/frontend/listPostsView.php');
}


// Affiche un billet avec ses commentaires
function post()
{
  $postManager = new \SebastienSenechal\Miniblog\Model\Frontend\PostManager();
  $commentManager = new \SebastienSenechal\Miniblog\Model\Frontend\CommentManager();

  $post = $postManager->getPost($_GET['id']);
  $comments = $commentManager->getComments($_GET['id']);

  require('./view/frontend/postView.php');
}


// Ajout d'un commentaire dans la base
function addComment($postId, $author, $comment)
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

function login()
{
  require('view/frontend/loginView.php');
}

function logUser($pseudo, $pass)
{
  // Vérifier la présence des informations demandées
  // Créer une instance de la classe User Manager
  // -- Si le user est bon et le mot de passe aussi, démarrer la session. Session ID, pseudo et pass.
  // -- Créer les cookies coorespondant
  // S'il manque une informaiton, lancer Exception
}

function registerUser($pseudo, $email, $pass)
{
  // Instancier la classe User Manager
  // Faire appel à une fonction de création d'utilisateur. Paramètres : (pseudo, email, password hash).
  // Si l'inscription est refusé "false", jeter Exception
  // Sinon, rediriger vers l'index avec la fonction Header('Location: ...')
}

function logoutUser()
{
  // Supprimer les variables de session et la session
  // Supprimer les cookies
  // Rediriger vers l'index avec fonction Header('...')
}
