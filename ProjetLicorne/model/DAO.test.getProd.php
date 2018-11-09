<?php

// Test de la classe DAO
require_once('DAO.class.php');

// Recupère un produit de manière aléatoire
$prod = $dao->getProd(rand(1,50));

// Affiche la référence et le nom de ce produit
print("Ref : ".$prod->reference." - Nom : ".$prod->intitule."\n");

 ?>
