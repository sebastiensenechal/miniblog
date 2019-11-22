<?php $title = 'Commentaires en attente'; ?>

<?php ob_start(); ?>

<?php include('view/nav_backend.php'); ?>

<main id="dashbord-grid">

  <section id="content-news">
    <header>
      <h1>
          Commentaires en attente
      </h1>
      <ul class="admin-link">
        <li><a href="index.php?action=adminListComments" title="Liste des commentaires">Retour aux commentaires</a></li>
      </ul>
    </header>

    <article class="news">

      <?php
      while ($comment = $standbyComments->fetch())
      {
      ?>
        <aside class="content-comment">
          <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
          <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></span></p>
          <?= $comment['comment'] ?>

          <ul class="admin-content">
            <li><a href="index.php?action=approvedComment&amp;id_post=<?= $comment['post_id'];?>&amp;id=<?= $comment['id'];?>">Approuver</a></li>
            <li><a href="index.php?action=deleteComment&amp;postId=<?= $comment['post_id'];?>&amp;id=<?= $comment['id'];?>">Supprimer</a></li>
          </ul>
        </aside>
      <?php
      }
      $standbyComments->closeCursor(); ?>

    </article>

  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
