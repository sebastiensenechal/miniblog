<?php
use \SebastienSenechal\Miniblog\Model\PostManager;
use \SebastienSenechal\Miniblog\Model\CommentManager;
use \SebastienSenechal\Miniblog\Model\UserManager;

require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');
require_once('./model/UserManager.php');

class UserController {

  // Tableau de bord
  public function dashbord()
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getLastPost();
    $comment = $commentManager->getLastComment();

    $indexView = 'view/backend/indexView';
    require($indexView . '.php');
  }



  function registerUser($pseudo, $password_hash, $email)
  {
    // Instancier la classe User Manager
    $userManager = new UserManager();
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

  public function authorView()
  {
    $authorView = 'view/frontend/authorView';
    require($authorView . '.php');
  }

}
