<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 100px 20px;
        }
        h1 {
            font-size: 50px;
            color: #FF7506; /* Theme color */
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #7f8c8d;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container a {
            display: inline-block;
            padding: 12px 25px;
            background-color: #FF7506; /* Theme color */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }
        .container a:hover {
            background-color: #e66c05;
        }
        .logo {
            margin-bottom: 40px;
        }
        .logo img {
            max-width: 150px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <!-- Add your logo here using the asset helper function -->
            <img src="{{ asset('uploads/mytravel/general/mainlogo.png') }}" alt="Harmo Stays Logo">
        </div>
        <h1>We’ll be back soon!</h1>
        <p>Harmo Stays is currently undergoing scheduled maintenance. We’ll be back online as soon as possible. Thanks for your patience!</p>
        <a href="/">Go Back to Homepage</a>
    </div>
</body>
</html>

