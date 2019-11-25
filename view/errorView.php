<?php $title = 'Une erreur s\'est produite' ?>

<?php ob_start(); ?>

<header id="header">
  <?php include('view/nav.php'); ?>

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

</header>

<main id="layout-post">
  <section id="content-news">
    <header>
      <h1>
          Erreur
      </h1>
    </header>

    <article class="news">

      <?php
        if (isset($errorMessage)) {
          echo htmlspecialchars($errorMessage);
        }
      ?>

      <p><a href="<?= $_SERVER['HTTP_REFERER'] ?>">Page précédente</a></p>
    </article>

  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
