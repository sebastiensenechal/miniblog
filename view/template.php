<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link href="./public/css/style.css" rel="stylesheet" />
    <meta name="robots" content="noindex, nofollow">
  </head>

  <body>
    <div id="grid">

      <nav id="main_navigation">
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="">Projets</a></li>
          <li><a href="">Contact</a></li>
          <li><a href="index.php?action=login">Connexion / Inscription</a></li> <!-- action=login appel la fonction "login() du controleur" -->
        </ul>
      </nav>

    <?= $content ?>

    </div>
  </body>
</html>
