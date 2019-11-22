<div id="comment-form">

  <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <fieldset>
      <label for="author">Auteur</label><br />
      <input type="text" id="author" name="author" value="<?php
        if (isset($_SESSION['pseudo']))
        {
            echo htmlspecialchars($_SESSION['pseudo']);
        }
        ?>" readonly="readonly" />
    </fieldset>
    <fieldset>
      <label for="comment"><abbr title="Champs obligatoire">*</abbr> Commentaire</label><br />
      <textarea id="comment" name="comment"></textarea>
    </fieldset>
    <fieldset>
      <?php
        if (isset($_COOKIE['message'])) {
          echo '<p class="validate">' . $_COOKIE['message'] . '</p>';
        } elseif (empty($_COOKIE['message'])) {
          echo '<p>Les commentaires sont soumis à validation</p>';
        }
      ?>
      <input type="submit" />
    </fieldset>
  </form>

</div>
