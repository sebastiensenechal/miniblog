<?php $title = 'Tableau de bord du site de John Do' ?>

<?php ob_start(); ?>

<header id="main_header">

  <div id="header_content">
    <h1>John Do<br />
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
      <h2 style="color: #000;font-weight:100;line-height:1.5em;">John Do <span style="font-size:1em">est un écrivain français installé à Paris.<br />
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

            <p>
                <?= nl2br(htmlspecialchars($data['content'])) ?>
            </p>
            <p><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></p>
        </article>
    <?php
    }
    $posts->closeCursor();
    ?>

  </section>

</div>

<?php $content = ob_get_clean() ?>

<?php require('view/template.php') ?>