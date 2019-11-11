<?php
namespace SebastienSenechal\Miniblog\Model;

use \SebastienSenechal\Miniblog\Model\Manager;
require_once('model/Manager.php');


class UserManager extends Manager
{
  public function getUser($pseudo)
  {
    // Instructions
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, pseudo, pass, role FROM members WHERE pseudo = ?');
    $req->execute(array($pseudo));
    $user = $req->fetch();

    return $user;
  }


  public function createUser($pseudo, $password_hash, $email)
  {
    // Instructions
    $db = $this->dbConnect();
    $req = $db->prepare('INSERT INTO members(pseudo, pass, email, subscription_date) VALUES(?, ?, ?, NOW())');
    $registerUser = $req->execute(array($pseudo, $password_hash, $email));

    return $registerUser;
  }

}
