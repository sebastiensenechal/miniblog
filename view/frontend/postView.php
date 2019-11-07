<?php $title = 'Mon blog | ' . htmlspecialchars($post['title']) ?>

<?php ob_start(); ?>

<header id="header">
  <h1><a href="index.php" title="Accueil de John Doe">John Doe</a></h1>
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
            <?= nl2br($post['content']) ?>
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
          <aside class="content-comment">
            <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
            <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></span></p>
            <p><?= nl2br($comment['comment']) ?></p>
            <ul class="admin-content">
              <li><a href="index.php?action=userUpdateComment&amp;id_post=<?= $post['id'];?>&amp;id=<?= $comment['id'];?>">Éditer</a></li>
              <li><a href="index.php?action=report&amp;id_post=<?= $post['id'];?>&amp;id=<?= $comment['id']; ?>">Signaler</a></li>
            </ul>
          </aside>
        <?php
        }
        $comments->closeCursor();
        ?>

      </div>
    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('view/template.php') ?>
