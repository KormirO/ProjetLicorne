<?php

require_once("../model/Categorie.class.php");
require_once("../model/Produit.class.php");

// Creation de l'unique objet DAO
$dao = new DAO();

// Le Data Access Object
// Il représente la base de donnée
class DAO {
  // L'objet local PDO de la base de donnée
  private $db;
  // Le type, le chemin et le nom de la base de donnée
  private $database = 'sqlite:../data/licorne.db';

  // Constructeur chargé d'ouvrir la BD
  function __construct() {
    try {
      $this->db = new PDO($this->database);
    }
    catch (PDOException $e){
      die("erreur de connexion:".$e->getMessage());
    }
  }


  // Accès à toutes les catégories principales sauf "Produit"
  // Retourne une table d'objets de type Categorie
  function getAllMainCat() : array {
    $sql = "SELECT * FROM categorie WHERE parent = 1 LIMIT (SELECT count(*)-1 FROM categorie WHERE parent = 1) OFFSET 1";
    $sth = $this->db->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Categorie');
    return $result;
  }

  // Accès à toutes les sous-catégories d'une catégorie dont on connait l'id
  // Retourne une table d'objets de type Categorie
  function getSubCat(int $id) : array {
    $sql = "SELECT * FROM categorie WHERE parent=$id";
    $sth = $this->db->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Categorie');
    return $result;
  }

  // Accès à toutes les sous-catégories de toutes les catégories
  // Retourne une table de tables d'objets de type Categorie
  function getAllSubCat(array $mainCat) : array {
    $subCat = array();
    foreach ($mainCat as $key => $value) {
      $cat = $this->getSubCat($value->numero);
      array_push($subCat, $cat);
    }
    return $subCat;
  }

  // Retourne le nombre de catégories existantes
  function getNbCat() : int {
    $sql = "SELECT count(*) AS nbCateg FROM categorie";
    $sth = $this->db->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_CLASS);
    return $result[0]->nbCateg;
  }

  // Acces à une catégorie
  // Retourne un objet de la classe Categorie connaissant son identifiant
  function getCat(int $id): Categorie {
    $sql = "SELECT * FROM categorie WHERE numero = $id";
    $sth = $this->db->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Categorie');
    return $result[0];
  }

  // Accès à un produit connaissant sa référence
  // Retourne un objet de la classe Produit
  function getProd(int $ref) : Produit {
    $sql = "SELECT * FROM produit WHERE reference = $ref";
    $sth = $this->db->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Produit');
    return $result[0];
  }

  // Retourne le nombre de produits existantes
  function getNbProd() : int {
    $sql = "SELECT count(*) AS nbProd FROM produit";
    $sth = $this->db->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_CLASS);
    return $result[0]->nbProd;
  }

  // Accès à tous les produits d'une catégories
  // Retourne une table d'objets de la classe Produit
  function getAllProdCat(Categorie $cat) : array {
    $sql = "SELECT * FROM produit WHERE categorie IN (SELECT numero FROM categorie WHERE numero = $cat->numero OR parent = $cat->numero)";
    $sth = $this->db->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Produit');
    return $result;
  }

  // Accès aux n produits à partir d'une référence ref
  // Retourne une table d'objets de la classe Produit
  function getNProdCat(int $ref, int $n, Categorie $cat) : array {
    $sql = "SELECT * FROM produit WHERE reference >= $ref AND categorie IN (SELECT numero FROM categorie WHERE numero = $cat->numero OR parent = $cat->numero) LIMIT $n";
    $sth = $this->db->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Produit');
    return $result;
  }

  // Accès à tous les produits en lien avec le terme de la recherche
  // Retourne une table d'ojets de la classe Produit
  function getAllProdSearch(string $search) : array {
    $sql = "SELECT * FROM produit WHERE intitule LIKE '%$search%' OR informations LIKE '%$search%'";
    $sth = $this->db->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Produit');
    return $result;
  }

  // Accès aux n produits à partir d'un indice i de searchResults
  // Retourne une table d'ojets de la classe Produit
  function getNProdSearch(int $i, int $n, array $searchResults) : array {
    $nSearchResults = array();
    $iInitial = $i;
    for ($i ; $i < $n+$iInitial ; $i++) {
      if (isset($searchResults[$i])) {
        $prod = $this->getProd($searchResults[$i]->reference);
        array_push($nSearchResults, $prod);
      }
    }
    return $nSearchResults;
  }

  // Retourne le nombre de pages maximum que pourra générer une catégorie ou une recherche
  // Dépendra du nombre d'éléments par page (à savoir $n)
  function getNbPages(int $n, array $prodList) : int {
    $nbElem = count($prodList);
    return (int)(ceil($nbElem / $n));
  }

}

?>
