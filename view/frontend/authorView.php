<?php $title = 'Qui est John Doe' ?>

<?php ob_start(); ?>

<header id="header">
  <?php include('view/nav.php'); ?>

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

  <figure id="photo">
    <img class="circle" src="././public/img/sebastien-senechal-480.jpg" alt="Portrait de l'écrivain John Doe">
    <figcaption>
      <p>Portrait de John Doe - © Sophie Rueter</p>
    </figcaption>
  </figure>

</header>

<main id="layout-post">
  <section id="content-news">
    <header>
      <h2>
          A propos
      </h2>
    </header>

    <article class="news">

      <p><strong>Ecrivain et essayiste installé près de Paris, j'écris de préférence de court essais et des études.</strong></p>
      <p>Cum saepe multa, tum memini domi in hemicyclio sedentem, ut solebat, cum et ego essem una et pauci admodum familiares, in eum sermonem illum incidere qui tum forte multis erat in ore. Meministi enim profecto, Attice, et eo magis, quod P. Sulpicio utebare multum, cum is tribunus plebis capitali odio a Q. Pompeio, qui tum erat consul, dissideret, quocum coniunctissime et amantissime vixerat, quanta esset hominum vel admiratio vel querella.</p>
      
    </article>

  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
