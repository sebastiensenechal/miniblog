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

      <?php include('nav.php') ?>

      <?= $content ?>

    </div>
  </body>
</html>
