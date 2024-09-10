<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: whitesmoke;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }
        .menubar {
            background-color:  #1F3F49;
            width: 100%;
            position: sticky;
            top: 0;
            left: 0;
            display: flex;
            justify-content: flex-end;
            padding: 10px;
            box-sizing: border-box;
        }
        .menubar ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .menubar ul li {
            margin: 0 10px;
        }
        .menubar ul li a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
            transition: background-color 0.3s, color 0.3s;
        }
        .menubar ul li a:hover {
            background-color: cyan;
            color: black;
            border-radius: 2px;
        }
        .slideleft {
            animation: slideleft 1s linear forwards;
        }
        @keyframes slideleft {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0%);
                opacity: 1;
            }
        }
        h1.slideleft, p.slideleft {
            animation-delay: 1s;
        }
        .content {
            text-align: center;
            color: black;
            margin-top: 30px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 25%;
            border: none;
            margin-top: 15px;
            margin-bottom: 10px;
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 80%;
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .button-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }
        .login-button {
            background-color:  #1F3F49;
            transition: background-color 0.3s;
        }
        .login-button:hover {
            background-color: green;
        }
        .home-button {
            background-color: #4CB5F5;
            transition: background-color 0.3s;
        }
        .home-button:hover {
            background-color: #1F3F49;
        }
        .home-button a {
            color: #fff;
            text-decoration: none;
        }
        .home-button a:hover {
            color: #fff;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="menubar">
        <!-- Menubar items can be added here -->
    </div>
     
    <div class="content">
        <h1 class="slideleft">WELCOME TO ALTECH BUSINESS</h1> 
        <p class="slideleft">Digitizing The Business System.</p>
    </div>
   
    <form method="POST" action="login.php">
        <h2>ADMIN LOGIN</h2>
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <label for="username">Username:</label>
        <input type="text" id="username" placeholder="Enter Username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" placeholder="Enter Password" name="password" required>
        <br>

        <div class="button-container">
            <button type="submit" class="login-button">Login</button>
            <button type="button" class="home-button"><a href="index.html">Home</a></button>
        </div>
    </form>
</body>
</html>
