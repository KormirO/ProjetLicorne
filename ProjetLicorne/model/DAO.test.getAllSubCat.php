<?php

// Test de la classe DAO
require_once('DAO.class.php');

// Recupère toutes les catégories principales
$mainCat = $dao->getAllMainCat();

// Création d'un tableau de tableaux
$subCat = $dao->getAllSubCat($mainCat);

// Affiche toutes les sous-catégories pour chaque catégorie
var_dump($subCat);

 ?>
