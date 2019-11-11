<?php
namespace SebastienSenechal\Miniblog\Model;
// Ajout de la classe Manager dans le namespace \SebastienSenechal\Miniblog\Model\

class Manager
{
  protected function dbConnect()
  {
    $db = new \PDO('mysql:host=localhost;dbname=miniblog;charset=utf8', 'root', 'root'); // Ajout d'un "\" devant PDO car il se trouve à la racine du namespace global
    return $db;
  }
}
