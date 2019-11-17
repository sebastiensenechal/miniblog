<?php $title = 'John Doe | ' . htmlspecialchars($post['title']) ?>

<?php ob_start(); ?>

<header id="header">
  <?php
  if (empty($page))
  {
    $page = 'nav';
    $page = trim('view/' . $page.'.php');
    if (file_exists($page))
    {
      include($page);
    }
    else
    {
      echo "Page inexistante !";
    }
  }
  ?>

  <h1><a href="index.php" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

  <figure id="logo">
    <img src="././public/img/logo-gris.svg" alt="Logo de l'écrivain John Doe">
  </figure>

  <p><span class="big-chars">Derniers articles</span></p>

  <ul class="list-center">
    <?php
    while ($data = $lastPosts->fetch())
    {
    ?>
      <li><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a></li>
    <?php
    }
    $lastPosts->closeCursor();
    ?>
  </ul>
</header>

<div id="layout-post">
  <section id="content-news">
    <header>
      <h1>
          <?= htmlspecialchars($post['title']) ?><br />
          <span><?= $post['creation_date_fr'] ?></span>
      </h1>
    </header>

    <article class="news">

      <?= nl2br($post['content']) ?>

      <div id="post-comments">

      <?php
      if (isset($_SESSION['id']) && isset($_SESSION['pseudo']))
      {
        ?>
          <h2>Laissez un commentaire</h2>

          <div id="comment-form">
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
              <fieldset>
                <label for="author">* Auteur</label><br>
                <input type="text" id="author" name="author" value="<?php
                  if (isset($_SESSION['pseudo']))
                  {
                      echo htmlspecialchars($_SESSION['pseudo']);
                  }
                  ?>" />
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
        <?php
      }
      ?>

        <h2>Commentaires</h2>
        <p><em>Les commentaires sont soumis à validation</em>.</p>

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
          <aside class="content-comment">
            <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
            <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></span></p>
            <p><?= nl2br($comment['comment']) ?></p>
            <ul class="admin-content">
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

<?php require('template.php') ?>
