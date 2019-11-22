<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <link href="./public/css/style.css" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?= htmlspecialchars($title) ?></title>
  </head>
  <body>

    <?= $content ?>

    <footer>
      <ul>
        <li><a href="index.php?action=legal">Mentions légales</a></li>
        <li><a href="index.php?action=rgpd" title="Données personnelles">RGPD</a></li>
      </ul>
    </footer>


    <script src="././public/js/tinymce/tinymce.min.js"></script>
    <script src="././public/js/script.js"></script>
  </body>
</html>
