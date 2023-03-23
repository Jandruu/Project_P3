<form method="POST">
    titel:
    <input type="text" name="titelInput">
    <br>
    tweet:
    <input type="text" name="tweetInput">
    <br><br>
    <input type="submit" name="submit">
</form>

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
        div{
            display: flex;
            justify-content: center;
        }
    </style>
        <div>
            user: <?php echo $item["titel"]?><br>
            Tekst: <?php echo $item["inhoud"]?><br><br>
        </div>
<?php
}


