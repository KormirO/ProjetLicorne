<?php

// Test de la classe DAO
require_once('DAO.class.php');

// Recupère le nombre de catégories existantes
$cat = $dao->getNbCat();

// Affiche le nombre de catégories existantes (ici 16)
print("Nombre de catégories : ".$cat."\n");

 ?>
