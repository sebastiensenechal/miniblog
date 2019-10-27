<?php session_start() ?>

<?php
// Le routeur : premier fichier appelé, c'est un "controleur frontal". Il appel le bon controleur chez "controller.php" en fonction d'un paramètre dans l'url.
// Ajout d'une gestion d'exceptions pour les erreurs

require('controller/frontend.php');
require('controller/backend.php');


try // Test (Exception)
{
  // SI ADMIN
  if(isset($_SESSION['id']))
  {
    if (isset($_GET['action']) && !empty($_GET['action']))
    {
      // ADMIN - Dashbord
      if ($_GET['action'] == 'dashbord')
      {
        dashbord();
      }

      // ADMIN - Chapitre avec ses commentaires
      elseif ($_GET['action'] == 'adminPost')
      {
          if (isset($_GET['id']) && $_GET['id'] > 0)
          {
              adminPost();
          }
          else
          {
              throw new Exception('Aucun identifiant de chapitre envoyé !');
          }
      }

      // Page de connexion
      elseif ($_GET['action'] == 'login')
      {
          login();
      }

      // Inscription
      elseif ($_GET['action'] == 'subscription')
      {
        if (!empty($_POST['pseudo']) && !empty($_POST['pass']) && !empty($_POST['pass_confirm']) && !empty($_POST['email']))
        {
          // Sécurité
          $pseudo = htmlspecialchars($_POST['pseudo']);
          $email = htmlspecialchars($_POST['email']);
          // Hachage du mot de passe
          $password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
          // On vérifie la Regex pour l'adresse email
          if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
          {
            // On vérifie que les 2 mots de passe sont identiques.
            if ($_POST['pass'] == $_POST['pass_confirm'])
            {
              registerUser($pseudo, $password_hash, $email);
            }
            else
            {
              throw new Exception('Les 2 mots de passe ne sont pas identiques, recommencez !');
            }
          }
          else
          {
            throw new Exception('L\'adresse email ' . $email . ' n\'est pas valide, recommencez !');
          }
        }
        else
        {
          throw new Exception('Tous les champs doivent être remplis !');
        }
      }

      // Connexion
      elseif ($_GET['action'] == 'connect')
      {
        if (!empty($_POST['pseudo']) && !empty($_POST['pass']))
        {
          logUser($_POST['pseudo'], $_POST['pass']);
        }
        else
        {
          throw new Exception('Tous les champs doivent être remplis !');
        }
      }
      // Deconnexion
      elseif ($_GET['action'] == 'logout')
      {
        logoutUser();
      }

    }
    // Retourne au Dashbord.
    else
    {
      dashbord();
    }

  }


  else
  {
    if (isset($_GET['action']) && !empty($_GET['action']))
    {
      if ($_GET['action'] == 'listPosts')
      {
        listPosts();
      }

      elseif ($_GET['action'] == 'post')
      {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
          post();
        }
        else
        {
          // "throw new Exception" arrête le bloc "try" et amène directement l'ordinateur au bloc "catch"
          throw new Exception('Erreur : aucun identifiant de billet envoyé.');
        }
      }

      elseif ($_GET['action'] == 'addComment')
      {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
          if (!empty($_POST['author']) && !empty($_POST['comment']))
          {
            addComment($_GET['id'], $_POST['author'], $_POST['comment']);
          }
          else
          {
            // Autre exception
            throw new Exception('Erreur : tous les champs doivent être renseignés !');
          }
        }
        else
        {
          // Autre exception
          throw new Exception('Erreur : aucun identifiant de billet envoyé.');
        }
      }

      // Page de connexion
      elseif ($_GET['action'] == 'login') {
          login();
      }

      // Inscription d'un utilisateur
      elseif ($_GET['action'] == 'subscription')
      {
        if (!empty($_POST['pseudo']) && !empty($_POST['pass']) && !empty($_POST['pass_confirm']) && !empty($_POST['email']))
        {
          // Sécurité
          $pseudo = htmlspecialchars($_POST['pseudo']);
          $email = htmlspecialchars($_POST['email']);
          // Hachage du mot de passe
          $password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
          // Regex pour l'adresse email
          if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
          {
              // On vérifie que les 2 mots de passe sont identiques.
              if ($_POST['pass'] == $_POST['pass_confirm'])
              {
                  registerUser($pseudo, $password_hash, $email);
              }
              else
              {
                  throw new Exception('Les deux mots de passe ne sont pas identiques, recommencez !');
              }
          }
          else
          {
              throw new Exception('L\'adresse email ' . $email . ' n\'est pas valide, recommencez !');
          }
        }
        else
        {
            throw new Exception('Tous les champs doivent être remplis !');
        }
      }

      // Connexion
      elseif ($_GET['action'] == 'connect')
      {
        if (!empty($_POST['pseudo']) && !empty($_POST['pass']))
        {
            logUser($_POST['pseudo'], $_POST['pass']);
        }
        else
        {
            throw new Exception('Tous les champs doivent être remplis !');
        }
      }

      // Déconnexion
      elseif ($_GET['action'] == 'logout')
      {
        logoutUser();
      }

    }
    else
    {
      listPosts();
    }
  }
}

catch(Exception $e)  // Catch récupère le message d'erreur qu'on lui transmet et l'affiche
{
  echo 'Erreur : ' . $e->getMessage();
  // $errorMessage = $e->getMessage();
  // require('view/errorView.php');
}
