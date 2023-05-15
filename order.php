<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Order</title>

    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./order-style.css">

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
                <?php
                    /*
                    * How to prepare a new payment with the Mollie API.
                    */

                    try {
                        /*
                        * Initialize the Mollie API library with your API key.
                        *
                        * See: https://www.mollie.com/dashboard/developers/api-keys
                        */
                        // require "../initialize.php";

                        $mollie = new \Mollie\Api\MollieApiClient();
                        $mollie->setApiKey("test_WBh4ySNuvGwsn6WEvE6gM9sJFP7rpM");

                        /*
                        * Determine the url parts to these example files.
                        */
                        $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
                        $hostname = $_SERVER['HTTP_HOST'];
                        $path = dirname($_SERVER['REQUEST_URI'] ?? $_SERVER['PHP_SELF']);

                        /*
                        * Required Payment Link parameters:
                        *   amount        Amount in EUROs. This example creates a € 10,- payment.
                        *   description   Description of the payment.
                        */
                        $paymentLink = $mollie->paymentLinks->create([
                            "amount" => [
                                "currency" => "EUR",
                                "value" => "10.00", // You must send the correct number of decimals, thus we enforce the use of strings
                            ],
                            "description" => "Bicycle tires",
                            "webhookUrl" => "{$protocol}://{$hostname}{$path}/webhook.php", // optional
                        ]);

                        /*
                        * Send the customer off to complete the payment.
                        * This request should always be a GET, thus we enforce 303 http response code
                        */
                        header("Location: " . $paymentLink->getCheckoutUrl(), true, 303);
                    } catch (\Mollie\Api\Exceptions\ApiException $e) {
                        echo "API call failed: " . htmlspecialchars($e->getMessage());
                    }

                ?>
            </div>

            <div class="buttons">
                <a class="purple-i" href="index.html">
                    Return
                </a>

                <a id="buy" class="purple-1" href="#">
                    Buy
                </a>
            </div>

        </div>

        <div class="items">

            <div class="item">
                <div>
                
                    <h1>Exactlink</h1>
                    <h3>€ 299,00</h3>
                    <h3>€ 999,00</h3>
                
                </div>

                <div class="interact">

                    <input type="number" class="wide" name="quantity" placeholder="Quantity">
                    <br>
                    <a href="#"><img class="icon" src="icons/trash.svg" alt=""></a>
                    <a href="#"><img class="icon" src="icons/share.svg" alt=""></a>
                    
                    
                </div>
                
                <img class="product" src="assets/renders/exactlink_device.png" alt="">
            </div>

            <div class="item">
                <div>
                
                    <h1>DB25 adapter</h1>
                    <h3>€ 299,00</h3>
                    <h3>€ 999,00</h3>
                
                </div>

                <div class="interact">

                    <input type="number" class="wide" name="quantity" placeholder="Quantity">
                    
                    <br>
                    
                    <a href="#"><img class="icon" src="icons/trash.svg" alt=""></a>
                    <a href="#"><img class="icon" src="icons/share.svg" alt=""></a>
                    
                    <br>

                    <select name="port_direction" id="">

                        <option value="left">Left</option>
                        <option value="right">Right</option>
                        <label for="port_direction">Port direction</label>

                    </select>
                    <label for="port_direction"><a href="#">Port direction</a></label>
                    
                </div>
                
                <img class="product" src="assets/renders/dongle_top.png" alt="">

            </div>

            <div class="item">
                
            </div>

        </div>

    </div>
    
    <script>

        document.getElementById("buy").addEventListener("click", function ()
        {
            document.getElementById("customer_info").style.display = "none";
        });

    </script>
</body>
</html>