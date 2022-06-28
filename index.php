<?php
    include "db.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Proyek Spotify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="spotify.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<?php
            //check connection
            if($connection->connect_error){
                die("connection failed: ".$connection->connect_error);
            }
            
            $user=$_SESSION["username"];
            
?>
    <div class="logo">
        <ul>
            <li class="brand"><i class="fab fa-spotify"></i> Spotify</li>
        </ul>
    </div>

    <a href="login.php" type="button" class="btn btn-dark btn-lg"
        style="float:right; color:#00C897; margin-right:50px; margin-top:15px;">Logout</a>

    <div class="imge">
        <img src="kahitna.png" alt="">
    </div>

    <div class="hd">
        Spotify Data Science
    </div>
    <div class="content">
        <em>Showing the Top 10 songs, <br> Recommended for you, and<br> Your favorite songs</em>
    </div>

    <div class="top">
        <a type="button" class="btn btn-outline-success btn-lg" href="top10song.php">Top 10 Song</a>
    </div>

    <div class="fav">
        <a type="button" class="btn btn-outline-success btn-lg" href="favourite.php">Favorite</a>
    </div>

    <div class="all">
        <a type="button" class="btn btn-outline-success btn-lg" href="allsong.php">All Song</a>
    </div>

</body>

</html>