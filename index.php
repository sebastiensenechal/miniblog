<?php
  require('model.php');

  // APpel la fonction getPosts de model.php et stock le résultat dans la variable $req
  $posts = getPosts();

  require('indexView.php');
