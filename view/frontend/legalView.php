<?php $title = 'Qui est John Doe' ?>

<?php ob_start(); ?>

<header id="header">
  <?php include('view/nav.php'); ?>

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

  <figure id="photo">
    <img src="././public/img/logo-gris.svg" alt="">
    <figcaption>
      <p>John Doe © Sébastien Sénéchal</p>
    </figcaption>
  </figure>

</header>

<main id="layout-post">
  <section id="content-news">
    <header>
      <h2>
          Mentions légales<br />
          <span>Novembre 2019</span>
      </h2>
      <nav aria-label="Breadcrumb" class="breadcrumb">
        <ul>
            <li><a href="index.php?action=indexView" title="Retour à l'accueil">Accueil</a></li>
            <li><span aria-current="page">Mentions légales</span></li>
        </ul>
      </nav>
    </header>

    <article class="news">

      <h2>Blog de John Doe<br />
      <span>https://sebastiensenechal.com/openclassroom/miniblog/</span></h2>

      <ul>
        <li>Maitrise d'oeuvre : Sébastien Sénéchal</li>
        <li>Maitre d'ouvrage : John Doe</li>
      </ul>

      <h2>Hébergement</h2>
      <h3>OVH</h3>
      <address>
        <p>Siège social<br />
        2 rue Kellermann<br />
        59100 Roubaix<br />
        France</p>
      </address>

      <p><a href="https://www.ovh.com/" title="Site de OVH" target="_blank">www.ovh.com</a></p>

      <h2>Contenus</h2>
      <p>Oeuvres originales, photos, vidéos, charte graphique, textes, etc. :<br />
      John Doe</p>


      <h2>Droits d'auteur</h2>

      <p>L’ensemble du site et chacun de ses éléments pris séparément relèvent de la législation française et internationale sur le droit d’auteur et plus largement de la propriété intellectuelle (incluant notamment la protection au titre du droit d’auteur, du droit des marques, du droit des bases de données, etc.).</p>

      <p>Tous les droits de reproduction, de représentation et de communication publique sont réservés, y compris pour les documents téléchargeables et représentations visuelles, audiovisuelles, photographiques, iconographies ou autres.</p>

      <p>Tout site public ou privé est autorisé à établir, sans autorisation préalable, un lien vers les informations diffusées sur sebastiensenechal.com.</p>

      <p>En revanche, les pages (ou images et autres éléments) ne doivent pas être imbriquées à l’intérieur des pages d’un autre site de quelque manière que ce soit.<br />
      La reproduction de tout ou partie de ce site sur un support électronique, quel qu’il soit, est formellement interdite sauf autorisation expresse de Sébastien Senechal.<br />
      Les marques citées sur le site sont déposées par les sociétés ou organismes qui en sont propriétaires. Leur reproduction ou utilisation, de quelque sorte, est interdite.<br />
      Les textes diffusés peuvent, par ailleurs, avoir fait, entre le moment où vous les avez téléchargés et celui où vous en prenez connaissance, l’objet de mises à jour. Nous ne garantissons par suite en aucune manière que ces informations sont exactes, complètes et à jour.<br />
      Sébastien Sénéchal ne saurait être tenue responsable d’éventuels dommages directs ou indirects pouvant découler de votre accès ou utilisation de ce site, ou d’un dommage ou virus qui pourrait affecter votre ordinateur ou autre matériel informatique. Plus généralement Sébastien Senechal n’assure aucune garantie, expresse ou tacite, concernant tout ou partie, du site.</p>

      <h2>Protection de vos données</h2>

      <p>Le site internet sebastiensenechal.com est conçu dans le respect des utilisateurs et de leurs données personnelles. Pour en savoir plus sur la politique de protection des données, rendez-vous sur la page dédiée au RGPD.</p>

    </article>

  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
