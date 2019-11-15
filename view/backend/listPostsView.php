<?php ob_start(); ?>

<?php $title = 'Liste des articles' ?>

<div id="main_navigation_backend">
  <?php include('view/nav_backend.php'); ?>
</div>

<div id="dashbord-grid">
  <section>
    <header>
      <h1>
          Liste des articles
      </h1>
      <p><a href="index.php?action=adminNewPost" title="Créer un article">Ajouter</a></p>
    </header>

    <div id="posts-grid">
      <?php
      while ($data = $posts->fetch())
      {
      ?>
          <article class="news">
              <h2>
                  <?= htmlspecialchars($data['title']) ?><br />
                  <span><?= $data['creation_date_fr'] ?></span>
              </h2>

              <?= nl2br($data['excerpt']); ?>

              <ul class="admin-content">
                <li><a href="index.php?action=adminUpdatePost&amp;id=<?= $data['id']; ?>">Éditer</a></li>
                <li><a href="index.php?action=deletePost&amp;id=<?= $data['id']; ?>">Supprimer</a></li>
                <li><a href="index.php?action=adminPost&amp;id=<?= $data['id']; ?>">Lire la suite</a></li>
              </ul>
          </article>
      <?php
      }
      $posts->closeCursor();
      ?>
  </div>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('template.php') ?>
