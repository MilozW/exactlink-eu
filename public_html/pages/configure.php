<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/configureStyle.css">
    
    <title>Configure</title>

    <?php
        global $productCount;
        global $productIndex;
        global $order;

        global $productData;

        $productData = json_decode(file_get_contents("../productData/productData.json"), true)["products"];

        $productCount = $_GET["count"];
        $productIndex = $_GET["index"];

        if(isset($_GET["order"]))
        {
            $order = htmlspecialchars_decode($_GET["order"]);
        }
        else
        {
            $order = "{\"products\": []}";
        }
    ?>

</head>
<body>

    <div class="container">

        <div class="options">

            <div>

                <div class="title">
                    <h1>Configure</h1><h1><?php echo $productIndex." / ".$productCount?></h1>
                </div>
                    
                <div class="lengths">

                    <div class="selects">
                    
                        <div>
                            <h3 class="inputLabel">USB cable length</h3>
                            <select name="" id="USBlenSelect">
                                <option value="0.5">0.5 metre</option>
                                <option value="5">5 metre</option>
                            </select>
                        </div>

                        <div>
                            <h3 class="inputLabel">RS232 cable length</h3>
                            <select name="" id="RS232lenSelect">
                                <option value="0.5">0.5 metre</option>
                                <option value="5">5 metre</option>
                            </select>
                        </div>

                    </div>
                    <div class="menuSpacer"></div>
                    
                    <img class="image" src="../assets/cableLengthExpl.svg" alt="">


                </div>

                <?php

                    function createOptions ($productRoot)
                    {

                        global $product;
                        $i = 0;

                        foreach($productData as $eachProduct)
                        {
                            if($eachProduct["root"] == $productRoot)
                            {
                                $product = $productData[$i];

                                break;
                            }
                            $i++;
                        }

                        foreach($product["option"] as $option)
                        {
                            $optionHTML = "<div class=\"selects\">";
                            $optionHTML .= "<h3 class=\"inputLabel\">".$option["name"]."</h3>";
                            $optionHTML .= "<select id=\"".$option["id"]."\">";

                            $i = 0;
                            
                            foreach($option["optionValue"] as $optionValue)
                            {
                                $optionHTML .= "<option value=\"".$optionValue."\">".$option["optionName"][$i]."</option>";
                                $i++;
                            }

                            $optionHTML .= "</select></div>";

                            echo $optionHTML;
                        }
                    }

                    createOptions("usb_cable");

                ?>

                <div class="portDir">
                    <div class="selects">
                        <h3 class="inputLabel">DB25 adapter direction</h3>
                        <select name="" id="portDirSelect">
                            <option value="left">left</option>
                            <option value="right">right</option>
                        </select>
                    </div>

                    <h3 class="explainer">The RS232 cable exits our RS232 adapter at a 45 degree angle, to determine your optimal port direction print out this template with instructions.</h3>
                        
                </div>

                <div class="buttons">
                    <a class="button configure purple-i" id="previousConfig" href="#">Previous</a>
                    <a class="button configure purple-i" href="./product.php">Return</a>
                    <div class="menuSpacer"></div>
                    <a class="button configure purple-1" id="nextConfig" href="#">Next</a>
                </div>

            </div>

        </div>

        

    </div>

    <script>

        let index = <?php echo $_GET["index"] ?>;
        let count = <?php echo $_GET["count"] ?>;

        let order = JSON.parse(<?php echo '`'.$order.'`' ?>);

        if(order.products[index - 1] != undefined)
        {
            document.getElementById("USBlenSelect").value = order.products[index - 1].USBlen;
            document.getElementById("RS232lenSelect").value = order.products[index - 1].RS232len;
            document.getElementById("portDirSelect").value = order.products[index - 1].portDir;
        }

        document.getElementById("nextConfig").addEventListener("click", function ()
        {
            let config = {
            
                USBlen: document.getElementById("USBlenSelect").value,
                RS232len: document.getElementById("RS232lenSelect").value,
                portDir: document.getElementById("portDirSelect").value
            };

            order.products[index - 1] = config;

            if(index >= count)
            {
                window.location.href = "./order.php?order=" + encodeURIComponent(JSON.stringify(order));
            }
            else
            {
                index++;

                window.location.href = "./configure.php?count=" + count + "&index=" + index + "&order=" + encodeURIComponent(JSON.stringify(order));
            }
        });

        document.getElementById("previousConfig").addEventListener("click", function ()
        {
            index--;

            if(index < 1)
            {
                window.location.href = "./product.php";
            }
            else
            {
                window.location.href = "./configure.php?count=" + count + "&index=" + index + "&order=" + encodeURIComponent(JSON.stringify(order));
            }
        });

 
    </script>
    
</body>
</html>