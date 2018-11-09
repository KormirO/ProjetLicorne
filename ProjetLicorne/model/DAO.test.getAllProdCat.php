<?php

// Test de la classe DAO
require_once('DAO.class.php');

// Recupère une catégorie
$cat = $dao->getCat(3);

// Récupère tous les produits étant dans la catégorie $cat
$prodList = $dao->getAllProdCat($cat);

// Affiche tous ces produits
var_dump($prodList);

 ?>
