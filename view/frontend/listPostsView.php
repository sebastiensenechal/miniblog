<?php $title = 'Liste des articles' ?>

<?php ob_start(); ?>

<header id="header">
  <?php
  if (empty($page))
  {
    $page = 'nav';
    $page = trim('view/' . $page.'.php');
    if (file_exists($page))
    {
      include($page);
    }
    else
    {
      echo "Page inexistante !";
    }
  }
  ?>

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

  <figure id="photo">
    <!-- <img src="././public/img/logo-gris.svg" alt=""> -->
    <img src="././public/img/montagnes-pyrenees-480.jpg" alt="Montagne dans les Pyrénées">
    <figcaption>
      <p>© Sébastien Sénéchal</p>
    </figcaption>
  </figure>

</header>

<div id="layout-post">
  <section>
    <header>
      <h1>
          Liste des articles
      </h1>
    </header>

    <div id="posts-grid">
      <?php
      while ($data = $posts->fetch())
      {
      ?>
          <article class="news">
              <h3>
                  <?= htmlspecialchars($data['title']) ?><br />
                  <span><?= $data['creation_date_fr'] ?></span>
              </h3>

              <?= nl2br($data['excerpt']); ?>

              <p><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
          </article>
      <?php
      }
      $posts->closeCursor();
      ?>
    </div>
  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
