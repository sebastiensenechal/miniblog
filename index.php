<?php session_start() ?>

<?php
// Le routeur : premier fichier appelé, c'est un "controleur frontal". Il appel le bon controleur chez "controller.php" en fonction d'un paramètre dans l'url.
// Ajout d'une gestion d'exceptions pour les erreurs


require('controller/AuthController.php');
require('controller/PostController.php');
require('controller/CommentsController.php');
require('controller/UserController.php');

$AuthController = new AuthController;
$PostController = new PostController;
$CommentsController = new CommentsController;
$UserController = new UserController;


try // Test (Exception)
{
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); // Sécurise la variable superglobale $_GET
  $cookieTicket = filter_input(INPUT_COOKIE, 'ticket'); // Sécurise la variable superglobale $_COOKIE

  // Utilisateur authentifié
  if(isset($_SESSION['id']) && isset($_SESSION['pseudo']))
  {
    if (!empty($action))
    {
      if(isset($cookieTicket) == isset($_SESSION['ticket'])) // Vérification du ticket pour sécuriser la session
      {
      	$ticket = session_id().microtime().rand(0,99999999); // Génération d'un nouveau ticket lors d'une action utilisateur
      	$ticket = hash('sha512', $ticket);
        setcookie('ticket', $ticket, time() + (60 * 20)); // Expire au bout de 20 min
      	$_SESSION['ticket'] = $ticket;

        // Tableau de bord
        if ($action == 'dashbord')
        {
          $UserController->dashbord();
        }

       // Lister les articles
       elseif ($action == 'adminListPosts')
       {
          $PostController->adminListPosts();
       }

       // Lister les commentaires
       elseif ($action == 'adminListComments')
       {
          $CommentsController->adminListComments();
       }


       // Afficher les commentaires signalés
       elseif ($action == 'adminCommentsReport')
       {
         $CommentsController->adminCommentsReport();
       }


       // Afficher les commentaires signalés
       elseif ($action == 'adminCommentsStandby')
       {
         $CommentsController->adminCommentsStandby();
       }


       // Approuver un commentaire
       elseif ($action == 'approvedReportComment')
       {
         $CommentsController->approvedReportComment();
       }


       // Approuver un commentaire
       elseif ($action == 'approvedComment')
       {
         $CommentsController->approvedComment();
       }


       // Approuver un commentaire
       elseif ($action == 'disable')
       {
         $CommentsController->disableComment();
       }


       // ADMIN - Supprimer un commentaire
       elseif ($action == 'deleteComment')
       {
         if (isset($_GET['id']) && $_GET['id'] > 0)
         {
           $CommentsController->deleteComment($_GET['id']);
         }
         else
         {
           throw new Exception('Aucun identifiant de commentaire envoyé !');
         }
       }


        // Afficher un article et ses commentaires
        elseif ($action == 'adminPost')
        {
          if (isset($_GET['id']) && $_GET['id'] > 0)
          {
            $PostController->adminPost();
          }
          else
          {
            throw new Exception('Aucun identifiant de chapitre envoyé !');
          }
        }


        // Page d'administration de création d'un article
        elseif ($action == 'adminNewPost')
        {
          $PostController->adminNewPost();
        }

        // Fonctionnalité de creation d'article
        elseif ($action == 'createPost')
        {
          if ($_POST['author'] != NULL && $_POST['title'] != NULL && $_POST['content'] != NULL && $_POST['excerpt'] != NULL)
          {
            $PostController->addPost($_POST['author'], $_POST['title'], $_POST['content'], $_POST['excerpt']);
          }
          else
          {
            throw new Exception('Tous les champs ne sont pas remplis..');
          }
        }


        // Page d'administration de mise à jour d'article
        elseif ($action == 'adminUpdatePost')
        {
            $PostController->adminUpdatePost();
        }

        // Fonctionnalité de mise à jour d'article
        elseif ($action == 'updatePost')
        {
          if (isset($_GET['id']) && $_GET['id'] > 0)
          {
            if ($_POST['author'] != NULL && $_POST['title'] != NULL && $_POST['content'] != NULL && $_POST['excerpt'] != NULL)
            {
              $PostController->updatePost($_GET['id'], $_POST['author'], $_POST['title'], $_POST['content'], $_POST['excerpt']);
            }
            else
            {
              throw new Exception('Tous les champs ne sont pas remplis..');
            }
          }
          else
          {
            throw new Exception('Aucun identifiant de chapitre envoyé !');
          }
        }

        // Fonctionnalité de suppression d'article
       elseif ($action == 'deletePost')
       {
         if (isset($_GET['id']) && $_GET['id'] > 0)
         {
             $PostController->deletePost($_GET['id']);
         }
         else
         {
             throw new Exception('Aucun identifiant de chapitre envoyé !');
         }
       }

        // Liste des chapitres
        elseif ($action == 'listPosts')
        {
          $PostController->listPosts();
        }

        // Affiche le chapitre avec ses commentaires
        elseif ($action == 'post')
        {
          if (isset($_GET['id']) && $_GET['id'] > 0)
          {
            $PostController->post();
          }
          else
          {
            throw new Exception('Aucun identifiant de chapitre envoyé !');
          }
        }

        // Ajoute un commentaire dans le chapitre selectionné
        elseif ($action == 'addComment')
        {
          if (isset($_GET['id']) && $_GET['id'] > 0)
          {
              if (!empty($_POST['author']) && !empty($_POST['comment']))
              {
                  $CommentsController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
              }
              else
              {
                  throw new Exception('Tous les champs doivent être remplis !');
              }
          }
          else
          {
              throw new Exception('Aucun identifiant de chapitre envoyé !');
          }
        }


        // Signaler un commentaire
        elseif ($action == 'report')
        {
            if (isset($_GET['id_post']) && $_GET['id_post'] > 0)
            {
                if (isset($_GET['id']) && $_GET['id'] > 0)
                {
                    $CommentsController->reportingComment();
                }
                else
                {
                    throw new Exception('Aucun identifiant de commentaire envoyé pour pouvoir le signaler!');
                }
            }
            else
            {
                throw new Exception('Aucun identifiant d\'article envoyé pour revenir sur la page précédente!');
            }
        }


        // Page de connexion
        elseif ($action == 'login')
        {
          $AuthController->login();
        }

        // Inscription
        elseif ($action == 'subscription')
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
                $UserController->registerUser($pseudo, $password_hash, $email);
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
        elseif ($action == 'connect')
        {
          if (!empty($_POST['pseudo']) && !empty($_POST['pass']) && !empty($_POST['token']))
          {
            $AuthController->logUser($_POST['pseudo'], $_POST['pass'], $_POST['token']);
          }
          else
          {
            throw new Exception('Tous les champs doivent être remplis !');
          }
        }

        // Deconnexion
        elseif ($action == 'logout')
        {
          $AuthController->logoutUser();
        }

      }
      else
      {
        $AuthController->logoutUser();
      }
    }
    // Retourne au Dashbord.
    else
    {
      $PostController->listPosts();
    }
  }

  // Visiteur non authentifié
  else
  {
    if (isset($action) && !empty($action))
    {
      // Accueil Visiteur
      if ($action == 'listPosts')
      {
        $PostController->listPosts();
      }

      // Affichage d'un article
      elseif ($action == 'post')
      {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
          $PostController->post();
        }
        else
        {
          // "throw new Exception" arrête le bloc "try" et amène directement l'ordinateur au bloc "catch"
          throw new Exception('Erreur : aucun identifiant de billet envoyé.');
        }
      }

      // Ajouter un commentaire
      elseif ($action == 'addComment')
      {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
          if (!empty($_POST['author']) && !empty($_POST['comment']))
          {
            $CommentsController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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

      // Signaler un commentaire
      elseif ($action == 'report')
      {
          if (isset($_GET['id_post']) && $_GET['id_post'] > 0)
          {
              if (isset($_GET['id']) && $_GET['id'] > 0)
              {
                  $CommentsController->reportingComment();
              }
              else
              {
                  throw new Exception('Aucun identifiant de commentaire envoyé pour pouvoir le signaler!');
              }
          }
          else
          {
              throw new Exception('Aucun identifiant d\'article envoyé pour revenir sur la page précédente!');
          }
      }

      // Page de connexion
      elseif ($action == 'login') {
          $AuthController->login();
      }

      // Inscription d'un utilisateur
      elseif ($action == 'subscription')
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
                  $UserController->registerUser($pseudo, $password_hash, $email);
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
      elseif ($action == 'connect')
      {
        if (!empty($_POST['pseudo']) && !empty($_POST['pass']))
        {
            $AuthController->logUser($_POST['pseudo'], $_POST['pass'], $_POST['token']);
        }
        else
        {
            throw new Exception('Tous les champs doivent être remplis !');
        }
      }

      // Déconnexion
      elseif ($action == 'logout')
      {
        $AuthController->logoutUser();
      }

    }
    else
    {
      $PostController->listPosts();
    }
  }
}

catch(Exception $e)  // Catch récupère le message d'erreur qu'on lui transmet et l'affiche
{
  echo 'Erreur : ' . $e->getMessage();
  // $errorMessage = $e->getMessage();
  // require('view/errorView.php');
}
