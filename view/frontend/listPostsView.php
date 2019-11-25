<?php $title = 'Liste des articles' ?>

<?php ob_start(); ?>

<header id="header">
  <?php include('view/nav.php'); ?>

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

  <figure id="photo">
    <img src="././public/img/montagnes-pyrenees-480.jpg" alt="Montagne dans les Pyrénées">
    <figcaption>
      <p>© Sébastien Sénéchal</p>
    </figcaption>
  </figure>

</header>

<main id="layout-post">
  <section>
    <header>
      <h2>
          Liste des articles
      </h2>
    </header>

    <div id="posts-grid">
      <?php
      while ($data = $posts->fetch())
      {
      ?>
          <article class="news">
              <h3><a href="index.php?action=post&amp;id=<?= htmlspecialchars($data['id']) ?>" title="Lire la suite">
                  <?= htmlspecialchars($data['title']) ?><br />
                  <span><?= htmlspecialchars($data['creation_date_fr']) ?></span>
              </a></h3>

              <?= nl2br($data['excerpt']); ?>

              <p><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
          </article>
      <?php
      }
      $posts->closeCursor();
      ?>
    </div>
  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
