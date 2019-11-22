<?php $title = 'Qui est John Doe' ?>

<?php ob_start(); ?>

<header id="header">
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

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

  <figure id="photo">
    <img class="circle" src="././public/img/sebastien-senechal-480.jpg" alt="Portrait de l'écrivain John Doe">
    <figcaption>
      <p>Portrait de John Doe - © Sophie Rueter</p>
    </figcaption>
  </figure>

</header>

<div id="layout-post">
  <section id="content-news">
    <header>
      <h1>
          A propos
      </h1>
    </header>

    <article class="news">

      <p><strong>Cum saepe multa, tum memini domi in hemicyclio sedentem, ut solebat, cum et ego essem una et pauci admodum familiares</strong></p>
      <p>Cum saepe multa, tum memini domi in hemicyclio sedentem, ut solebat, cum et ego essem una et pauci admodum familiares, in eum sermonem illum incidere qui tum forte multis erat in ore. Meministi enim profecto, Attice, et eo magis, quod P. Sulpicio utebare multum, cum is tribunus plebis capitali odio a Q. Pompeio, qui tum erat consul, dissideret, quocum coniunctissime et amantissime vixerat, quanta esset hominum vel admiratio vel querella.</p>
      <p>Et quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.</p>

    </article>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
