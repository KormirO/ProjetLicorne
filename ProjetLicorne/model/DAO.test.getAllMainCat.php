<?php

// Test de la classe DAO
require_once('DAO.class.php');

// Recupère toutes les catégories principales
$mainCat = $dao->getAllMainCat();

// Affiche toutes les catégories principales
var_dump($mainCat);

 ?>
