<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    <style>
        /* Add any other CSS styles you need */
        .highlighted {
            background-color: yellow;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            
        }

    </style>
    </head>
<body>
    <p>Select a portion of this text:</p>
    <div class="container">
    <p id="myText">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>

        <input type="file" name="file" onchange="parseWordDocxFile(this)">
        <script src="https://cdn.jsdelivr.net/npm/mammoth@1.4.8/mammoth.browser.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="aiscript/extract.js"></script>
        
    </body>

</html>