<nav id="main_navigation">
  <div id="bouton_navigation">
    <?php
    if (isset($_SESSION['id']) && isset($_SESSION['pseudo']))
    {
      ?>
        <p><a href="index.php?action=logout">Déconnection</a></p>
      <?php
    }
    else
    {
      ?>
        <p><a href="index.php?action=login">Connexion</a></p>
      <?php
    }
    ?>
  </div>
  <ul>
    <?php
    if (isset($_SESSION['id']) && isset($_SESSION['pseudo']) && !empty($_SESSION['role'] == 0))
    {
    ?>
      <li><a href="index.php?action=dashbord">Tableau de bord</a></li>
    <?php
    }
    ?>
    <li><a href="index.php?action=legal">Mentions légales</a></li>
    <li><a href="index.php?action=rgpd" title="Données personnelles">RGPD</a></li>
  </ul>
</nav>
