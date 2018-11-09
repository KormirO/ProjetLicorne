<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <header id="header">

      <a id="logo-link" href="../controler/accueil.ctrl.php">
        <img id="logo-img" src="../view/design/Logo.jpg">
      </a>

      <div id="navigation">

          <div id="searchbar-cart">
            <form id="search" action="../controler/recherche.ctrl.php" method="get">
                <p id="search-elements"><input id="search-input" type="search" name="search" placeholder="Rechercher">
                <button id="search-submit" type="submit" title="Rechercher"></button></p>
            </form>

            <form id="cart-icon" action="../controler/panier.ctrl.php" method="get">
              <button id="cart-button" type="submit" title="Panier"></button>
            </form>
          </div>


        <nav id="categories" role="navigation">
          <ul id="categories-menu">
            <?php foreach($mainCat as $key => $cat) { ?>
              <li class="categories-menu-item">
                <a href="../controler/categorie.ctrl.php?cat=<?= $cat->numero ?>"><?= $cat->nom ?></a>
                <?php foreach($subCat as $key_v2 => $cat_v2) {
                  if (!empty($cat_v2) && $key == $key_v2) { ?>
                    <ul class="categories-submenu">
                      <?php foreach($subCat[$key_v2] as $key_v3 => $cat_v3) { ?>
                      <li class="categories-submenu-item">
                        <a href="../controler/categorie.ctrl.php?cat=<?= $cat_v3->numero ?>"><?= $cat_v3->nom ?></a>
                      </li>
                    <?php } ?>
                    </ul>
              <?php } } ?>
              </li>
            <?php } ?>
          </ul>
        </nav>

      </div>

    </header>
  </body>
</html>
