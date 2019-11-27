<?php $title = 'Modifier "' . htmlspecialchars($post['title']) . '" | Backoffice'; ?>

<?php ob_start(); ?>

<?php include('view/nav_backend.php'); ?>

<main id="dashbord-grid">

  <section id="content-news">
    <header>
      <h1>Modifier :
          <?= htmlspecialchars($post['title']); ?><br />
          <span><?= htmlspecialchars($post['creation_date_fr']); ?></span>
      </h1>
      <ul class="admin-link">
        <li><a href="index.php?action=adminListPosts" title="Voir tous les articles">Retour aux articles</a></li>
      </ul>
    </header>

    <article class="news">
      <form action="index.php?action=updatePost&amp;id=<?= htmlspecialchars($post['id']) ?>" method="post">
        <fieldset>
          <label for="author">Auteur</label><br>
          <input type="text" name="author" id="author" value="<?php
            if (isset($_SESSION['pseudo']))
            {
                echo htmlspecialchars($_SESSION['pseudo']);
            }
            ?>" readonly="readonly" />
        </fieldset>
        <fieldset>
          <label for="title">Titre</label><br />
          <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']); ?>" />
        </fieldset>
        <fieldset>
          <label for="content">Contenu</label><br />
          <textarea id="content" name="content" rows="20"><?= $post['content']; ?></textarea>
        </fieldset>
        <fieldset>
          <label for="excerpt">Extrait</label><br />
          <textarea id="excerpt" name="excerpt" rows="10"><?= $post['excerpt']; ?></textarea>
        </fieldset>
        <fieldset>
          <input type="submit" />
        </fieldset>
      </form>

    </article>

  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
