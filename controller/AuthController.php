<?php
use \SebastienSenechal\Miniblog\Model\UserManager;

require_once('./model/UserManager.php');

class AuthController {

  public function login()
  {
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;

    $loginView = 'view/frontend/loginView';
    require($loginView . '.php');
  }



  public function logUser($pseudo, $pass, $token)
  {
    $userManager = new UserManager();

    $user = $userManager->getUser($pseudo);
    $proper_pass = password_verify($_POST['pass'], $user['pass']);

    // Si le user est bon et le mot de passe aussi, démarrer la session et créer cookies
     if(!$user || !$proper_pass)
     {
       throw new Exception('Mauvais pseudo ou mot de passe');
     }
     else
     {
       if (isset($_SESSION['token']) AND isset($_POST['token']) AND !empty($_SESSION['token']) AND !empty($_POST['token']))
       {
         if ($_SESSION['token'] == $_POST['token'])
         {
           session_start();

           $this->ticket();

           $_SESSION['id'] = $user['id'];
           $_SESSION['pseudo'] = $user['pseudo'];
           $_SESSION['role'] = $user['role'];

           $id = $user['id'];
           $pseudo = $user['pseudo'];

           setcookie('id', $id, time() + (60 * 20), null, null, false, true);
           setcookie('pseudo', $pseudo, time() + (60 * 20), null, null, false, true);

           if ($user['role'] == 0)
           {
             header('Location: index.php?action=dashbord');
           }
           else
           {
             header('Location: index.php?action=indexView');
           }
         }
         else
         {
           throw new Exception('CSRF Token Validation Failed');
         }
       }
     }
  }


  public function ticket()
  {
    $cookieTicket = "ticket";
    // On génère quelque chose d'aléatoire
    $ticket = session_id().microtime().rand(0,99999999);
    // on hash pour avoir quelque chose de propre qui aura toujours la même forme
    $ticket = hash('sha512', $ticket);

    setcookie($cookieTicket, $ticket, time() + (60 * 20)); // Expire au bout de 20 min
    $_SESSION['ticket'] = $ticket;
  }


  public function logoutUser()
  {
    session_start();
    
    session_destroy();
    $_SESSION = array();

    setcookie('id', '');
    setcookie('pseudo', '');
    setcookie('ticket', '');
    setcookie('message', '');
    setcookie('message_report', '');
    setcookie('message_subscription', '');

    unset($_SESSION['token']);
    unset($_SESSION['ticket']);
    unset($_COOKIE['message']);
    unset($_COOKIE['message_report']);
    unset($_COOKIE['message_subscription']);

    header('Location: index.php?action=indexView');
  }

}
