<?php $title = 'Jean Forteroche' ?>

<?php ob_start(); ?>

<header id="main_header">
  <?php include('view/nav.php'); ?>

  <div id="header_content">
    <?php include('view/navigation.php'); ?>

    <div id="container">
      <img src="././public/img/logo-gris.svg" alt="">
      <h1><a href="index.php" title="Accueil de Jean Forteroche">Jean Forteroche</a><br />
      <span>Billet simple pour l'Alaska</span></h1>
    </div>
  </div>

  <figure id="image_home">
    <picture>
      <source srcset="././public/img/montagnes-pyrenees2-1200.jpg" media="(min-width: 480px)">
      <img src="././public/img/montagnes-pyrenees-480.jpg" alt="Photographie de montagnes dans les Pyrénées." />
    </picture>
  </figure>
</header>

<main id="home-grid">
  <section id="list-news">
    <header class="content_header">
      <h2 class="big-chars" style="color: #000;">Jean Forteroche <span>est un écrivain français installé à Paris.<br />
        Il écris des nouvelles et des essais depuis bientôt 10 ans.</span></h2>
    </header>

    <?php
    while ($data = $lastPosts->fetch())
    {
    ?>
        <article class="news">
            <h3><a href="index.php?action=post&amp;id=<?= htmlspecialchars($data['id']) ?>" title="Lire la suite">
                <?= htmlspecialchars($data['title']) ?><br />
                <span><?= htmlspecialchars($data['creation_date_fr']) ?></span>
            </a></h3>

            <?= nl2br($data['excerpt']); ?>

            <p><a href="index.php?action=post&amp;id=<?= htmlspecialchars($data['id']) ?>">Lire la suite</a></p>
        </article>
    <?php
    }
    $lastPosts->closeCursor();
    ?>

  </section>

</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
