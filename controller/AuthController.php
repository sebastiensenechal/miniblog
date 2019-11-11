<?php
namespace SebastienSenechal\Miniblog; // La classe sera dans ce namespace

use \SebastienSenechal\Miniblog\Model\UserManager;

// require_once('./model/UserManager.php');
require_once 'Autoloader.php';
Autoloader::register();

class AuthController {


  public function login()
  {
    // l'accès à la page de connexion génère un token dans un champs hidden du formulaire
    // Génération du tooken aléatoire
    $token = bin2hex(random_bytes(32));
    // Créer une session CSRF
    $_SESSION['token'] = $token;

    $loginView = 'view/frontend/loginView';
    require($loginView . '.php');
  }




  public function logUser($pseudo, $pass, $token)
  {
    // Vérifier la présence des informations demandées
    // Créer une instance de la classe User Manager
    $userManager = new UserManager();

    $user = $userManager->getUser($pseudo);
    $proper_pass = password_verify($_POST['pass'], $user['pass']);

     if(!$user || !$proper_pass)
     {
       throw new Exception('Mauvais pseudo ou mot de passe');
     }
     // -- Si le user est bon et le mot de passe aussi, démarrer la session. Session ID, pseudo et pass.
     // -- Créer les cookies coorespondant
     else
     {
       //On vérifie que tous les jetons sont là

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
             header('Location: ./index.php?action=dashbord');
           }
           else
           {
             header('Location: ./index.php');
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
    $cookie_name = "ticket";
    // On génère quelque chose d'aléatoire
    $ticket = session_id().microtime().rand(0,99999999);
    // on hash pour avoir quelque chose de propre qui aura toujours la même forme
    $ticket = hash('sha512', $ticket);

    // On enregistre des deux cotés
    setcookie($cookie_name, $ticket, time() + (60 * 20)); // Expire au bout de 20 min
    $_SESSION['ticket'] = $ticket;
  }


  public function logoutUser()
  {
    session_start();

    // Suppression des variables de session et de la session
    $_SESSION = array();
    session_destroy();
    // Suppression des cookies de connexion automatique
    setcookie('id', '');
    setcookie('pseudo', '');
    setcookie('ticket', '');
    // setcookie('pass', '');

    unset($_SESSION['token']);
    unset($_SESSION['ticket']);

    header('Location: ./index.php');
  }

}
