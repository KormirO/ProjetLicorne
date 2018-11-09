<?php

  session_start();

  require_once('../model/Categorie.class.php');
  require_once('../model/Produit.class.php');
  require_once('../model/DAO.class.php');
  require_once('../model/Panier.class.php');

  // Récupération des catégories principales pour le header
  $mainCat = $dao->getAllMainCat();

  // Récupération des catégories secondaires pour le header
  $subCat = $dao->getAllSubCat($mainCat);

  // Si la variable "prod" n'est pas définie, si elle n'est pas comprise entre 0 et le nombre de catégories ou si elle n'est pas de type numeric
  // Alors on affiche la vue "accueil.view.php"
  if(!isset($_GET['prod']) || $_GET['prod'] <= 0 || $_GET['prod'] > $dao->getNbProd() || !(is_numeric($_GET['prod']))) {
    // Création d'une table d'objets de la classe Produit qui correspondent aux best sellers
    $bestSellers = array($dao->getProd(4), $dao->getProd(9), $dao->getProd(25), $dao->getProd(32), $dao->getProd(44), $dao->getProd(49));
    include('../view/accueil.view.php');
  }
  // Sinon, on affiche la vue "produit.view.php"
  else {
    // Récupération du produit sélectionné
    $prod = $dao->getProd($_GET['prod']);
    // Récupération de la catégorie associée au produit
    $catProd = $dao->getCat($prod->categorie);
    include('../view/produit.view.php');
  }

 ?>
