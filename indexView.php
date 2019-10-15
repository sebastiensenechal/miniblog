<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini blog</title>
       <link href="style.css" rel="stylesheet" />
    </head>

    <body>
      <div id="grid">
        <h1>Mini blog</h1>
        <h2>Derniers billets</h2>

        <?php
        while ($data = $posts->fetch())
        {
        ?>
            <div class="news">
                <h3>
                    <?= htmlspecialchars($data['title']) ?>
                    <em>le <?= $data['creation_date_fr'] ?></em>
                </h3>

                <p>
                    <?= nl2br(htmlspecialchars($data['content'])) ?>
                    <br />
                    <em><a href="post.php?id=<?= $data['id'] ?>">Commentaires</a></em>
                </p>
            </div>
        <?php
        }
        $posts->closeCursor();
        ?>

      </div>
    </body>
</html>
