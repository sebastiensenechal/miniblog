<?php $title = 'John Doe | ' . htmlspecialchars($post['title']) ?>

<?php ob_start(); ?>

<header id="header">
  <?php include('view/nav.php'); ?>

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

  <figure id="logo">
    <img src="././public/img/logo-gris.svg" alt="Logo de l'écrivain John Doe">
  </figure>

</header>

<main id="layout-post">
  <section id="content-news">
    <header>
      <h2>
          <?= htmlspecialchars($post['title']) ?><br />
          <span><?= htmlspecialchars($post['creation_date_fr']) ?></span>
      </h2>
      <ul class="admin-link">
        <li><a href="index.php?action=listPosts">Retour aux articles</a></li>
      </ul>
    </header>

    <article class="news">

      <?= nl2br($post['content']) ?>

      <div id="post-comments">

      <h2>Commentaires</h2>

      <?php
      if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])) {
        include('view/commentForm.php');

        if (isset($_COOKIE['message_report'])) {
          echo '<p class="validate">' . htmlspecialchars($_COOKIE['message_report']) . '</p>';
        }

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
          <span class="comment-date"><?= htmlspecialchars($comment['comment_date_fr']) ?></span></span></p>
          <?= nl2br($comment['comment']) ?>
          <?php
          if (isset($_SESSION['id']) && isset($_SESSION['pseudo'])) {
            ?>
            <ul class="admin-content">
              <li><a href="index.php?action=report&amp;id_post=<?= htmlspecialchars($post['id']);?>&amp;id=<?= htmlspecialchars($comment['id']); ?>">Signaler</a></li>
            </ul>
            <?php
          }
          ?>
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
          if (!empty($data)) {
            ?>
              <li><a href="index.php?action=post&amp;id=<?= htmlspecialchars($data['id']) ?>"><?= htmlspecialchars($data['title']) ?></a></li>
            <?php
          }
        }
        $lastPosts->closeCursor();
        ?>
      </ul>
    </article>

  </section>

</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
