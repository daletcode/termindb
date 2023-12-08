<?php
session_start();
include "login/db_connect.php";
    if (!isset($_SESSION["id"]) && !isset($_SESSION["navn"])){
        header("location: login/login.php");
    }
    
    if(isset($_POST["score"])){
        $score = $_POST["score"];
        $user = $_SESSION["id"];

        
    $sql = "INSERT INTO reaction(score, bruker) VALUES ('$score', '$user');"; 

    $result = mysqli_query($conn, $sql);

    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>




<div class="end-screen ">
    <div class="container">
        <h1>Reaction Time Tet</h1>
        <div class="reaction-time-text">234 ms</div>
        <button><div class="play-again-btn">Play Again</div></button>
        
        <form id="post" method="POST">
            <div class="score">
            <input type="number" id="score" name="score">
            </div>
            <button type="submit"><div class="play-again-btn">Save score</div></button>
        </form>

        <div class="topscore">
            <?php                
$sql = "SELECT r.*, b.brukernavn FROM reaction r
JOIN bruker b ON r.bruker = b.idbruker
ORDER BY r.score ASC
LIMIT 8    ";

$result = mysqli_query($conn, $sql);
echo "<h1>LEADERBOARD</h1>";
while ($row = mysqli_fetch_assoc($result)) {
echo "<h1 class= 'top10'> PLAYER: " . $row["brukernavn"] . " | SCORE: " . $row["score"] . "</h1><br>";
}
            ?>
        </div>


    </div>
</div>



<div class="main-menu active">
    <div class="container">
        <h1>Reaction Time Test</h1>
        <p>To score click the left mousebutton as fast as you can </p>
        <p> when you the screen color changes to green</p>
        <p>Click anywhere on the screen to start </p>
        <p> <h2> <i> the "Reaction Test" game! </i> </h2> </p>
        <a href="login/logout.php" class = "logout-btn">Logg ut</a>
    </div>
</div>

<div class="clickable-area">
    <div class="message">Click Now!</div>
</div>

    <script src="reaction.js"></script>
</body>
</html>