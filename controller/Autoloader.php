<?php
namespace SebastienSenechal\Miniblog; // La classe sera dans ce namespace

class Autoloader {

	static function register()
  {
		// appel fonction autoload de la class Autoloader sous forme d'array
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	static function autoload($class)
  {
		if (strpos($class, __NAMESPACE__ . '\\') == 0) {
			// remplace le chemin du namespace par une string vide pour accéder aux class
			$class = str_replace(__NAMESPACE__ . '\\', '', $class);
			require $class . '.php';
		}
	}

}
