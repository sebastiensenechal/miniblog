<?php $title = 'Liste des articles | Backoffice'; ?>

<?php ob_start(); ?>

<?php include('view/navBackend.php'); ?>

<main id="dashbord-grid">

  <section>
    <header>
      <h1>
          Liste des articles
      </h1>
      <ul class="admin-link">
        <li><a href="index.php?action=adminNewPost" title="Créer un article">Ajouter</a></li>
      <ul>
    </header>

    <div id="posts-grid">
      <?php
      while ($data = $posts->fetch())
      {
      ?>
          <article class="news">
              <h2>
                  <?= htmlspecialchars($data['title']) ?><br />
                  <span><?= htmlspecialchars($data['creation_date_fr']) ?></span>
              </h2>

              <?= nl2br($data['excerpt']); ?>

              <ul class="admin-content">
                <li><a href="index.php?action=adminUpdatePost&amp;id=<?= htmlspecialchars($data['id']); ?>">Éditer</a></li>
                <li><a href="index.php?action=deletePost&amp;id=<?= htmlspecialchars($data['id']); ?>">Supprimer</a></li>
                <li><a href="index.php?action=adminPost&amp;id=<?= htmlspecialchars($data['id']); ?>">Lire la suite</a></li>
              </ul>
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
