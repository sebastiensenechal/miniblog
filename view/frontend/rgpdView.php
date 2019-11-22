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
      <h1>
          Réglement général pour la protection des données (RGPD)<br />
          <span>Novembre 2019</span>
      </h1>
    </header>

    <article class="news">

      <p><strong>Je vous informe que vos données peuvent faire l’objet d’un traitement, notamment dans le cadre du suivi de fréquentation. Lorsque certaines informations sont obligatoires pour accéder à des fonctionnalités spécifiques, ce caractère obligatoire est indiqué au moment de la collecte de la saisie des données.<br />
      On ne collecte que le strict minimum et les adresses IP sont cryptées et anonymisées par Google Analytics.</strong></p>

      <h2>Données enregistrées</h2>
      <p>Des données à caractère personnel sont susceptibles d’être collectées par John Doe.</p>

      <p>Des données à caractère personnel :</p>
      <ul>
        <li>Nom</li>
        <li>Prénom</li>
        <li>Adresse e-mail</li>
      </ul>

      <h2>Durée de conservation des données</h2>

      <p>Elles sont conservées pour une durée de :</p>
      <ul>
        <li>Au maximum 3 ans, conformément au droit à l'oubli</li>
      </ul>

      <h2>Droit des personnes</h2>

      <p>Conformément aux dispositions légales et règlementaires applicables, en particulier la loi n° 78-17 du 6 janvier modifiée relative à l’informatique, aux fichiers et aux libertés et le règlement européen n° 2016/679/UE du 27 avril 2016 (applicable depuis le 25 mai 2018), vous disposez des droits suivants :</p>
      <ul>
        <li>Exercer votre droit d’accès, pour connaître les données personnelles qui vous concernent ;</li>
        <li>Demander la mise à jour de vos données, si elles sont inexactes ;</li>
        <li>Demander la portabilité ou la suppression de vos données ;</li>
        <li>Vous opposer, pour des motifs légitimes, au traitement de vos données ;</li>
        <li>Retirer votre consentement au traitement de vos données.</li>
    </ul>

    <h2>Pour exercer ces droits</h2>
    <p>Adressez-vous directement à John Doe</p>

    <h2>Droit d'introduire une réclamation</h2>
    <p>Si vous estimez, après nous avoir contactés, que vos droits Informatique et Libertés ne sont pas respectés, vous avez la possibilité d’introduire une réclamation en ligne auprès de la CNIL ou par courrier postal.</p>

    </article>

  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
