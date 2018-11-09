<?php

// Test de la classe DAO
require_once('DAO.class.php');

// Recupère une catégorie
$cat = $dao->getCat(7);

// Récupère tous les produits étant dans la catégorie $cat
$prodList = $dao->getAllProdCat($cat);

// Recupère, au maximum, 4 produits de la catégorie $cat
$shortProdList = $dao->getNProdCat($prodList[0]->reference, 4, $cat);

// Affiche, au maximum, les 4 premiers produits de la catégorie $cat (ici 3 produits)
var_dump($shortProdList);

 ?>
