<?php
namespace SebastienSenechal\Miniblog\Model;

use \SebastienSenechal\Miniblog\Model\Manager;
$manager = "Manager";
require_once $manager . '.php';


class PostManager extends Manager
{
  public function getPosts()
  {
    $db = $this->dbConnect();

    $posts = $db->prepare('SELECT id, title, content, excerpt, DATE_FORMAT(creation_date, \'%d.%m.%Y\') AS creation_date_fr FROM oc_posts ORDER BY creation_date DESC');
    $posts->execute();

    return $posts;
  }


  public function getPost($id)
  {
    $db = $this->dbConnect();

    $req = $db->prepare('SELECT id, title, content, excerpt, DATE_FORMAT(creation_date, \'%d.%m.%Y à %Hh%i\') AS creation_date_fr FROM oc_posts WHERE id = ?');
    $req->execute(array($id));
    $post = $req->fetch();

    return $post;
  }



  public function createPost($author, $title, $content, $excerpt)
  {
    $db = $this->dbConnect();

    $db->quote($content);
    $db->quote($excerpt);

    $post = $db->prepare('INSERT INTO oc_posts(author, title, content, excerpt, creation_date) VALUES(:author, :title, :content, :excerpt, NOW())');
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

    $db->quote($content);
    $db->quote($excerpt);

    $post = $db->prepare('UPDATE oc_posts SET author= :author, title= :title, content= :content, excerpt= :excerpt, creation_date= NOW() WHERE id= :id_post');
    $updatePost = $post->execute(array(
      'id_post' => $id_post,
    	'title' => $title,
      'author' => $author,
    	'content' => $content,
      'excerpt' => $excerpt
    ));

    return $updatePost;
  }



  public function getLastPost()
  {
    $db = $this->dbConnect();

    $posts = $db->prepare('SELECT id, title, content, excerpt, DATE_FORMAT(creation_date, \'%d.%m.%Y\') AS creation_date_fr FROM oc_posts ORDER BY creation_date DESC LIMIT 0, 3');
    $posts->execute();

    return $posts;
  }



  public function deletePost($id_post)
  {
    $db = $this->dbConnect();

    $post = $db->prepare('DELETE FROM oc_posts WHERE id= ?');
    $deletePost = $post->execute(array($id_post));

    return $deletePost;
  }

}
