<!DOCTYPE html>
<html>
<head>
    <title>register</title>
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
            color: red;
            margin-top: 10px;
        }
        .success-message{
            color: #000b54;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <form class="login-form" method="post" action="">
        <?php

        include_once "databaseconectie.php";
        global $dbConnectie;

        if (isset($_POST['inloggen'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $dbConnectie->prepare(
                "SELECT * FROM profiel WHERE username = :user"
            );
            $query->bindParam(":user", $username);
            $query->execute();

            if ($query->rowCount() > 0) {
                echo '<p class="error-message">Gebruikersnaam bestaat al!</p>';
            } else {
                $insertQuery = $dbConnectie->prepare(
                    "INSERT INTO profiel (username, password) VALUES (:user, :pass)"
                );
                $insertQuery->bindParam(":user", $username);
                $insertQuery->bindParam(":pass", $password);
                $insertQuery->execute();

                echo '<p class="success-message">Gebruiker toegevoegd!</p>';
            }
        }
        ?>
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <input type="submit" name="inloggen" value="register"><br>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>

    </form>
</div>

</body>
</html>