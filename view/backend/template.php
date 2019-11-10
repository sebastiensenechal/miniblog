<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Backoffice | <?= $title ?></title>
    <link href="./public/css/style.css" rel="stylesheet" />
    <meta name="robots" content="noindex, nofollow">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
    <script type="text/javascript" src="public/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
      tinyMCE.init({
          // type de mode
          mode : "textareas",
          // id ou class, des textareas
          elements : "content, comment",
          // chemin vers le fichier css
          content_css : "public/js/tinymce/skins/content/default/content.min.css",
          // couleur disponible dans la palette de couleur
          theme_advanced_text_colors : "#444, #EEA852",
          // balise html disponible
          theme_advanced_blockformats : "h3,h4,h5,h6",
      });
     </script>
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
  </body>
</html>
