<?php session_start() ?>

<?php
// Le routeur : premier fichier appelé, c'est un "controleur frontal". Il appel le bon controleur chez "controller.php" en fonction d'un paramètre dans l'url.
// Ajout d'une gestion d'exceptions pour les erreurs

$autoloader = "controller/Autoloader";
require_once $autoloader . '.php';
Autoloader::register();

$AuthController = new AuthController;
$PostController = new PostController;
$CommentsController = new CommentsController;
$UserController = new UserController;


try // Test (Exception)
{
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); // Sécurise la variable superglobale $_GET
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $id_post = filter_input(INPUT_GET, 'id_post');
  $cookieTicket = filter_input(INPUT_COOKIE, 'ticket'); // Sécurise la variable superglobale $_COOKIE
  $author = filter_input(INPUT_POST, 'author'); // Sécurise la variable superglobale $_POST
  $title = filter_input(INPUT_POST, 'title');
  $content = filter_input(INPUT_POST, 'content');
  $excerpt = filter_input(INPUT_POST, 'excerpt');
  $comment = filter_input(INPUT_POST, 'comment');


  // Administrateur
  if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && !empty($_SESSION['role'] == 0))
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
         if (isset($id) && $id > 0)
         {
           $CommentsController->deleteComment($id);
         }
         else
         {
           throw new Exception('Aucun identifiant de commentaire envoyé !');
         }
       }


        // Afficher un article et ses commentaires
        elseif ($action == 'adminPost')
        {
          if (isset($id) && $id > 0)
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
          if ($author != NULL && $title != NULL && $content != NULL && $excerpt != NULL)
          {
            $PostController->addPost($author, $title, $content, $excerpt);
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
          if (isset($id) && $id > 0)
          {
            if ($author != NULL && $title != NULL && $content != NULL && $excerpt != NULL)
            {
              $PostController->updatePost($id, $author, $title, $content, $excerpt);
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
         if (isset($id) && $id > 0)
         {
             $PostController->deletePost($id);
         }
         else
         {
             throw new Exception('Aucun identifiant de chapitre envoyé !');
         }
       }

        // // Liste des chapitres
        // elseif ($action == 'listPosts')
        // {
        //   $PostController->listPosts();
        // }
        //
        // // Affiche le chapitre avec ses commentaires
        // elseif ($action == 'post')
        // {
        //   if (isset($id) && $id > 0)
        //   {
        //     $PostController->post();
        //   }
        //   else
        //   {
        //     throw new Exception('Aucun identifiant de chapitre envoyé !');
        //   }
        // }

        // Ajoute un commentaire dans le chapitre selectionné
        elseif ($action == 'addComment')
        {
          if (isset($id) && $id > 0)
          {
              if (!empty($author) && !empty($comment))
              {
                $CommentsController->addComment($id, $author, $comment);
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
            if (isset($id_post) && $id_post > 0)
            {
                if (isset($id) && $id > 0)
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
          if (!empty($_POST['pseudo']) && !empty($_POST['pass']) && !empty($_POST['pass_confirm']) && !empty($_POST['email']) && $_POST['agreement'] == true)
          {
            // Sécurité
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            // Hachage du mot de passe
            $password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            // On vérifie la Regex pour l'adresse email
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
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





  // Utilisateur authentifié
  if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && !empty($_SESSION['role'] == 1))
  {
    if (!empty($action))
    {
      if(isset($cookieTicket) == isset($_SESSION['ticket'])) // Vérification du ticket pour sécuriser la session
      {
      	$ticket = session_id().microtime().rand(0,99999999); // Génération d'un nouveau ticket lors d'une action utilisateur
      	$ticket = hash('sha512', $ticket);
        setcookie('ticket', $ticket, time() + (60 * 20)); // Expire au bout de 20 min
      	$_SESSION['ticket'] = $ticket;

        // Accueil Visiteur
        if ($action == 'indexView')
        {
          $PostController->indexView();
        }

        // Liste articles
        if ($action == 'listPosts')
        {
          $PostController->listPosts();
        }

        // Biographie
        if ($action == 'authorView')
        {
          $UserController->authorView();
        }

        // Mentions légales
        if ($action == 'legal')
        {
          $UserController->legalView();
        }

        // RGPD
        if ($action == 'rgpd')
        {
          $UserController->rgpdView();
        }

        // Affichage d'un article
        elseif ($action == 'post')
        {
          if (isset($id) && $id > 0)
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
          if (isset($id) && $id > 0)
          {
            if (!empty($author) && !empty($comment))
            {
              $CommentsController->addComment($id, $author, $comment);
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
            if (isset($id_post) && $id_post > 0)
            {
                if (isset($id) && $id > 0)
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
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            // Hachage du mot de passe
            $password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            // On vérifie la Regex pour l'adresse email
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
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

        // Déconnexion
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
      $PostController->indexView();
    }
  }






  // Visiteur non authentifié
  else
  {
    if (isset($action) && !empty($action))
    {
      // Accueil Visiteur
      if ($action == 'indexView')
      {
        $PostController->indexView();
      }

      // Liste articles
      if ($action == 'listPosts')
      {
        $PostController->listPosts();
      }

      // Affichage d'un article
      elseif ($action == 'post')
      {
        if (isset($id) && $id > 0)
        {
          $PostController->post();
        }
        else
        {
          // "throw new Exception" arrête le bloc "try" et amène directement l'ordinateur au bloc "catch"
          throw new Exception('Erreur : aucun identifiant de billet envoyé.');
        }
      }

      // Biographie
      if ($action == 'authorView')
      {
        $UserController->authorView();
      }

      // Mentions légales
      if ($action == 'legal')
      {
        $UserController->legalView();
      }

      // RGPD
      if ($action == 'rgpd')
      {
        $UserController->rgpdView();
      }

      // Signaler un commentaire
      elseif ($action == 'report')
      {
          if (isset($id_post) && $id_post > 0)
          {
              if (isset($id) && $id > 0)
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
          $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

          // Hachage du mot de passe
          $password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
          // On vérifie la Regex pour l'adresse email
          if (filter_var($email, FILTER_VALIDATE_EMAIL))
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

      // Déconnexion
      elseif ($action == 'logout')
      {
        $AuthController->logoutUser();
      }

    }
    else
    {
      $PostController->indexView();
    }
  }
}

catch(Exception $e)  // Catch récupère le message d'erreur qu'on lui transmet et l'affiche
{
  echo 'Erreur : ' . $e->getMessage();
  // $errorMessage = $e->getMessage();
  // require('view/errorView.php');
}
