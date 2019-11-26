<?php $title = 'John Doe | Inscription / Connexion' ?>

<?php ob_start(); ?>

<header id="header">
  <?php include('view/nav.php'); ?>

  <h1><a href="index.php?action=indexView" title="Accueil de John Doe">John Doe</a></h1>
  <h2>Identifiez-vous</h2>

  <?php include('view/navigation.php'); ?>

  <figure id="logo">
    <img src="././public/img/logo-gris.svg" alt="">
    <figcaption>
      <p>John Doe © Sébastien Sénéchal</p>
    </figcaption>
  </figure>
</header>

<main id="layout-connexion">
  <section>
    <header>
      <h2>Vous avez un compte</h2>
    </header>

    <form action="index.php?action=connect" method="post">
      <fieldset>
        <label for="pseudo" class="hidden"><abbr title="Champs obligatoire">*</abbr> Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" placeholder="* Votre pseudo" required />
      </fieldset>
      <fieldset>
        <label for="pass" class="hidden"><abbr title="Champs obligatoire">*</abbr> Mot de passe</label>
        <input type="password" id="pass" name="pass" placeholder="* Mot de passe" required />
      </fieldset>
      <fieldset>
        <input type="submit" name="connect" value="Envoyer" />
        <!-- Champs caché pour Token CSRF -->
        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
      </fieldset>
    </form>

  </section>

  <section>
    <header>
      <h2>Vous inscrire</h2>
    </header>

    <form action="index.php?action=subscription" method="post">
      <fieldset>
        <label for="pseudo" class="hidden"><abbr title="Champs obligatoire">*</abbr> Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" placeholder="* Votre pseudo" required />
      </fieldset>
      <fieldset>
        <label for="email" class="hidden"><abbr title="Champs obligatoire">*</abbr> Email</label>
        <input type="email" id="email" name="email" placeholder="* Email : email@domain.com" required />
      </fieldset>
      <fieldset>
        <label for="pass" class="hidden"><abbr title="Champs obligatoire">*</abbr> Mot de passe</label>
        <input type="password" id="pass" name="pass" placeholder="* Mot de passe" required />
      </fieldset>
      <fieldset>
        <label for="pass_confirm" class="hidden"><abbr title="Champs obligatoire">*</abbr> Confirmez le mot de passe</label>
        <input type="password" id="pass_confirm" name="pass_confirm" placeholder="* Confirmez votre mot de passe" required />
      </fieldset>
      <fieldset>
        <label for="agreement">
          <abbr title="Champs obligatoire">*</abbr> J'accepte le traitement de mes données conformément à la politique de données personnelles.
          <input type="checkbox" name="agreement" value="true" id="agreement" required />
        </label>
      </fieldset>
      <fieldset>
        <?php
          if (isset($_COOKIE['message_subscription'])) {
            echo '<p class="validate">' . htmlspecialchars($_COOKIE['message_subscription']) . '</p>';
          }
        ?>
        <input type="submit" name="subscription" value="Envoyer" />
      </fieldset>
    </form>

  </section>
</main>

<?php $content = ob_get_clean() ?>

<?php require('./view/template.php') ?>
