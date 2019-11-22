<?php
if (isset($_SESSION['id']))
{
  ?>
  <header id="main_navigation_backend">

    <nav id="backend_navigation">
      <h1><a href="index.php?action=indexView" title="Retour au site">John Doe</a></h1>
      <ul>
        <li><a href="index.php?action=dashbord">Tableau de bord</a></li>
        <li><a href="index.php?action=adminListPosts" title="Tous les articles">Articles</a></li>
          <ul class="submenu">
            <li><a href="index.php?action=adminNewPost">Créer un article</a></li>
          </ul>
        <li><a href="index.php?action=adminListComments" title="Tous les commentaires">Commentaires</a></li>
          <ul class="submenu">
            <li><a href="index.php?action=adminCommentsReport">Signalé</a></li>
            <li><a href="index.php?action=adminCommentsStandby">En attente</a></li>
          </ul>
        <li><a href="index.php?action=logout">Déconnection</a></li>
      </ul>
    </nav>

  </header>
    <?php
}
?>
