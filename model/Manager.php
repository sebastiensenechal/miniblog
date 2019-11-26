<?php
namespace SebastienSenechal\Miniblog\Model;

use \PDO;

abstract class Manager
{
  private $_db;

  const HOST = 'localhost'; // mysql51-95.perso
  const DB_NAME = 'miniblog'; // sebastiepsphpart
  const CHARSET = 'utf8';

  const DB_HOST = 'mysql:host='. self::HOST .';dbname=' . self::DB_NAME . ';charset=' . self::CHARSET;

  const DB_USER = 'root';
  const DB_PASS = 'root';


  public function getDb() {
    return $this->_db;
  }


  protected function dbConnect()
  {
    $this->_db = new PDO(
      self::DB_HOST,
      self::DB_USER,
      self::DB_PASS,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      
    return $this->_db;
  }
}
