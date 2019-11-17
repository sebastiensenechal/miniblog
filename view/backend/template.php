<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Backoffice | <?= $title ?></title>
    <link href="./public/css/style.css" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <div id="grid">
      <?php
      if (empty($page))
      {
        $page = 'nav';
        $page = trim('view/'.$page.'.php');
        if (file_exists('./'.$page))
        {
          include($page);
        }
        else
        {
          echo "Page inexistante !";
        }
      }
      ?>
      <?= $content ?>
    </div>


    <script src="public/js/tinymce/tinymce.min.js"></script>
    <script src="public/js/script.js"></script>
  </body>
</html>
