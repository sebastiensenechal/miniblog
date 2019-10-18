<?php
// Le routeur : premier fichier appelé, c'est un "controleur frontal". Il appel le bon controleur chez "controller.php" en fonction d'un paramètre dans l'url.
// Ajout d'une gestion d'exceptions pour les erreurs

require('controller/frontend.php');

try // Test (Exception)
{
  if (isset($_GET['action']))
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
  }
  else
  {
    listPosts();
  }
}

catch(Exception $e)  // Catch récupère le message d'erreur qu'on lui transmet et l'affiche
{
  echo 'Erreur : ' . $e->getMessage();
  // $errorMessage = $e->getMessage();
  // require('view/errorView.php');
}
