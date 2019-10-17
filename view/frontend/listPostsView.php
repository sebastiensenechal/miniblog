<?php $title = 'Mon blog' ?>

<?php ob_start(); ?>

<header>
  <h1>Mini blog</h1>
  <h2>Derniers billets</h2>
</header>

<section id="list-news">
  <?php
  while ($data = $posts->fetch())
  {
  ?>
      <article class="news">
          <h3>
              <?= htmlspecialchars($data['title']) ?>
              <em>le <?= $data['creation_date_fr'] ?></em>
          </h3>

          <p>
              <?= nl2br(htmlspecialchars($data['content'])) ?>
              <br />
              <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
          </p>
      </article>
  <?php
  }
  $posts->closeCursor();
  ?>

</section>

<?php $content = ob_get_clean() ?>

<?php require('template.php') ?>
