<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= $catProd->nom ?> | <?= $prod->intitule ?></title>
  <link type="text/css" rel="stylesheet" href="../view/design/style.css?<? echo time(); ?>" media="all">
</head>

<body id="home">

  <?php include('../view/header.view.php') ?>

  <!-- Le nom de la catégorie en titre -->
  <h1 id="title-product"><?= $catProd->nom ?> : <?= $prod->intitule ?></h1>

  <!-- Le produit en question -->
  <div id="product">

    <!-- L'image du produit en question -->
    <div id="product-image">
      <img src="../view/design/images_produits/<?= $prod->image ?>" title="<?= $prod->intitule ?>">
    </div>

    <!-- Les détails du produit en question -->
    <div id="product-details">
      <h2 id="product-details-name"><?= $prod->intitule ?></h2>
      <h3 id="product-details-price"><?= $prod->prix ?> €</h3>
      <form id="add-cart" action="../controler/panier.ctrl.php" method="post">
        <button id="product-add_cart" type="submit" title="Ajouter au panier" onclick="<?php $panier->addProd($prod) ?>">
          <span id="product-add_cart-text">Ajouter au panier</span>
        </form>
      </button>
      <p id="product-details-description"><?= $prod->informations ?>.</p>
      <hr>
      <p id="product-details-TVA">Le prix indiqué inclut la TVA.</p>
    </div>

  </div>
  <?php include('../view/footer.view.php')  ?>

</body>
</html>
