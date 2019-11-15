<nav id="main_navigation">
  <ul>
    <li><a href="index.php?action=indexView">Accueil</a></li>
    <li><a href="index.php?action=listPosts">Articles</a></li>
    <li><a href="mailto:sebast.senechal@gmail.com">Contact</a></li>
    <?php
    if (isset($_SESSION['id']) && isset($_SESSION['pseudo']) && !empty($_SESSION['role'] == 0))
    {
    ?>
      <li><a href="index.php?action=dashbord">Tableau de bord</a></li>
      <li><a href="index.php?action=logout">Déconnection</a></li>
    <?php
    }
    elseif (isset($_SESSION['id']) && isset($_SESSION['pseudo']) && !empty($_SESSION['role'] == 1))
    {
      ?>
        <li><a href="index.php?action=logout">Déconnection</a></li>
      <?php
    }
    else
    {
      ?>
        <li><a href="index.php?action=login">Connexion / Inscription</a></li> <!-- action=login appel la fonction "login() du controleur" -->
      <?php
    }
    ?>
  </ul>
</nav>
