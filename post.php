<head>
    <link rel="stylesheet" href="style.css">
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
    <a href="#"><span class="oval">2</span></a><br>
    <a href="#"><span class="oval">3</span></a><br>
    <a href="#"><span class="oval">4</span></a><br>
    <a href="#"><span class="oval">profile</span></a>
</div>

<?php
include_once "databaseconectie.php";

global $dbConnectie;

if(isset($_POST["submit"])){
    $query = $dbConnectie->prepare(
        "INSERT INTO tweets (titel, inhoud)
                    VALUES (:placeholderTitel, :phInhoud);");
    $query->execute([
        "placeholderTitel" => $_POST["titelInput"],
        "phInhoud" => $_POST["tweetInput"]
    ]);
}

$voorbereideQuery = $dbConnectie->prepare("SELECT * FROM tweets;");
$voorbereideQuery->execute([]);
$data = $voorbereideQuery->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $item){
    ?>

    <div class="DeTweet">
        user: <?php echo $item["titel"]?><br>
        Tekst: <?php echo $item["inhoud"]?><br><br>
    </div>
    <?php
}
