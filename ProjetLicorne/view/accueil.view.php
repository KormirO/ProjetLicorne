<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>AchèteUneLicorne</title>
    <link type="text/css" rel="stylesheet" href="../view/design/style.css?<? echo time(); ?>" media="all">
  </head>

  <body id="home">

    <?php include('../view/header.view.php') ?>

    <!-- Un titre d'accueil / de bienvenue  -->
    <h1 id="title">Bienvenue jeune licorne !</h1>

    <!-- Un titre annonçant l'affichage des best sellers  -->
    <h2 id="best_sellers-title">Best Sellers</h2>

    <!-- Les best sellers du site -->
    <div id="products">
      <?php foreach ($bestSellers as $key => $value) { ?>
        <div class="products-item">
          <h2 class="products-item-name">
            <a href="produit.ctrl.php?prod=<?= $bestSellers[$key]->reference ?>"> <?= $bestSellers[$key]->intitule ?> </a>
          </h2>
          <a href="produit.ctrl.php?prod=<?= $bestSellers[$key]->reference ?>">
             <img src="../view/design/images_produits/<?= $bestSellers[$key]->image ?>" title="<?= $bestSellers[$key]->intitule ?>">
          </a>
          <h3 class="products-item-price"> <?= $bestSellers[$key]->prix ?> € </h3>
        </div>
      <?php } ?>
    </div>

    <?php include('../view/footer.view.php') ?>

  </body>
</html>
