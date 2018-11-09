<?php

// Tests des classe DAO et Panier
require_once('DAO.class.php');
require_once('Panier.class.php');

// Récupération de trois produits
$prod1 = $dao->getProd(5);
$prod2 = $dao->getProd(12);
$prod3 = $dao->getProd(25);


// Ajout des produits au panier
$panier->addProd($prod1);
$panier->addProd($prod1);
$panier->addProd($prod3);

// Recupère le panier
$cart = $panier->getCart();

// Affiche le panier (Doit contenir deux Licornes Fantasy et une Bague Revelation)
var_dump($cart);

 ?>
