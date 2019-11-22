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

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

  <figure id="logo">
    <img src="././public/img/logo-gris.svg" alt="Logo de l'écrivain John Doe">
  </figure>

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

      <h2>Commentaires</h2>

      <?php
      if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])) {
        include('view/commentForm.php');
      } else {
        ?>
          <p>Pour laisser un commentaire, vous devez être <a href="index.php?action=login" title="Page d'inscription ou de connexion">connecté</a>...</p>
        <?php
      }

      while ($comment = $comments->fetch())
      {
      ?>
        <aside class="content-comment">
          <p><span class="meta-content"><?= htmlspecialchars($comment['author']) ?><br />
          <span class="comment-date"><?= $comment['comment_date_fr'] ?></span></span></p>
          <?= nl2br($comment['comment']) ?>
          <ul class="admin-content">
            <li><a href="index.php?action=report&amp;id_post=<?= $post['id'];?>&amp;id=<?= $comment['id']; ?>">Signaler</a></li>
          </ul>
        </aside>
      <?php
      }
      $comments->closeCursor();
      ?>

      </div>


      <h2>Derniers articles</h2>
      <ul>
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
    </article>

  </section>

</div>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
