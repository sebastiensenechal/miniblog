<?php $title = 'John Doe | Contact' ?>

<?php ob_start(); ?>

<header id="header">
  <?php include('view/nav.php'); ?>

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>

  <?php include('view/navigation.php'); ?>

  <figure id="logo">
    <img src="././public/img/logo-gris.svg" alt="">
    <figcaption>
      <p>John Doe © Sébastien Sénéchal</p>
    </figcaption>
  </figure>
</header>

<main id="layout">

  <section id="content">
    <header>
      <h2>Contactez-nous</h2>
    </header>

    <article>
      <form action="index.php?action=contact" method="post">
        <fieldset>
          <label for="firstname" class="hidden"><abbr title="Champs obligatoire">*</abbr> Prénom</label>
          <input type="text" id="firstname" name="firstname" placeholder="* Votre prénom" required />
        </fieldset>
        <fieldset>
          <label for="lastname" class="hidden"><abbr title="Champs obligatoire">*</abbr> Nom</label>
          <input type="text" id="lastname" name="lastname" placeholder="* Votre nom" required />
        </fieldset>
        <fieldset>
          <label for="email" class="hidden"><abbr title="Champs obligatoire">*</abbr> Email</label>
          <input type="email" id="email" name="email" placeholder="* Email : email@domain.com" required />
        </fieldset>
        <fieldset>
          <label for="message" class="hidden"><abbr title="Champs obligatoire">*</abbr> Votre message</label><br />
          <textarea id="message" name="message"></textarea>
        </fieldset>
        <fieldset>
          <label for="agreement">
            <abbr title="Champs obligatoire">*</abbr> J'accepte le traitement de mes données conformément à la politique de <a href="index.php?action=rgpd" title="Page du RGPD">données personnelles</a>.
            <input type="checkbox" name="agreement" value="true" id="agreement" required />
          </label>
        </fieldset>
        <fieldset>
          <input type="submit" name="contact" value="Envoyer" />
        </fieldset>
      </form>
    </article>
  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
