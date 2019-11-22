<nav id="main_navigation">
  <ul>
    <?php
    if (isset($_SESSION['id']) && isset($_SESSION['pseudo']))
    {
      ?>
        <li><?= $_SESSION['pseudo'] ?> (<a href="index.php?action=logout">déconnexion</a>)</li>
      <?php
    }
    else
    {
      ?>
        <li><a href="index.php?action=login">Connexion</a></li>
      <?php
    }
    ?>
    <?php
    if (isset($_SESSION['id']) && isset($_SESSION['pseudo']) && !empty($_SESSION['role'] == 0))
    {
    ?>
      <li><a href="index.php?action=dashbord">Tableau de bord</a></li>
    <?php
    }
    ?>
  </ul>
</nav>
