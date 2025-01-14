<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Success</title>

    <style>
        /* Verwendete Schriftart */
        @font-face {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 900;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/montserrat/v25/JTUHjIg1_i6t8kCHKm4532VJOt5-QNFgpCvC73w0aXpsog.woff2) format('woff2');
        }

        /* Allgemeines Styling */
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #notfound {
            text-align: center;
        }

        .notfound-404 h3 {
            font-size: 36px;
            font-weight: 700;
            color: #2c3e50;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        /* Bild Styling */
        img {
            width: 100%;
            height: auto;
            max-width: 300px;
            margin: 20px 0;
        }

    </style>
</head>

<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h3>Door Opened Successfully!</h3>
            </div>
            <img src="{{ asset('storage/img/success.svg') }}" alt="Success Icon">
        </div>
    </div>
</body>

</html>
