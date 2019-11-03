<?php $title = 'Listes des commentaires' ?>

<?php ob_start(); ?>

<div id="main_navigation_backend">
  <?php include('./view/nav_backend.php'); ?>
</div>

<div id="dashbord-grid">
  <section id="content-news">
    <header>
      <h1>
          Liste des commentaires
      </h1>
    </header>

    <article class="news">

      <?php
      while ($comment = $comments->fetch())
      {
      ?>
        <aside class="content-comment">
          <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
          <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></span></p>
          <?= $comment['comment'] ?>

          <ul class="admin-content">
            <li><a href="index.php?action=userUpdateComment&amp;id=<?= $comment['id'];?>">Éditer</a></li>
            <li><a href="#">Signaler</a></li>
            <li><a href="index.php?action=deleteComment&amp;postId=<?= $comment['post_id'];?>&amp;id=<?= $comment['id'];?>">Supprimer</a></li>
          </ul>
        </aside>
      <?php
      }
      $comments->closeCursor(); ?>

    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('view/backend/template.php') ?>
