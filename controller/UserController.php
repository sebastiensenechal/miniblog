<?php
require_once('./model/backend/PostManager.php');
require_once('./model/backend/CommentManager.php');
require_once('./model/frontend/UserManager.php');

class UserController {

  // Tableau de bord
  public function dashbord()
  {
    $postManager = new \SebastienSenechal\Miniblog\Model\Backend\PostManager();
    $commentManager = new \SebastienSenechal\Miniblog\Model\Backend\CommentManager();

    $post = $postManager->getLastPost();
    $comment = $commentManager->getLastComment();

    require('./view/backend/indexView.php');
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

}
