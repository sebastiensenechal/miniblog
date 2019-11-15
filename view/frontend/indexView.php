<?php $title = 'John Doe' ?>

<?php ob_start(); ?>

<header id="main_header">
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

  <div id="header_content">
    <img src="././public/img/logo-gris.svg" alt="">
    <h1><a href="index.php" title="Accueil de John Doe">John Doe</a><br />
    <span>Essayiste - Auteur - Ecrivain</span></h1>
  </div>

  <figure id="image_home">
    <img src="././public/img/landscape.jpg" alt="">
      <figcaption>
        <!-- Légende -->
      </figcaption>
  </figure>
</header>

<div id="home-grid">
  <section id="list-news">
    <header class="content_header">
      <h2 class="big-chars" style="color: #000;">John Doe <span>est un écrivain français installé à Paris.<br />
        Il écris des nouvelles et des essais depuis bientôt de 10 ans.</span></h2>
    </header>

    <?php
    while ($data = $posts->fetch())
    {
    ?>
        <article class="news">
            <h3>
                <?= htmlspecialchars($data['title']) ?><br />
                <span><?= $data['creation_date_fr'] ?></span>
            </h3>

            <?= nl2br($data['excerpt']); ?>

            <p><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
        </article>
    <?php
    }
    $posts->closeCursor();
    ?>

  </section>

</div>

<?php $content = ob_get_clean() ?>

<?php require('template.php') ?>
