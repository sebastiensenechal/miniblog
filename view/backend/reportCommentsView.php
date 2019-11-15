<?php $title = 'Commentaires en attente' ?>

<?php ob_start(); ?>

<div id="main_navigation_backend">
  <?php include('./view/nav_backend.php'); ?>
</div>

<div id="dashbord-grid">
  <section id="content-news">
    <header>
      <h1>
          Commentaires signalés
      </h1>
      <p><a href="index.php?action=adminListComments" title="Liste des commentaires">Retour aux commentaires</a></p>
    </header>

    <article class="news">

      <?php
      while ($comment = $reportComments->fetch())
      {
      ?>
        <aside class="content-comment">
          <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
          <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></span></p>
          <?= $comment['comment'] ?>

          <ul class="admin-content">
            <li><a href="index.php?action=approvedReportComment&amp;id_post=<?= $comment['post_id'];?>&amp;id=<?= $comment['id'];?>">Approuver</a></li>
            <li><a href="index.php?action=deleteComment&amp;postId=<?= $comment['post_id'];?>&amp;id=<?= $comment['id'];?>">Supprimer</a></li>
          </ul>
        </aside>
      <?php
      }
      $reportComments->closeCursor(); ?>

    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('template.php') ?>
