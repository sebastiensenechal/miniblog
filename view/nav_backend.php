<?php
if (isset($_SESSION['id']))
{
  ?>
  <nav id="backend_navigation">
    <ul>
      <li><a href="index.php">Accueil</a></li>
      <li><a href="index.php?action=dashbord">Tableau de bord</a></li>
      <li><a href="index.php?action=adminListPosts">Voir les articles</a></li>
      <li><a href="index.php?action=adminListComments">Voir les commentaires</a></li>
      <li><a href="index.php?action=adminNewPost">Créer un article</a></li>
      <li><a href="index.php?action=logout">Déconnection</a></li>
    </ul>
  </nav>
    <?php
}
?>
