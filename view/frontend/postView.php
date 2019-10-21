<?php $title = 'Mon blog | ' . htmlspecialchars($post['title']) ?>

<?php ob_start(); ?>

<header id="header">
  <h1>John Do</h1>
  <p><a href="./index.php" title="Index des billets">Retour à la liste des billets</a></p>
</header>

<div id="layout-post">
  <section id="content-news">
    <header>
      <h2>
          <?= htmlspecialchars($post['title']) ?><br />
          <span><?= $post['creation_date_fr'] ?></span>
      </h2>
    </header>

    <article class="news">
        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>

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
          <div class="content-comment">
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong><br />
            <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
          </div>
        <?php
        }
        ?>

      </div>
    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('template.php') ?>
