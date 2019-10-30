<?php $title = 'Backoffice - Modifier l\'article ' . htmlspecialchars($post['title'] . ' | John Doe') ?>

<?php ob_start(); ?>

<header id="header">
  <h1>John Doe</h1>
  <?php include('./view/nav_backend.php') ?>
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

      <div>
        <h2>Modifier l'article</h2>

          <form action="index.php?action=updatePost&amp;id=<?= $post['id'] ?>" method="post">
            <fieldset>
              <label for="author">Auteur</label><br>
              <input type="text" name="author" id="author" value="<?php
                if (isset($_SESSION['pseudo']))
                {
                    echo htmlspecialchars($_SESSION['pseudo']);
                }
                ?>"
              />
            </fieldset>
            <fieldset>
              <label for="title">Titre</label><br />
              <input type="text" id="title" name="title" />
            </fieldset>
            <fieldset>
              <label for="content">Contenu</label><br />
              <textarea id="content" name="content" placeholder="C'est à vous de jouer..."></textarea>
            </fieldset>
            <fieldset>
              <input type="submit" />
            </fieldset>
          </form>

      </div>
    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('view/template.php') ?>
