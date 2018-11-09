<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>AchèteUneLicorne | <?= $currentCat->nom ?></title>
    <link type="text/css" rel="stylesheet" href="../view/design/style.css?<? echo time(); ?>" media="all">
  </head>

  <body id="home">

    <?php include('../view/header.view.php') ?>

    <!-- Le nom de la catégorie en titre -->
    <h1 id="title-category"><?= $currentCat->nom ?></h1>

    <!-- Les différents produits de la catégorie -->
    <div id="products">
      <?php foreach ($shortProdList as $key => $value) { ?>
        <div class="products-item">
          <h2 class="products-item-name">
            <a href="../controler/produit.ctrl.php?prod=<?= $shortProdList[$key]->reference ?>"> <?= $shortProdList[$key]->intitule ?> </a>
          </h2>
          <a href="../controler/produit.ctrl.php?prod=<?= $shortProdList[$key]->reference ?>">
            <img src="../view/design/images_produits/<?= $shortProdList[$key]->image ?>" title="<?= $shortProdList[$key]->intitule ?>">
          </a>
          <h3 class="products-item-price"> <?= $shortProdList[$key]->prix ?> € </h3>
        </div>
      <?php } ?>
    </div>

    <!-- La liste de pages (si nécessaire) pour naviguer d'une page à une autre -->
    <?php if ($nbPages != 1) { ?>
      <div id="pages">
        <ul id="pages-list">
          <li class="pages-list-item">
            <?php if($numPage == 1) { ?>
              <a class="pages-arrows-disabled">&#171;</a>
            <?php } else { ?>
              <a class="pages-arrows-enabled" href="../controler/categorie.ctrl.php?cat=<?= $currentCat->numero ?>&p=<?= $numPage-1 ?>">&#171;</a>
            <?php } ?>
          </li>
          <?php for ($i=1; $i <= $nbPages; $i++) { ?>
            <li class="pages-list-item">
              <?php if($i != $numPage) { ?>
                <a class="pages-other_pages" href="../controler/categorie.ctrl.php?cat=<?= $currentCat->numero ?>&p=<?= $i ?>"><?= $i ?></a>
              <?php } else { ?>
                <a id="pages-current_page" disabled="disabled"><?= $i ?></a>
              <?php } ?>
            </li>
          <?php } ?>
          <li class="pages-list-item">
            <?php if($numPage == $nbPages) { ?>
              <a class="pages-arrows-disabled">&#187;</a>
            <?php } else { ?>
              <a class="pages-arrows-enabled" href="../controler/categorie.ctrl.php?cat=<?= $currentCat->numero ?>&p=<?= $numPage+1 ?>">&#187;</a>
            <?php } ?>
          </li>
        </ul>
      </div>
    <?php } ?>


    <?php include('../view/footer.view.php')  ?>

  </body>
</html>
