<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Exactlink</title>

    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/newOrderStyle.css">
    <link rel="stylesheet" href="../style/homeStyle.css">

    <?php
        global $pricing;

        $pricing = json_decode(file_get_contents("../productData/productData.json"), true);
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

    <div  id="menubar" class="menubar dark-purple">

        <a class="button purple-i" href="../index.html">Home</a>

        <a class="button purple-i" href="./start.html">Quick start</a>

        <a class="button purple-i" href="./download.php">Software</a>

        <div class="menuSpacer"></div>

        <div class="button purple-i" id="bottomPage" href="#">Contact</div>

        <a class="button purple-1" href="#">Buy</a>

        <a href="#" id="burgerOpen"><img class="burger" src="../icons/burger.svg" alt=""></a>

        <div id="burgerMenu">
            
            <div class="menubar">
                <div class="menuSpacer"></div>
                <a href="#" id="burgerClose"><img class="burger" src="../icons/burger_b.svg" alt=""></a>
            </div>

            <a href="../index.html"><h1>Home</h1></a>

            <a href="./start.html"><h1>Quick start</h1></a>
            
            <a href="./download.php"><h1>Software</h1></a>
            
            <a href="#"><h1 class="buy">Buy</h1></a>
            
        </div>

    </div>

    <div id="menubarSpacer"></div>

    <div class="container">

        <div class="productOptions">

            <div class="intro">
                <h1>Ordering Exactlink</h1>
                Create an Exactlink configuration here to add to cart. For quantities over 15 contact <a href="mailto:info@exactmetal.nl">info@exactmetal.nl</a>
            </div>

            <div class="products">

                <?php
                    
                    foreach($pricing["products"] as $product)
                    {
                        $imageArray = "[";
                        $i = 0;

                        foreach($product["image"] as $image)
                        {
                            $i++;
                            $imageArray .= "\"".$image."\"";
                            
                            if($i != count($product["image"]))
                            {
                                $imageArray .= ",";
                            }
                        }

                        $imageArray .= "]";

                        $productHTML = "<div class=\"item\" data-images=\"".htmlspecialchars($imageArray)."\" data-name=\"".htmlspecialchars($product["name"])."\" data-description_long=\"".htmlspecialchars($product["description"]["long"])."\"><img src=\"../productData/".$product["root"]."/images//".$product["headerImage"]."\">";
                        $productHTML .= "<div><h1>".$product["name"]."</h1><h4>".$product["description"]["short"]."</h4></div></div>";

                        echo $productHTML;
                    }

                ?>

            </div>

            <div class="options">
            </div>

        </div>

        

        <div class="addToCart" id="price" data-pricing="<?php echo htmlspecialchars(json_encode($pricing["bulkPricing"]));?>">

            <div>

                <h3>Set: € <span id="setPrice"></span></h3>
                
                <h1>Total: € <span id="totalPrice"></span></h1>
                <input type="text" id="quantity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="Quantity" value="1">    

            </div>

            <div class="menuSpacer"></div>

            <a class="button configure purple-1" id="configure" href="#">Configure</a>

        </div>
    
        
    </div>

    <script src="../js/burger.js"></script>
    <script src="../js/price.js"></script>

    <script>

        function updatePricing()
        {
            let price = createPricing(document.getElementById("quantity").value);
            
            document.getElementById("setPrice").innerHTML = price.set;
            document.getElementById("totalPrice").innerHTML = price.total;
        }


        updatePricing();

        document.getElementById("quantity").addEventListener("keyup", function ()
        {
            updatePricing();
        });

        document.getElementById("configure").addEventListener("click", function ()
        {
            let quantity = document.getElementById("quantity").value;

            window.location.href = "./configure.php?count=" + quantity + "&index=1";
        });

        function renderItem(element)
        {

            let expandedItemHTML = "<h1>" + element.dataset.name + "</h1><h3>" + element.dataset.description_long + "</h3>";

            document.querySelector(".highlight").classList.remove("highlight");

            element.classList.add("highlight");

            document.querySelector(".options").innerHTML = expandedItemHTML;

        }

        // Highlight first item
        document.querySelector(".item").classList.add("highlight");
        renderItem(document.querySelector(".item"));

        let item = document.querySelectorAll(".item");

        for(let i = 0; i < item.length; i++)
        {
            item[i].addEventListener("click", function ()
            {
                console.log("click");
                renderItem(item[i]);
            });
        }

    </script>

</body>
</html>