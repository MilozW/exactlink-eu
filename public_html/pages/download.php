<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exactlink software</title>

    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/downloadStyle.css">
    
    <style>
        
        .buttons {
            display: flex;
            justify-content: space-between;
            margin: 0;
        }

        .buttons a {
            text-decoration: none;
            padding: 0.5em 1em;
            border-radius: 100em;
        }

        .belowInput {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .invalid {
            color: #ff0000;
            margin: auto 0;
        }

        
        .space {
            width: 2em;
        }

        .download {
            padding: 2em;
            margin: 3em;
            color: #000;

            width: 10em;

            background-color: #fff;
        }

        .download h3 {
            margin-bottom: 2em;
        }

        .downloadField {
            display: flex;
            justify-content: center;
        }

        .container .heading, .container .buttons a {
            margin-left: 3em;
        }

        .download .buttons a {
            margin: 0;
        }

    </style>
</head>
<body>

    <div class="exactlinkID">

        <?php

            if(isset($_GET["id"]))
            {
                $GET_id = $_GET["id"];
            }
            else
            {
                $GET_id = "";
            }
            
            $validID = false;

            $json_id = json_decode(file_get_contents("../../database/IDs.json"), true)["IDs"];

            foreach($json_id as $id)
            {
                if($id == $GET_id)
                {
                    $validID = true;
                    break;
                }
            }


            if(!$GET_id || !$validID)
            {
                $serialNumFieldHTML = "<div id=\"serialNumField\"><h1>Provide serial number.</h1><h3>Serial ID can be found on the bottom of your device.</h3><input type=\"text\" id=\"serialNum\" placeholder=\"Serial number\">";

                $serialNumFieldHTML .= "<div class=\"belowInput\"><div class=\"buttons\"><a class=\"purple-i\" href=\"../index.html\">Return</a> <div class=\"space\"></div> <a class=\"purple-1\" id=\"validateSerial\" href=\"#\">Validate</a></div>";

                if(!$validID && $GET_id)
                {
                    $serialNumFieldHTML .= "<span class=\"invalid\">Invalid serial number!</span>";
                }

                $serialNumFieldHTML .= "</div></div>";

                echo $serialNumFieldHTML;
            }

            else if($validID)
            {
                $downloadFieldHTML = "<div class=\"container\"><div class=\"heading\"><h1>Serial number validated.</h1><h3>Make sure to connect to internet on first connection with Exactlink.</h3></div><div class=\"downloadField\">";

                $downloadFieldHTML .= "<div class=\"download\"><h1>Windows</h1><h3>2.0.6</h3><div class=\"buttons\"><a class=\"purple-1\" href=\"HTTPS://exacatmetal.nl/software/2.0.6.exe\">Download</a></div></div>";
                $downloadFieldHTML .= "<div class=\"download\"><h1>Linux</h1><h3>2.0.6</h3><div class=\"buttons\"><a class=\"purple-1\" href=\"HTTPS://exacatmetal.nl/software/2.0.6.deb\">Download</a></div></div>";
                $downloadFieldHTML .= "<div class=\"download\" style=\"color: #fff\"><h1>a </h1><h3>a </h3><div class=\"buttons\"><a class=\"purple-i\" href=\"../index.html\">Return</a></div></div>";
                
                // $downloadFieldHTML .= "</div></div>";
                $downloadFieldHTML .= "</div></div>";
            
                echo $downloadFieldHTML;
            }

        ?>

    </div>

    <script>

        function reSubmitSerial()
        {
            let inputSerialNum = document.getElementById("serialNum").value;

            window.location.href = "./download.php?id=" + inputSerialNum;
        }

        let validateSerial = document.getElementById("validateSerial");

        if(validateSerial !== null)
        {
            validateSerial.addEventListener("click", function ()
            {
                
                reSubmitSerial();

            });

            document.querySelector('#serialNum').addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    reSubmitSerial();
                }
            });
        }

    </script>

</body>
</html>