<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(1, 1, 122);, 1 ;
            max-width: 400px;
            width: 100%;
        }

        .login-form label {
            display: block;
            margin-bottom: 10px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .login-form input[type="submit"] {
            background-color: #000b54;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .error-message {
            color: #F9B4F6;
            margin-top: 10px;
            font-size: 25px;
        }
        .success-message{
            color: #000b54;
            margin-top: 10px;
            font-size: 25px
        }
    </style>
</head>
<body>
<div class="container">
    <form class="login-form" method="post" action="login.php">
        <?php
        include_once "databaseconectie.php";

        global $dbConnectie;

        if (isset($_POST['inloggen'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $dbConnectie->prepare("SELECT * FROM profiel WHERE username = :user AND password = :pass");
            $query->bindParam(":user", $username);
            $query->bindParam(":pass", $password);
            $query->execute();

            if ($query->rowCount() > 0) {
                $_SESSION['username'] = $username; // add username to session
                header("Location: post.php"); // redirect to post page
                exit;
            } else {
                echo '<p class="error-message">Inloggegevens zijn onjuist!</p>';
            }
        }
        ?>
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <input type="submit" name="inloggen" value="Inloggen">
    </form>
</div>
</body>
</html>
