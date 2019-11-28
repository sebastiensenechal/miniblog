<?php $title = 'Commentaires en attente | Backoffice'; ?>

<?php ob_start(); ?>

<?php include('view/navBackend.php'); ?>

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
          <span class="comment-date"><?= htmlspecialchars($comment['comment_date_fr']) ?></span></span></p>
          <?= $comment['comment'] ?>

          <ul class="admin-content">
            <li><a href="index.php?action=approvedComment&amp;id_post=<?= htmlspecialchars($comment['post_id']);?>&amp;id=<?= htmlspecialchars($comment['id']);?>">Approuver</a></li>
            <li><a href="index.php?action=deleteComment&amp;postId=<?= htmlspecialchars($comment['post_id']);?>&amp;id=<?= htmlspecialchars($comment['id']);?>">Supprimer</a></li>
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
