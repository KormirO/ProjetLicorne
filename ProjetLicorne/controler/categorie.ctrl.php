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

  // Si la variable "cat" n'est pas définie, si elle n'est pas comprise entre 2 et le nombre de catégories ou si elle n'est pas de type numeric
  // Alors on affiche la vue "accueil.view.php"
  if(!isset($_GET['cat']) || $_GET['cat'] < 2 || $_GET['cat'] > $dao->getNbCat() || !(is_numeric($_GET['cat']))) {
    // Création d'une table d'objets de la classe Produit qui correspondent aux best sellers
    $bestSellers = array($dao->getProd(4), $dao->getProd(9), $dao->getProd(25), $dao->getProd(32), $dao->getProd(44), $dao->getProd(49));
    include('../view/accueil.view.php');
  }
  // Sinon, on affiche la vue "categorie.view.php"
  else {
    // Récupération de la catégorie sélectionnée
    $currentCat = $dao->getCat($_GET['cat']);
    // Récupération de tous les produits de la catégorie sélectionnée
    $prodList = $dao->getAllProdCat($currentCat);
    // Etablissement du nombre de produits affichés par page
    $nbProdPage = 6;
    // Récupération du nombre de pages maximum
    $nbPages = $dao->getNbPages($nbProdPage, $prodList);
    // Si la variable "p" n'est pas définie ou inférieur à 1
    // Alors on définit le numéro de page sur 1
    if (!isset($_GET['p']) || $_GET['p'] <= 0) {
      $numPage = 1;
    }
    // Si la variable "p" est supérieur au nombre de pages maximum
    // Alors on définit le numéro de page au nombre de pages maximum
    else if($_GET['p'] > $nbPages) {
      $numPage = $nbPages;
    }
    // Sinon, on récupère le numéro de page
    else {
      $numPage = $_GET['p'];
    }
    // Recupère, au maximum, $nbelem produits de la catégorie $cat à partir d'une certaine référence
    $shortProdList = $dao->getNProdCat($prodList[($numPage-1)*$nbProdPage]->reference, $nbProdPage, $currentCat);
    include('../view/categorie.view.php');
  }

  ?>
