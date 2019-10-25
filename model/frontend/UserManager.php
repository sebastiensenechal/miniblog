<?php
namespace SebastienSenechal\Miniblog\Model\Frontend;


require_once('model/frontend/Manager.php');


class UserManager extends Manager
{
  public function getUser($pseudo)
  {
    // Instructions
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, pseudo, pass FROM members WHERE pseudo = ?');
    $req->execute(array($pseudo));
    $user = $req->fetch();

    return $user;
  }



  public function createUser($pseudo, $password_hash, $email)
  {
    // Instructions
    $db = $this->dbConnect();
    $req = $db->prepare('INSERT INTO members(pseudo, pass, email, subscription_date) VALUES(?, ?, ?, ?, NOW())');
    $registerUser = $req->execute(array($pseudo, $password_hash, $email));

    return $registerUser;
  }



  // public function updateUser($id, $pseudo, $email, $password_hash)
  // {
  //   // Instructions
  //   $db = $this->dbConnect();
  // }
  //
  //
  //
  // public function deleteUser()
  // {
  //   // Instructions
  //   $db = $this->dbConnect();
  // }
}
