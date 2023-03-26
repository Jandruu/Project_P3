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
<style>
    /* Define the styles for the ovals */
    .oval {
        display: block;
        width: 60px;
        height: 40px;
        background-color: #000080;
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        color: #ffffff;
        font-weight: bold;
        margin-bottom: 10px;
        transition: all 0.2s ease-in-out;
    }
    /* Change the oval shape */
    .oval {
        border-radius: 20px / 50%;
    }
    /* Change the oval color on hover */
    .oval:hover {
        background-color: #000b54;
        cursor: pointer;
    }
    /* Define the styles for the sidebar container */
    .sidebar {
        position: fixed;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        padding: 20px;
        background-color: white;
        box-shadow: 2px 2px 10px rgba(1, 1, 122);, 1 ;
        display: flex; /* make it a flex container */
        flex-direction: column; /* set the direction to column */
    }
    /* Define the styles for the links */
    .sidebar a {
        display: block;
        margin-bottom: 10px;
        color: #000000;
        text-decoration: none;
    }
</style>
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
    <style>
        .tweetten {
            margin: 0 auto;
            width: 50%;
            text-align: center;
            margin-bottom: 20px;
        }
        div{
            display: flex;
            justify-content: center;
        }
    </style>
    <div class="DeTweet">
        user: <?php echo $item["titel"]?><br>
        Tekst: <?php echo $item["inhoud"]?><br><br>
    </div>
    <?php
}
