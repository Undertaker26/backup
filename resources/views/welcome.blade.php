<!DOCTYPE html>
<html lang="en">
<head>
<title>Welcome to Scribe Entertainment</title>
    <meta charset="UTF-8">
    <link rel="icon" href="logo2.png"  type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('background.png') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 800px;
            width: 100%;
        }
        .container .button {
            width: 20%;
            padding: 10px;
            background-color: #004d40;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .container button:hover,
        .container a.button:hover {
            background-color: #00332c;
        }
        .container img {
            width: 300px; 
\        }

    </style>
<body>



    @yield('content')
   <div class="container">
   <img src="logo.png" alt="Logo">
        <div class="text">
            <p><br><h1>Welcome to <span>Scribe</span>Entertainment</h1></p>
            <p><br><br><br><p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit repudiandae culpa ipsum, atque ducimus minus magnam animi possimus pariatur nobis, corporis est cum provident recusandae ratione! Dolore vero ducimus aliquid. <br><br> </div>

<input  class="button" type="button" value="Start"  onclick="window.location.href='{{ route('login') }}';">'

    

       </div>
        
    </div>'


</body>
</html>
