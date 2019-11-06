<?php $title = htmlspecialchars($post['title']) ?>

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
    </header>

    <article class="news">
      <?= $post['content']; ?>

      <div id="post-comments">
        <h2>Laissez un commentaire</h2>

        <div id="comment-form">
          <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <fieldset>
              <label for="author">* Auteur</label><br>
              <input type="text" id="author" name="author" />
            </fieldset>
            <fieldset>
              <label for="comment">* Commentaire</label><br>
              <textarea id="comment" name="comment"></textarea>
            </fieldset>
            <fieldset>
              <input type="submit" />
            </fieldset>
          </form>
        </div>

        <h2>Commentaires</h2>

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
          <aside class="content-comment">
            <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
            <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></span></p>
            <p><?= $comment['comment']; ?></p>

            <ul class="admin-content">
              <li><a href="index.php?action=report&amp;id_post=<?= $post['id'];?>&amp;id=<?= $comment['id']; ?>">Désactiver</a></li>
              <li><a href="index.php?action=deleteComment&amp;id=<?= $comment['id'];?>">Supprimer</a></li>
            </ul>
          </aside>
        <?php
        }
        ?>

      </div>
    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('view/backend/template.php') ?>
