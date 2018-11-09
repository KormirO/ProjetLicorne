<?php

require_once("../model/Categorie.class.php");
require_once("../model/Produit.class.php");
require_once("../model/DAO.class.php");

// Creation du panier
$panier = new Panier();

// Le panier virtuel
class Panier {
  // Constructeur chargé de créer le panier
  function __construct() {
    if(!isset($_SESSION['panier'])) {
      $_SESSION['panier']=array();
      $_SESSION['panier']['nomProd'] = array();
      $_SESSION['panier']['qteProd'] = array();
      $_SESSION['panier']['prixProd'] = array();
    }
  }

  // Accès au panier
  function getCart() : array {
    return $_SESSION['panier'];
  }

  // Accès aux noms des produits contenus dans le panier
  function getNomsProd() : array {
    return $_SESSION['panier']['nomProd'];
  }

  // Accès aux quantités des produits contenus dans le panier
  function getQtesProd() : array {
    return $_SESSION['panier']['qteProd'];
  }

  // Accès aux prix des produits contenus dans le panier
  function getPrixProd() : array {
    return $_SESSION['panier']['prixProd'];
  }

  // Ajout d'un produit dans le panier
  function addProd(Produit $prod) {
    if(isset($_SESSION['panier'])) {
      $prodExists = in_array($prod->intitule, $_SESSION['panier']['nomProd']);
      $prodPosition = array_search($prod->intitule, $_SESSION['panier']['nomProd']);

      if ($prodExists) {
        $_SESSION['panier']['qteProd'][$prodPosition] += 1;
      }
      else {
        array_push($_SESSION['panier']['nomProd'], $prod->intitule);
        array_push($_SESSION['panier']['qteProd'], 1);
        array_push($_SESSION['panier']['prixProd'], $prod->prix);
      }
    }
  }

  // Suppression d'un produit dans le panier
  function delProd(string $intitule) {
    if(isset($_SESSION['panier'])) {
      // Passage par un tableau temporaire pour recréer un panier sans le produit que l'on supprime
      $tmpTab=array();
      $tmpTab['nomProd'] = array();
      $tmpTab['qteProd'] = array();
      $tmpTab['prixProd'] = array();
      for($i = 0; $i < count($_SESSION['panier']['nomProd']); $i++) {
        if ($_SESSION['panier']['nomProd'][$i] !== $intitule) {
          array_push($tmpTab['nomProd'],$_SESSION['panier']['nomProd'][$i]);
          array_push($tmpTab['qteProd'],$_SESSION['panier']['qteProd'][$i]);
          array_push($tmpTab['prixProd'],$_SESSION['panier']['prixProd'][$i]);
        }
      }
      // Remplacement du panier de la session par le nouveau panier
      $_SESSION['panier'] = $tmpTab;
      // Suppression du tableau temporaire
      unset($tmpTab);
    }
  }

  // Retourne le combre d'articles contenus dans le panier
  function getNbProdCart() : int {
    return count($_SESSION['panier']['nomProd']);
  }

  // Retourne le prix total du panier
  function getTotalPrice() : float {
    $total = 0;
    for ($i=0; $i < $this->getNbProdCart() ; $i++) {
      $total += $_SESSION['panier']['qteProd'][$i] * $_SESSION['panier']['prixProd'][$i];
    }
    return $total;
  }

}

?>
