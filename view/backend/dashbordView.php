<?php $title = 'Tableau de bord'; ?>

<?php ob_start(); ?>

<?php include('view/nav_backend.php'); ?>

<main id="dashbord-grid">

  <section id="content-news">
    <header id="header_dashbord">
      <h1>Tableau de bord</h1>
      <p>Bienvenu <?= htmlspecialchars($_SESSION['pseudo']); ?></p>
    </header>

    <h2>Derniers articles : </h2>

    <div id="content_dashbord">
      <?php
      while($data = $post->fetch())
      {
      ?>
          <article class="news">
              <h3><a href="index.php?action=adminPost&amp;id=<?= htmlspecialchars($data['id']) ?>" title="Lire la suite">
                  <?= htmlspecialchars($data['title']); ?><br />
                  <span><?= htmlspecialchars($data['creation_date_fr']); ?></span>
              </a></h3>

              <?= nl2br($data['excerpt']); ?>

              <p><a href="index.php?action=adminPost&amp;id=<?= htmlspecialchars($data['id']) ?>">Lire la suite</a></p>
          </article>
      <?php
      }
      $post->closeCursor(); ?>

      <h2>Derniers commentaires : </h2>

      <?php
      while($data = $comment->fetch()){
          ?>
          <aside class="content-comment">
            <p><span class="meta-content"><?= htmlspecialchars($data['author']); ?><br />
            <?= htmlspecialchars($data['comment_date_fr']); ?></span></p>
            <?= $data['comment']; ?>
          </aside>
          <?php
      }
      $comment->closeCursor(); ?>
    </div>
  </section>

</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
