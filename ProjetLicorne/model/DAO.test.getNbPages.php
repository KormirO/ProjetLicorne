<?php

// Test de la classe DAO
require_once('DAO.class.php');

// Recupère une catégorie
$cat = $dao->getCat(7);

// Récupère le nombre maximum de pages que pourra générer cette catégories
$nbProdPage = 6;
$nbPages = $dao->getNbPages($nbProdPage, $cat);

// Affiche le nombre de pages correspondant (ici 1)
print("Nombre de pages (cas 1) : ".$nbPages." --------- ");


// Recupère une catégorie
$cat = $dao->getCat(2);

// Récupère le nombre maximum de pages que pourra générer cette catégories
$nbProdPage = 6;
$nbPages = $dao->getNbPages($nbProdPage, $cat);

// Affiche le nombre de pages correspondant (ici 3)
print("Nombre de pages (cas 2) : ".$nbPages."\n");

 ?>
