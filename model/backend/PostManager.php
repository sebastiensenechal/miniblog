<?php
namespace SebastienSenechal\Miniblog\Model\Backend; // La classe sera dans ce namespace

require_once('model/backend/Manager.php');


class PostManager extends Manager
{

  public function getPosts()
  {
    // Connexion à la base de données - $db est un objet PDO
    $db = $this->dbConnect();

    // Récupérer les billets sur la base de données
    $req = $db->query('SELECT id, title, content, excerpt, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    return $req;
  }


  public function getPost($id)
  {
    // Connexion à la base de données - $db est un objet PDO
    $db = $this->dbConnect();

    // Récupérer un post en fonction de son ID avec une requête préparé
    $req = $db->prepare('SELECT id, title, content, excerpt, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
    $req->execute(array($id));
    $post = $req->fetch();

    return $post;
  }



  public function createPost($author, $title, $content, $excerpt)
  {
    $db = $this->dbConnect();

    $content = str_replace('<script', '&lt;script', $content);
    $content = str_replace('</script', '&lt;/script', $content);
    $content = str_replace('<?', '&lt;?', $content);
    $content = str_replace('?>', '>&gt;', $content);

    $post = $db->prepare('INSERT INTO posts(author, title, content, excerpt, creation_date) VALUES(:author, :title, :content, :excerpt, NOW())');
    $createPost = $post->execute(array(
      'author' => $author,
    	'title' => $title,
    	'content' => $content,
      'excerpt' => $excerpt
    ));

    return $createPost;
  }



  public function updatePost($id_post, $author, $title, $content, $excerpt)
  {
    $db = $this->dbConnect();

    $post = $db->prepare('UPDATE posts SET author= :author, title= :title, content= :content, excerpt= :excerpt, creation_date= NOW() WHERE id= :id_post');
    $post->bindParam('id_post', $id_post, \PDO::PARAM_INT);
    $post->bindParam('title',$title, \PDO::PARAM_STR);
    $post->bindParam('author', $author, \PDO::PARAM_STR);
    $post->bindParam('content',$content, \PDO::PARAM_STR);
    $post->bindParam('excerpt', $excerpt, \PDO::PARAM_INT);
    $updatePost = $post->execute();

    return $updatePost;
  }



  public function getLastPost()
  {
      $db = $this->dbConnect();

      $req = $db->query('SELECT id, title, content, excerpt, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 3');

      return $req;
  }



  public function deletePost($id_post)
  {
    $db = $this->dbConnect();

    $post = $db->prepare('DELETE FROM posts WHERE id= ?');
    $deletePost = $post->execute(array($id_post));

    return $deletePost;
  }

}
