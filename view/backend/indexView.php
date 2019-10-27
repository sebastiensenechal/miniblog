<?php $title = 'Site de John Doe, vous êtes connecté' ?>

<?php ob_start(); ?>

<header id="main_header">

  <div id="header_content">
    <h1>John Doe<br />
    <span>Essayiste - Auteur - Ecrivain</span></h1>
    <p>Bienvenu <?= $_SESSION['pseudo']; ?></p>
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
      <h2 style="color: #000;font-weight:100;line-height:1.5em;">John Doe <span style="font-size:1em">est un écrivain français installé à Paris.<br />
        Il écris des nouvelles et des essais depuis bientôt de 10 ans.</span></h2>
    </header>

    <?php
    while ($data = $post->fetch())
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
            <p><a href="index.php?action=adminPost&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
        </article>
    <?php
    }
    $post->closeCursor();
    ?>

    <h3>Derniers commentaires : </h3>

    <?php
    while ($data = $comment->fetch())
    {
        ?>
        <p><strong><?= htmlspecialchars($data['author']); ?></strong> le <?= $data['comment_date_fr']; ?></p>
        <p><?= nl2br(htmlspecialchars($data['comment'])); ?></p>
        <?php
    }
    $comment->closeCursor(); ?>

  </section>

</div>

<?php $content = ob_get_clean() ?>

<?php require('view/template.php') ?>
