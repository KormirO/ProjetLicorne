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

  // Création d'une table d'objets de la classe Produit qui correspondent aux best sellers
  $bestSellers = array($dao->getProd(4), $dao->getProd(9), $dao->getProd(25), $dao->getProd(32), $dao->getProd(44), $dao->getProd(49));

  include('../view/accueil.view.php');

  ?>
