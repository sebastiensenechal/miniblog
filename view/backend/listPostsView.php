<?php $title = 'List Posts View' ?>

<?php ob_start(); ?>

<header id="header">
  <h1>John Doe</h1>
  <p><a href="./index.php" title="Index des billets">Retour à la liste des billets</a></p>
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
                    <?= nl2br(htmlspecialchars(substr($data['content'], 0, 150))); ?>...
                </p>
                <p><a href="./index.php?action=adminUpdatePost&amp;id=<?= $data['id']; ?>">Éditer</a></p>
                <p><a href="./index.php?action=deletePost&amp;id=<?= $data['id']; ?>">Supprimer</i></a></p>
                <p><a href="./index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
            </article>
        <?php
        }
        $posts->closeCursor();
        ?>

    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('view/template.php') ?>
