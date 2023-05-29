<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Order</title>

    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/buyStyle.css">

    <?php
        global $pricing;
        global $products;

        global $order;

        $order = $_GET["order"];

        $pricing = json_decode(file_get_contents("../productData/productData.json"), true);
        $products = json_decode(htmlspecialchars_decode($_GET["order"]), true)["products"];
    ?>

    <style>

        #pageLoading {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            z-index: 1000;

            display: flex;
            justify-content: space-around;
            align-items: center;
        }

    </style>

</head>
<body>

    <div class="container">

        <div class="buyInfo" id="price" data-pricing="<?php echo htmlspecialchars(json_encode($pricing["bulkPricing"]));?>">

            <div class="pricing">

                <h3>Set: € <span id="setPrice"></span></h3>
                
                <h1>Total: € <span id="totalPrice"></span></h1>

            </div>

            <div class="input">

                <div class="inputField">
                    <input type="text" placeholder="Company name"></input>
                    <input type="text" placeholder="VAT"></input>
                </div>
                
                <div class="inputField">
                    <div>
                        <input type="text" class="smol" placeholder="Name"></input>
                        <input type="text" class="smol" placeholder="Surname"></input>
                    </div>
                    
                    <input type="text" placeholder="Email"></input>
                </div>

                <div class="inputField">
                    <input type="text" placeholder="Postal code"></input>
                    <input type="text" placeholder="Address line 1"></input>
                </div>

            </div>

            <a class="button configure purple-1" id="buy" href="#">Buy now</a>

        </div>

        <div class="productOptions">

            <div class="intro">
                <div>
                    <h1>Order summary</h1>
                    Your order will be processed within 5 working days.

                </div>

                <a class="button configure purple-i" id="configure" href="<?php echo "./configure.php?count=".count($products)."&index=1&order=".htmlspecialchars($_GET["order"]) ?>">Reconfigure</a>

                <script>
                    let url = "<?php echo "./configure.php?count="."&index=1&order=".$_GET["order"] ?>";

                    console.log(url);
                </script>
        

            </div>

            <div class="products">

                <?php
                    
                    foreach($products as $item)
                    {
                        echo "<div class=\"item\"><div><h3>Exactlink</h3></div><div class=\"configuration\"><h3>Configuration</h3>USB length: <strong>".$item["USBlen"]." metre</strong><br>RS232 cable length: <strong>".$item["RS232len"]." metre</strong><br>RS232 port direction: <strong>".$item["portDir"]."</strong></div></div>";
                    }

                ?>

            </div>

            <div class="options">
            </div>

        </div>

    </div>

    <script src="../js/price.js"></script>

    <script>

        let price = createPricing(<?php echo count($products) ?>);
            
        document.getElementById("setPrice").innerHTML = price.set;
        document.getElementById("totalPrice").innerHTML = price.total;

    </script>

</body>
</html>