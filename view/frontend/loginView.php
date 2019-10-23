<?php $title = 'John Do | Inscription / Connexion' ?>

<?php ob_start(); ?>

<header id="header">
  <h1>Page de connexion</h1>
  <p><a href="./index.php" title="Index des billets">Retour à l'accueil</a></p>
</header>

<div id="layout-connexion">
  <section>
    <header>
      <h2>Formulaire de connexion</h2>
    </header>

    <form action="index.php?action=connect" method="post">
      <fieldset>
        <label for="pseudo">* Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" />
      </fieldset>
      <fieldset>
        <label for="pass">* Mot de passe</label><br>
        <input type="password" id="pass" name="pass"></textarea>
      </fieldset>
      <fieldset>
        <input type="submit" name="connect" />
      </fieldset>
    </form>

  </section>

  <section>
    <header>
      <h2>Formulaire d'insciption</h2>
    </header>

    <form action="index.php?action=subscription" method="post">
      <fieldset>
        <label for="pseudo">* Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" />
      </fieldset>
      <fieldset>
        <label for="email">* Email</label><br>
        <input type="email" id="email" name="email" placeholder="Votre adresse courriel" />
      </fieldset>
      <fieldset>
        <label for="pass">* Mot de passe</label><br>
        <input type="password" id="pass" name="pass"></textarea>
      </fieldset>
      <fieldset>
        <label for="pass_confirm">* Confirmez le mot de passe</label><br>
        <input type="password" id="pass_confirm" name="pass_confirm"></textarea>
      </fieldset>
      <fieldset>
        <input type="submit" name="subscription" />
      </fieldset>
    </form>

  </section>
</div>

<?php $content = ob_get_clean() ?>

<?php require('view/template.php') ?>
