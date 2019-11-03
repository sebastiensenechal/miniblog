<?php $title = 'Ajout d\'un article' ?>

<?php ob_start(); ?>

<div id="main_navigation_backend">
  <?php include('./view/nav_backend.php'); ?>
</div>

<div id="dashbord-grid">
  <section id="content-news">
    <header>
      <h1>
          Ajouter un article
      </h1>
      <p><a href="index.php?action=adminListPosts">Retour aux articles</a></p>
    </header>

    <article class="news">

      <form action="index.php?action=createPost" method="POST">
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
          <textarea id="content" name="content" rows="25" placeholder="C'est à vous de jouer..."></textarea>
        </fieldset>
        <fieldset>
          <input type="submit" />
        </fieldset>
      </form>

    </article>

  </section>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>
