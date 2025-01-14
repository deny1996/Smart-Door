<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @if ($isValid === true)
    <title>Link Not Yet Valid</title>
  @else
   <title>Link Expired</title>
  @endif

  <link href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;700&family=Montserrat:wght@900&display=swap" rel="stylesheet">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Cabin', sans-serif;
      background-color: #f4f4f4;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 20px;
    }

    #notfound {
      text-align: center;
      max-width: 600px;
      width: 100%;
    }

    .validating-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .validating-section img {
      width: 200px;
      height: auto;
      margin-bottom: 20px;
    }

    h2 {
      font-size: 24px;
      font-weight: 400;
      color: #333;
      margin-bottom: 15px;
    }

    h3 {
      font-size: 18px;
      font-weight: 700;
      color: #555;
      text-transform: uppercase;
      margin-bottom: 10px;
    }

    p {
      font-size: 16px;
      line-height: 1.6;
      color: #777;
    }

    .countdown {
      font-size: 20px;
      color: #f39c12;
      font-weight: bold;
    }

    a {
      color: #f39c12;
      text-decoration: none;
      font-weight: bold;
      border-bottom: 1px solid transparent;
      transition: all 0.3s ease;
    }

    a:hover {
      border-bottom: 1px solid #f39c12;
    }

    @media (max-width: 767px) {
      h2 {
        font-size: 20px;
      }
    }

    @media (max-width: 480px) {
      h2 {
        font-size: 18px;
      }

      p {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  @if ($isValid === true)
    <div id="notfound">
      <div class="validating-section">        
        <div class="notfound-404">
          <h1>Link not yet Valid</h1><br/>
        </div>
      </div>
      <h2>The link you requested will be valid soon.</h2>
      <p>It will be valid from: {{ $validFrom }}</p><br/>
      <h1 id="countdown" class="countdown"></h1>
    </div>

    <script>
      var countDownDate = new Date("{{ $validFrom }}").getTime();
      var x = setInterval(function() {
      var now = new Date().getTime();

        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML = "Time left: " + days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

        if (distance < 0) {
          clearInterval(x);
          document.getElementById("countdown").innerHTML = "The link is now valid!";
        }
      }, 1000);
    </script>
  @elseif ($isValid === false)
    <div id="notfound">
      <div class="notfound-404">
        <h1><span>4</span><span>0</span><span>4</span></h1><br/>
        <h3>Oops! Page not found</h3>
      </div>
      <h2>We are sorry, but the link you requested has expired.</h2>
      <p>Please check the URL or return to the <a href="/">homepage</a>.</p>
    </div>
  @endif
</body>

</html>



