<?php
  require('model.php');

  // Appel la fonction getPosts de model.php et stock le résultat dans la variable $posts
  $posts = getPosts();

  require('indexView.php');
