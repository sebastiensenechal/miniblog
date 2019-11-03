<nav id="main_navigation">
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="#">Contact</a></li>
        <?php
        if (isset($_SESSION['id']) && isset($_SESSION['pseudo']))
        {
        ?>
          <li><a href="index.php?action=dashbord">Tableau de bord</a></li>
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
