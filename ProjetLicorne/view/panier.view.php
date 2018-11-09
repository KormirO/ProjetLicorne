<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>AchèteUneLicorne | Panier</title>
  <link type="text/css" rel="stylesheet" href="../view/design/style.css?<? echo time(); ?>" media="all">
</head>

<body id="home">

  <?php include('../view/header.view.php') ?>

  <!-- Un titre qui indique qu'il s'agit du panier -->
  <h1 id="title-cart">Votre panier</h1>

  <!-- Affichage d'un message si panier vide -->
  <?php if (empty($cart['nomProd'])) { ?>
    <p id="cart-empty">Votre panier est vide pour l'instant.</p>
  <?php } else { ?>

    <!-- Le panier lié à la session -->
    <div id="cart">
      <table id="cart-table">
        <thead id="cart-table-header">
          <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Sous-total</th>
          </tr>
        </thead>
        <tbody id="cart-table-body">
          <?php for($i=0; $i < $nbProdCart; $i++) { ?>
            <tr>
              <td> <?= $listNomsProd[$i] ?> </td>
              <td>
                <form id="modif-qte" action="../controler/panier.ctrl.php" method="post">
                  <button type="submit" name="downQte" onclick="">-</button>
                  <label> <?= $listQtesProd[$i] ?> </label>
                  <button type="submit" name="upQte" onclick="">+</button>
                </form>
              </td>
              <td> <?= $listPrixProd[$i]*$listQtesProd[$i] ?> € </td>
            </tr>
          <?php } ?>
          <tr id="cart-total">
            <td class="cart-total-text">TOTAL :</td>
            <td></td>
            <td class="cart-total-text"> <?= $totalPrice ?> € </td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php } ?>

  <?php include('../view/footer.view.php')  ?>

</body>
</html>
