<?php $title = 'John Do' ?>

<?php ob_start(); ?>

<header>
  <div id="header-content">
    <h1>John Do<br />
    <span>Essayiste - Auteur - Ecrivain</span></h1>
  </div>
</header>

<section id="list-news">

  <h2>Derniers billets</h2>

  <?php
  while ($data = $posts->fetch())
  {
  ?>
      <article class="news">
          <h3>
              <?= htmlspecialchars($data['title']) ?><br />
              <span><?= $data['creation_date_fr'] ?></span>
          </h3>

          <p>
              <?= nl2br(htmlspecialchars($data['content'])) ?>
          </p>
          <p><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></p>
      </article>
  <?php
  }
  $posts->closeCursor();
  ?>

</section>

<?php $content = ob_get_clean() ?>

<?php require('template.php') ?>
