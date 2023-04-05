<?php
session_start();
?>
<head>
    <link rel="stylesheet" href="post.css">
</head>

<img src="../afbeeldingen/twotter.png" alt="Logo" style="position: absolute; top: 20px; left: 20px; width: 200px; height: 200px;">
<form method="POST" class="tweetten">
    titel:<input type="text" name="titelInput">
    <br>
    tweet:<input type="text" name="tweetInput">
    <br><br>
    <input type="submit" name="submit">
</form>
<div class="sidebar">
    <a href="../code/logo.html"><span class="oval">home</span></a><br>
    <?php
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<a href="logout.php"><span class="oval">logout</span></a><br>';
        echo '<h3>' . $username . '</h3>';

    } else {
        echo '<a href="login.php"><span class="oval">login</span></a><br>';
        echo '<a href="register.php"><span class="oval">register</span></a><br>';
    }
    ?>

</div>

<?php
include_once "databaseconectie.php";

global $dbConnectie;

if(isset($_POST["submit"])){
    $query = $dbConnectie->prepare("
    INSERT INTO tweets (titel, inhoud, user_id)
    SELECT :placeholderTitel, :phInhoud, id
    FROM profiel
    WHERE username = :phUsername
");
    $query->execute([
        "placeholderTitel" => $_POST["titelInput"],
        "phInhoud" => $_POST["tweetInput"],
        "phUsername" => $_SESSION['username']
    ]);

$voorbereideQuery = $dbConnectie->prepare("SELECT *, (SELECT username FROM profiel WHERE id = tweets.user_id) AS username FROM tweets;");
$voorbereideQuery->execute([]);
$data = $voorbereideQuery->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $item){
    ?>
    <div class="DeTweet">
        Gebruiker: <?php echo $item["username"]?><br>
        Tekst: <?php echo $item["inhoud"]?><br><br>

    </div>
<?php }}
