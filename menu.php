 <?php
  include 'header.php';

  if(!empty($_GET["action"]))
  {
    switch($_GET["action"])
    {
    	case "add":
    		if(!empty($_POST["quantity"]))
        {
    			$productByCode = $dbHandle->runQuery("SELECT * FROM menu WHERE code='" . $_GET["code"] . "'");
    			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));

    			if(!empty($_SESSION["cart_item"]))
          {
    				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"])))
            {
    					foreach($_SESSION["cart_item"] as $k => $v)
              {
    							if($productByCode[0]["code"] == $k)
                  {
    								if(empty($_SESSION["cart_item"][$k]["quantity"]))
                    {
    									$_SESSION["cart_item"][$k]["quantity"] = 0;
    								}
    								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
    							}
    					}
    				} else
            {
    					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
    				}
    			} else
          {
    				$_SESSION["cart_item"] = $itemArray;
    			}
    		}
    	break;
    	case "remove":
    		if(!empty($_SESSION["cart_item"])) {
    			foreach($_SESSION["cart_item"] as $k => $v)
          {
    					if($_GET["code"] == $k)
    						unset($_SESSION["cart_item"][$k]);
    					if(empty($_SESSION["cart_item"]))
    						unset($_SESSION["cart_item"]);
    			}
    		}
    	break;
      case 'update':
      if(!empty($_POST["quantity"]))
      {
        $productByCode = $dbHandle->runQuery("SELECT * FROM menu WHERE code='" . $_GET["code"] . "'");
        $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));

        if(!empty($_SESSION["cart_item"]))
        {
          if(array_keys($_SESSION["cart_item"]))
          {
            foreach($_SESSION["cart_item"] as $k => $v)
            {
                if($productByCode[0]["code"] == $k)
                {
                  if(empty($_SESSION["cart_item"][$k]["quantity"]))
                  {
                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                  }
                  $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                }
            }
          } else
          {
            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
          }
        } else
        {
          $_SESSION["cart_item"] = $itemArray;
        }
      }
        break;
    	case "empty":
    		unset($_SESSION["cart_item"]);
    	break;
  }
}
  ?>

  <script>
      if(typeof window.history.pushState == 'function') {
          window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
      }
  </script>

<link rel="stylesheet" href="css/menu.css">

<style>
    .fal, .fas{
        margin-right: 8px;
        cursor: pointer;
    }
    .star{
        margin-left: 300px; display: flex; justify-content: end;
    }
    #message{
        font-size: 24px;
        font-weight: 500;
        margin-top: -10px;
    }
    #message2{
        font-size: 24px;
        font-weight: 500;
        margin-top: -10px;
    }
    #message3{
        font-size: 24px;
        font-weight: 500;
        margin-top: -10px;
    }
    #message4{
        font-size: 24px;
        font-weight: 500;
        margin-top: -10px;
    }
</style>

        <div class="container container-main">
            <div class="row top-buffer">
                <div class="col-md-3">
                    <img src="images/ramsey.jfif" alt="Gordon Ramsey" class="ramsey">
                </div>
                <div class="col-md-9">
                    <p class="quote">
                        “The extension of the japanese soul is unbelievable in this menu. I wouldn’t hesitate to exchange all my Michelin stars and the left kidney for a chance to experience these delicacies again.”
                    </p>
                </div>
            </div>
            <div class="container sushi-img-over-text">
                <img src="images/sushi-rolls.jpg" alt="Sushi" class="sushi-img">
                <h1 class="sushi-text">
                    TOP-QUALITY STRAIGHT FROM THE BALTIC SEA SUSHI IN THE TOWN OF HäMEENLINNA
                </h1>
            </div>

            <div class="row top-buffer">
                <div class="col-lg-6 border-right">
                  <?php
                    $productArray = $dbHandle->runQuery("SELECT * FROM menu ORDER BY id ASC");
                    if(!empty($productArray))
                    {
                      foreach ($productArray as $key => $value)
                      {
                  ?>
                    <div class="row menu">
                        <div class="col-sm-6 col-img">
<<<<<<< HEAD
                            <img src="images/sushi1a.jpg" alt="Red Salmon Set" class="menu-img">
                        </div>
                        <div class="col-sm-6 menu-text">
                            <p>RED SALMON SET<br>
                            Red Salmon 7pcs<br>
                            Grilled Red Salmon 7pcs</p>
                        </div>
                        <div class="col-sm-12 star">
                            <i class="fas fa-star" id="iStar1" onclick="ckeckStar1()"></i>
                            <i class="fas fa-star" id="iStar2" onclick="ckeckStar2()"></i>
                            <i class="fas fa-star" id="iStar3" onclick="ckeckStar3()"></i>
                            <i class="fas fa-star" id="iStar4" onclick="ckeckStar4()"></i>
                            <i class="fas fa-star" id="iStar5" onclick="ckeckStar5()"></i>
                            <p id="message">0.0</p>
                        </div>
                    </div>
                    <div class="row menu">
                        <div class="col-sm-6 col-img">
                            <img src="images/sushi2a.jpg" alt="Avocado Salmon Set" class="menu-img">
                        </div>
                        <div class="col-sm-6 menu-text">
                            <p>AVOCADO SALMON SET<br>
                            Avocado Salmon 8pcs<br>
                            Grilled Avocado Salmon 7pcs</p>
                        </div>
                        <div class="col-sm-12 star">
                        <i class="fas fa-star" id="iStar21" onclick="ckeckStar21()"></i>
                            <i class="fas fa-star" id="iStar22" onclick="ckeckStar22()"></i>
                            <i class="fas fa-star" id="iStar23" onclick="ckeckStar23()"></i>
                            <i class="fas fa-star" id="iStar24" onclick="ckeckStar24()"></i>
                            <i class="fas fa-star" id="iStar25" onclick="ckeckStar25()"></i>
                            <p id="message2">0.0</p>
                        </div>
                    </div>
                    <div class="row menu">
                        <div class="col-sm-6 col-img">
                            <img src="images/sushi3a.jpg" alt="Mixed One Set" class="menu-img">
                        </div>
                        <div class="col-sm-6 menu-text">
                            <p>MIXED ONE SET<br>
                            Salmon 2pcs<br>
                            Grilled Red Salmon 8pcs<br>
                            Avocado 2pcs<br>
                            Prawn 2pcs</p>
                        </div>
                        <div class="col-sm-12 star">
                            <i class="fas fa-star" id="iStar31" onclick="ckeckStar31()"></i>
                            <i class="fas fa-star" id="iStar32" onclick="ckeckStar32()"></i>
                            <i class="fas fa-star" id="iStar33" onclick="ckeckStar33()"></i>
                            <i class="fas fa-star" id="iStar34" onclick="ckeckStar34()"></i>
                            <i class="fas fa-star" id="iStar35" onclick="ckeckStar35()"></i>
                            <p id="message3">0.0</p>
                        </div>
                    </div>
                    <div class="row menu">
                        <div class="col-sm-6 col-img">
                            <img src="images/sushi4a.jpg" alt="Mixed Two Set" class="menu-img">
=======
                            <img src="<?php echo $productArray[$key]["image"]; ?>" alt="<?php echo $productArray[$key]["name"]; ?>" class="menu-img">
>>>>>>> b312acd161127e706426003fe43b70f06a1c51cc
                        </div>
                        <div class="col-sm-6 menu-text">
                            <p><?php echo $productArray[$key]["name"] ?><br>
                            <?php echo $productArray[$key]["description"] ?> <br>
                            <?php echo $productArray[$key]["price"]. "€" ?>
                          </p>
                        </div>
<<<<<<< HEAD
                        <div class="col-sm-12 star">
                            <i class="fas fa-star" id="iStar41" onclick="ckeckStar41()"></i>
                            <i class="fas fa-star" id="iStar42" onclick="ckeckStar42()"></i>
                            <i class="fas fa-star" id="iStar43" onclick="ckeckStar43()"></i>
                            <i class="fas fa-star" id="iStar44" onclick="ckeckStar44()"></i>
                            <i class="fas fa-star" id="iStar45" onclick="ckeckStar45()"></i>
                            <p id="message4">0.0</p>
                        </div>
                    </div>
                </div>4
                <div class="col-lg-5 border-left">
=======
                        <form  class="form" action="menu.php?action=add&code=<?php echo $productArray[$key]['code']; ?>" method="post">
                        <input type="hidden" name="code" value="<?php echo $productArray[$key]['code'] ?>">
                        <input type="number" name="quantity" value="1" min="1" class="productQuantity" />
                        <input type="submit" value="Add To Cart" class="btnAdd btn-dark" />
                      </form>
                    </div>
                    <?php
                      }
                    }
                    ?>
                </div>

                <div class="col-lg-6 border-left">
>>>>>>> b312acd161127e706426003fe43b70f06a1c51cc
                    <div class="row">
                        <p class="prices-text justify-content-center">
                            We are the proud bearers of the millenial sushi tradition. For us, the mission is to provide the authentic and quality experience of Japan to everyone. For that reason, we keep the prices same for each of the sushi sets.
                        <br><br>
                            And of course, you are most welcome to experience our fresh hand-made all-you-can-eat buffet.
                            <br><br>
                            Prices: <br>
                            Set.................................................18.00EUR
                            <br>
                            Buffet.......................................29.00EUR
                        </p>
                    </div>
                    <a href="#" class="btn btn-dark" role="button" aria-pressed="true">Wolt Delivery</a>
                    <a href="#" class="btn btn-dark" role="button" aria-pressed="true">Table Reservation</a>
                </div>
<<<<<<< HEAD
            </div>
        </div>
<script src="js/menu.js"></script>
=======
              </div>


                <div class="shoppingCart">

                  <?php
                  if(isset($_SESSION["cart_item"]))
                  {
                      $total_quantity = 0;
                      $total_price = 0;
                  ?>

                  <a id="btnEmpty" class="btn-dark" href="menu.php?action=empty">Empty Cart</a>

                  <table class="tbl-cart" cellpadding="10" cellspacing="1">
                  <tbody>
                  <tr>
                  <th style="text-align:center;">Name</th>
                  <th style="text-align:right;" width="5%">Quantity</th>
                  <th style="text-align:right;" width="10%">Unit Price</th>
                  <th style="text-align:right;" width="10%">Price</th>
                  <th style="text-align:center;" width="5%">Remove</th>
                  </tr>

                  <?php
                      foreach ($_SESSION["cart_item"] as $item){
                          $item_price = $item["quantity"]*$item["price"];
                      ?>
                          <tr>
                          <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><p class="cart-name"><?php echo $item["name"]; ?></p></td>
                          <form class="" action="menu.php?action=update&code=<?php echo $item["code"]; ?>" method="post">
                          <td style="text-align:right;"><input type="number" name="quantity" value="<?php echo $item["quantity"]; ?>" min="1" class="productQuantity" /></td>
                        </form>
                          <td  style="text-align:right;"><?php echo $item["price"]. "€"; ?></td>
                          <td  style="text-align:right;"><?php echo number_format($item_price,2). "€"; ?></td>
                          <td style="text-align:center;"><a href="menu.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="images/icon-delete.png" alt="Remove Item" /></a></td>
                          </tr>
                          <?php
                          $total_quantity += $item["quantity"];
                          $total_price += ($item["price"]*$item["quantity"]);
                      }
                      ?>
                  <tr>
                  <td colspan="2" align="right">Total:</td>
                  <td align="right"><?php echo $total_quantity; ?></td>
                  <td align="right" colspan="2"><strong><?php echo number_format($total_price, 2). "€"; ?></strong></td>
                  <td></td>
                  </tr>
                  </tbody>
                  </table>
                  <?php
                  }
                  ?>
                  </div>

            </div>
>>>>>>> b312acd161127e706426003fe43b70f06a1c51cc
<?php include 'footer.php' ?>
