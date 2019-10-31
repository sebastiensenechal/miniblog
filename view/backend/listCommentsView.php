<?php $title = 'List Comments View' ?>

<?php ob_start(); ?>

<header id="header">
  <h1>John Doe</h1>
  <?php include('./view/nav_backend.php') ?>
</header>

<div id="layout-post">
  <section id="content-news">
    <header>
      <h2>
          Liste des commentaires
      </h2>
    </header>

    <article class="news">

      <?php
      while ($comment = $comments->fetch())
      {
      ?>
        <aside class="content-comment">
          <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
          <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></span></p>
          <p><?= nl2br($comment['comment']) ?></p>

          <ul class="admin-content">
            <li><a href="index.php?action=userUpdateComment&amp;id=<?= $comment['id'];?>">Éditer</a></li>
            <li><a href="#">Signaler</a></li>
            <li><a href="index.php?action=deleteComment&amp;id=<?= $comment['id'];?>">Supprimer</a></li>
          </ul>
        </aside>
      <?php
      }
      $comments->closeCursor(); ?>

    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('view/template.php') ?>
