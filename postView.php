<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini blog</title>
       <link href="style.css" rel="stylesheet" />
    </head>

    <body>
      <div id="grid">
        <header>
          <h1>Mini blog</h1>
          <p><a href="index.php" title="Index des billets">Retour à la liste des billets</a></p>
        </header>

        <div id="layout-post">
          <section id="content-news">

            <article class="news">
                <h3>
                    <?= htmlspecialchars($post['title']) ?>
                    <em>le <?= $post['creation_date_fr'] ?></em>
                </h3>

                <p>
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </p>
            </article>


            <h2>Commentaires</h2>

            <?php
            while ($comment = $comments->fetch())
            {
            ?>
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <?php
            }
            ?>

          </section>
        </div>

      </div>
    </body>
</html>
