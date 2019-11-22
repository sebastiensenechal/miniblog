<?php $title = $post['title']; ?>

<?php ob_start(); ?>

<div id="main_navigation_backend">
  <?php include('view/nav_backend.php'); ?>
</div>

<div id="dashbord-grid">
  <section id="content-news">
    <header>
      <h1>
          <?= htmlspecialchars($post['title']) ?><br />
          <span><?= $post['creation_date_fr'] ?></span>
      </h1>
      <ul class="admin-link">
        <li><a href="index.php?action=adminUpdatePost&amp;id=<?= $post['id']; ?>">Éditer</a></li>
        <li><a href="index.php?action=deletePost&amp;id=<?= $post['id']; ?>">Supprimer</a></li>
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
            <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></span></p>
            <?= $comment['comment']; ?>

            <ul class="admin-content">
              <li><a href="index.php?action=disable&amp;id=<?= $comment['id']; ?>">Désactiver</a></li>
              <li><a href="index.php?action=deleteComment&amp;id=<?= $comment['id'];?>">Supprimer</a></li>
            </ul>
          </aside>
        <?php
        }
        $comments->closeCursor(); ?>

      </div>
    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
