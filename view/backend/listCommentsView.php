<?php $title = 'Listes des commentaires | Backoffice'; ?>

<?php ob_start(); ?>

<?php include('view/nav_backend.php'); ?>

<main id="dashbord-grid">

  <section id="content-comments">
    <header>
      <h1>
          Liste des commentaires
      </h1>

      <ul class="admin-link">
        <li><a href="index.php?action=adminCommentsReport" title="Commentaires signalés">Commentaires signalés</a></li>
        <li><a href="index.php?action=adminCommentsStandby" title="En attente de validation">Commentaires en attente</a></li>
      </ul>
    </header>

    <article class="content">

      <?php
      while ($comment = $comments->fetch())
      {
      ?>
        <aside class="content-comment">
          <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
          <span class="comment-date"><?= htmlspecialchars($comment['comment_date_fr']) ?></span></span></p>
          <?= $comment['comment'] ?>

          <ul class="admin-content">
            <li><a href="index.php?action=disable&amp;id_post=<?= htmlspecialchars($comment['post_id']);?>&amp;id=<?= htmlspecialchars($comment['id']); ?>">Désactiver</a></li>
            <li><a href="index.php?action=deleteComment&amp;postId=<?= htmlspecialchars($comment['post_id']);?>&amp;id=<?= htmlspecialchars($comment['id']);?>">Supprimer</a></li>
          </ul>
        </aside>
      <?php
      }
      $comments->closeCursor(); ?>

    </article>

  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
