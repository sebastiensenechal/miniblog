<?php $title = 'List Posts View' ?>

<?php ob_start(); ?>

<header id="header">
  <h1>John Doe</h1>
  <?php include('./view/nav_backend.php') ?>
</header>

<div id="layout-post">
  <section id="content-news">
    <header>
      <h2>
          Liste des articles
      </h2>
    </header>

    <article class="news">

        <?php
        while ($data = $posts->fetch())
        {
        ?>
            <article class="news">
                <h3>
                    <?= htmlspecialchars($data['title']) ?><br />
                    <span><?= $data['creation_date_fr'] ?></span>
                </h3>

                <p>
                    <?= nl2br(substr($data['content'], 0, 300)); ?>...
                </p>
                <ul class="admin-content">
                  <li><a href="./index.php?action=adminUpdatePost&amp;id=<?= $data['id']; ?>">Éditer</a></li>
                  <li><a href="./index.php?action=deletePost&amp;id=<?= $data['id']; ?>">Supprimer</a></li>
                  <li><a href="./index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></li>
                </ul>
            </article>
        <?php
        }
        $posts->closeCursor();
        ?>

    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('view/backend/template.php') ?>
