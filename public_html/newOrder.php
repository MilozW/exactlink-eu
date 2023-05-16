<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Order</title>

    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/orderStyle.css">

    <style>
        .summary, .item {
            color: #180818;
            background-color: #fff;
        }
    </style>

</head>
<body class="">


    <div class="order">

        <div class="summary">
            <h2>Summary</h2>

            <div class="prices">
                <div>
                    <h3>Product total</h3>
                    <h3>Shipping</h3>
                    <input type="text" name="coupon" placeholder="coupon" id="">
                </div>
                    
                <div class="numbers">
                    <h3>€ 234,00</h3>
                    <h3>€ 356,00</h3>
                    <h3>€ - 0,00</h3>
                </div>
            </div>

            <h2>Customer information</h2>

            <form id="customer_info" action="">

                <div class="info">

                    <input type="text" class="wide" name="customer_name" placeholder="Name">
                    <input type="text" name="business_name" placeholder="Business name">
                    <input type="text" name="vat" placeholder="VAT">

                </div>
                
                <div class="info">

                    <input type="text" name="country" placeholder="Country">
                    <input type="text" name="region" placeholder="Region">
                    <input type="text" name="city" placeholder="City">
                    <input type="text" name="zip" placeholder="Zip or Postal code">

                </div>

                <div class="info">

                    <input type="text" class="wide" name="address1" placeholder="Address line 1">
                    <input type="text" class="wide" name="address2" placeholder="Address line 2">

                </div>


            </form>
            

            <div class="prices total">
                <div>
                    <h3>Total</h3>
                </div>
                    
                <div class="numbers">
                    <h3>€ 9000,00</h3>
                </div>
            </div>


            <div class="mollie">
            
            </div>

            <div class="buttons">
                <a class="purple-i" href="index.html">
                    Return
                </a>

                <a id="buy" class="purple-1" href="#">
                    Verify & Pay
                </a>
            </div>

        </div>

        <div class="items">

            <?php

                $items = json_decode($_GET["items"], true)["item"];

                foreach($items as $item)
                {
                    $itemHTML = "<div class=\"item\">";
                    
                    $itemHTML .= "<div><h1>".$item["name"]."</h1></div>";
                    
                    $itemHTML .= "</div>";

                    echo $itemHTML;
                }

            ?>

        </div>

    </div>
    
</body>
</html>