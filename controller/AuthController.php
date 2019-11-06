<?php
require_once('./model/frontend/UserManager.php');

class AuthController {



  public function login()
  {
    // l'accès à la page de connexion génère un token dans un champs hidden du formulaire
    // Génération du tooken aléatoire
    $token = bin2hex(random_bytes(32));
    // Créer une session CSRF
    $_SESSION['token'] = $token;

    require('view/frontend/loginView.php');
  }




  public function logUser($pseudo, $pass, $token)
  {
    // Vérifier la présence des informations demandées
    // Créer une instance de la classe User Manager
    $userManager = new \SebastienSenechal\Miniblog\Model\Frontend\UserManager();

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
       if ($_SESSION['token'] == $_POST['token'])
       {
         session_start();

         $_SESSION['id'] = $user['id'];
         $_SESSION['pseudo'] = $user['pseudo'];
         // $_SESSION['pass'] = $user['pass'];

         $id = $user['id'];
         $pseudo = $user['pseudo'];
         // $password_hash = $user['pass'];

         setcookie('id', $id, time() + (60 * 20), null, null, false, true);
         setcookie('pseudo', $pseudo, time() + (60 * 20), null, null, false, true);
         // setcookie('pass', $password_hash, time() + 1800, null, null, false, true);

         header('Location: ./index.php?action=dashbord');
       }
       else
       {
         throw new Exception('CSRF Token Validation Failed');
       }
     }
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
    // setcookie('pass', '');

    unset($_SESSION['token']);

    header('Location: ./index.php');
  }

}
