<?php
use \SebastienSenechal\Miniblog\Model\PostManager;
use \SebastienSenechal\Miniblog\Model\CommentManager;
use \SebastienSenechal\Miniblog\Model\UserManager;

require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');
require_once('./model/UserManager.php');

class UserController {

  public function dashbord()
  {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getLastPost();
    $comment = $commentManager->getLastComment();

    $indexView = 'view/backend/dashbordView';
    require($indexView . '.php');
  }



  public function registerUser($pseudo, $password_hash, $email)
  {
    // Instancier la classe User Manager
    $userManager = new UserManager();
    // Faire appel à une fonction de création d'utilisateur. Paramètres : (pseudo, email, password hash).
    $registerUser = $userManager->createUser($pseudo, $password_hash, $email);
    if($registerUser === false)
    {
      throw new Exception('Impossible d\'inscrire le nouvel utilisateur');
    }
    else
    {
      setcookie('message_subscription', "Merci, vous pouvez désormais vous connecter.", time() + 10, null, null, false, true);
      header('Location: ./index.php?action=login');
    }
  }

  public function authorView()
  {
    $authorView = 'view/frontend/authorView';
    require($authorView . '.php');
  }

  public function contactView()
  {
    $contactView = 'view/frontend/contactView';
    require($contactView . '.php');
  }

  public function legalView()
  {
    $legalView = 'view/frontend/legalView';
    require($legalView . '.php');
  }

  public function rgpdView()
  {
    $rgpdView = 'view/frontend/rgpdView';
    require($rgpdView . '.php');
  }

}
