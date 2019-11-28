<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Jean Forteroche | <?= htmlspecialchars($title) ?></title>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Billet simple pour l'Alaska, un roman de Jean Forteroche."/>
    <meta name="author" content="Jean Forteroche">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="Jean Forteroche" />
    <meta name="twitter:creator" content="Sébastien Sénéchal" />
    <meta property="og:url" content="https://sebastiensenechal.com/openclassroom/miniblog/" />
    <meta property="og:title" content="Jean Forteroche" />
    <meta property="og:description" content="Billet simple pour l'Alaska, un roman de Jean Forteroche." />
    <meta property="og:image" content="https://sebastiensenechal.com/openclassroom/miniblog/public/img/montagnes-pyrenees-480.jpg" />
    <meta property="og:title" content="Jean Forteroche" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://sebastiensenechal.com/openclassroom/miniblog/" />
    <meta property="og:image" content="https://sebastiensenechal.com/openclassroom/miniblog/public/img/montagnes-pyrenees-480.jpg" />
    <link href="./public/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/ico" href="./public/img/favicon.ico" />
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
