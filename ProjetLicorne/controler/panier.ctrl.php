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

  // Si le panier n'a pas été créé lors de la session
  // Alors on affiche la vue "accueil.view.php"
  if(!isset($_SESSION['panier'])) {
    // Création d'une table d'objets de la classe Produit qui correspondent aux best sellers
    $bestSellers = array($dao->getProd(4), $dao->getProd(9), $dao->getProd(25), $dao->getProd(32), $dao->getProd(44), $dao->getProd(49));
    include('../view/accueil.view.php');
  }
  // Sinon, on affiche la vue "panier.view.php"
  else {
    // Récupération du panier
    $cart = $panier->getCart();
    // Récupération du nombre de produits différents dans la panier
    $nbProdCart = $panier->getNbProdCart();
    // Récupération des noms des produits du panier
    $listNomsProd = $panier->getNomsProd();
    // Récupération des quantités des produits du panier
    $listQtesProd = $panier->getQtesProd();
    // Récupération des prix des produits du panier
    $listPrixProd = $panier->getPrixProd();
    // Récupération du prix TOTAL
    $totalPrice = $panier->getTotalPrice();
    include('../view/panier.view.php');
  }

 ?>
