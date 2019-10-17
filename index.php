<?php
// Le routeur : premier fichier appelé, c'est un "controleur frontal". Il appel le bon controleur chez "controller.php" en fonction d'un paramètre dans l'url.


require('controller.php');

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
      echo 'Erreur : aucun identifiant de billet envoyé.';
    }
  }
}
else
{
  listPosts();
}
