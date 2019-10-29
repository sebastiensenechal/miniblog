<?php $title = 'Ajout d\'un article ' ?>

<?php ob_start(); ?>

<header id="header">
  <h1>Création d'un article</h1>
  <?php include('./view/nav_backend.php') ?>
</header>

<div id="layout-post">
  <section id="content-news">
    <header>
      <h2>
          Ajouter un article
      </h2>
    </header>

    <article class="news">

      <div>

          <form action="index.php?action=createPost&amp;id=<?= $post['id'] ?>" method="post">
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
