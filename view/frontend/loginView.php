<?php $title = 'John Do | Inscription / Connexion' ?>

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

  <figure id="logo">
    <img src="././public/img/logo-gris.svg" alt="">
    <figcaption>
      <h1>Page de connexion</h1>
    </figcaption>
  </figure>
</header>

<div id="layout-connexion">
  <section>
    <header>
      <h2>Formulaire de connexion</h2>
    </header>

    <form action="index.php?action=connect" method="post">
      <fieldset>
        <label for="pseudo"><abbr title="Champs obligatoire">*</abbr> Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" />
      </fieldset>
      <fieldset>
        <label for="pass"><abbr title="Champs obligatoire">*</abbr> Mot de passe</label><br>
        <input type="password" id="pass" name="pass" />
      </fieldset>
      <fieldset>
        <input type="submit" name="connect" />
        <!-- Champs caché pour Token CSRF -->
        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
      </fieldset>
    </form>

  </section>

  <section>
    <header>
      <h2>Formulaire d'inscription</h2>
    </header>

    <form action="index.php?action=subscription" method="post">
      <fieldset>
        <label for="pseudo"><abbr title="Champs obligatoire">*</abbr> Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" required />
      </fieldset>
      <fieldset>
        <label for="email"><abbr title="Champs obligatoire">*</abbr> Email</label><br>
        <input type="email" id="email" name="email" placeholder="email@domain.com" required />
      </fieldset>
      <fieldset>
        <label for="pass"><abbr title="Champs obligatoire">*</abbr> Mot de passe</label><br>
        <input type="password" id="pass" name="pass" required />
      </fieldset>
      <fieldset>
        <label for="pass_confirm"><abbr title="Champs obligatoire">*</abbr> Confirmez le mot de passe</label><br>
        <input type="password" id="pass_confirm" name="pass_confirm" required />
      </fieldset>
      <fieldset>
        <label for="agreement">
          <abbr title="Champs obligatoire">*</abbr> J'accepte le traitement de mes données conformément à notre politique de données personnelles.
          <input type="checkbox" name="agreement" value="true" id="agreement" required />
        </label>
      </fieldset>
      <fieldset>
        <input type="submit" name="subscription" />
      </fieldset>
    </form>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('template.php') ?>
