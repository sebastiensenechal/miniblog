<?php $title = htmlspecialchars($post['title']) . ' | Backoffice' ?>

<?php ob_start(); ?>

<?php include('view/navBackend.php'); ?>

<main id="dashbord-grid">

  <section id="content-news">
    <header>
      <h1>
          <?= htmlspecialchars($post['title']) ?><br />
          <span><?= htmlspecialchars($post['creation_date_fr']) ?></span>
      </h1>
      <ul class="admin-link">
        <li><a href="index.php?action=adminUpdatePost&amp;id=<?= htmlspecialchars($post['id']); ?>">Éditer</a></li>
        <li><a href="index.php?action=deletePost&amp;id=<?= htmlspecialchars($post['id']); ?>">Supprimer</a></li>
      </ul>
    </header>

    <article class="news">
      <?= $post['content']; ?>

      <div id="post-comments">
        <h2>Commentaires</h2>

        <?php include('view/commentForm.php'); ?>

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
          <aside class="content-comment">
            <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
            <span class="comment-date"><?= htmlspecialchars($comment['comment_date_fr']) ?></span></span></p>
            <?= $comment['comment']; ?>

            <ul class="admin-content">
              <li><a href="index.php?action=disable&amp;id=<?= htmlspecialchars($comment['id']); ?>">Désactiver</a></li>
              <li><a href="index.php?action=deleteComment&amp;id=<?= htmlspecialchars($comment['id']);?>">Supprimer</a></li>
            </ul>
          </aside>
        <?php
        }
        $comments->closeCursor(); ?>

      </div>
    </article>

  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
