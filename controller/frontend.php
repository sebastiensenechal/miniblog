<?php
// Contient les controleurs dans des fonctions.
// Il est utilisé par le routeur qui se charge d'appeler les bons controllers (fonctions).


require_once('./model/frontend/PostManager.php');
require_once('./model/frontend/CommentManager.php');
require_once('./model/frontend/UserManager.php');


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
function addComment($id_post, $author, $comment)
{
  $commentManager = new \SebastienSenechal\Miniblog\Model\Frontend\CommentManager();

  $affectedLines = $commentManager->postComment($id_post, $author, $comment);

  if ($affectedLines === false)
  {
    // Si erreur, elle remonte jusqu'au bloc try du router (index.php)
    throw new Exception('Impossible d\'ajouter le commentaire');
  }
  else
  {
    // Si pas d'erreur, on redirige le contributeur vers le post avec son commentaire
    header('Location: index.php?action=post&id=' . $id_post);
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
  $userManager = new \SebastienSenechal\Miniblog\Model\Frontend\UserManager();

  $user = $userManager->getUser($pseudo);
  $proper_pass = password_verify($_POST['pass'], $user['pass']);
  if(!$user)
  {
    throw new Exception('Mauvais pseudo ou mot de passe');
  }
  // -- Si le user est bon et le mot de passe aussi, démarrer la session. Session ID, pseudo et pass.
  // -- Créer les cookies coorespondant
  else
  {
    if ($proper_pass)
    {
      session_start();

      $_SESSION['id'] = $user['id'];
      $_SESSION['pseudo'] = $user['pseudo'];
      $_SESSION['pass'] = $user['pass'];

      $id = $user['id'];
      $pseudo = $user['pseudo'];
      $password_hash = $user['pass'];

      setcookie('id', $id, time() + 1800, null, null, false, true);
      setcookie('pseudo', $pseudo, time() + 1800, null, null, false, true);
      setcookie('pass', $password_hash, time() + 1800, null, null, false, true);

      header('Location: ./index.php?action=dashbord');
    }
    else
    {
      throw new Exception('Mauvais pseudo ou mot de passe');
    }
  }
  // S'il manque une informaiton, lancer Exception
}


function registerUser($pseudo, $password_hash, $email)
{
  // Instancier la classe User Manager
  $userManager = new \SebastienSenechal\Miniblog\Model\Frontend\UserManager();
  // Faire appel à une fonction de création d'utilisateur. Paramètres : (pseudo, email, password hash).
  $registerUser = $userManager->createUser($pseudo, $password_hash, $email);
  // Si l'inscription est refusé "false", jeter Exception
  if($registerUser === false)
  {
      throw new Exception('Impossible d\'inscrire le nouvel utilisateur');
  }
  // Sinon, rediriger vers l'index avec la fonction Header('Location: ...')
  else
  {
      header('Location: ./index.php');
  }
}


function logoutUser()
{
  session_start();

  // Suppression des variables de session et de la session
  $_SESSION = array();
  session_destroy();
  // Suppression des cookies de connexion automatique
  setcookie('id', '');
  setcookie('pseudo', '');
  setcookie('pass', '');

  header('Location: ./index.php');
}
