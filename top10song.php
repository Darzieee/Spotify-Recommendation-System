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

    <div class="logo">
        <ul>
            <a href="index.php">
                <li class="brand"><i class="fab fa-spotify"></i> Spotify</li>
            </a>
        </ul>
    </div>

    <div class="posisi" style="margin:50px;">
        <div class="row">
            <h1 style="color:#FFF; margin-left:10px;"> TOP 10 SONG</h1>
            <h1 style="color:#FFF; margin-left:230px; margin-top:auto; font-size:0.5cm;"> Recommended For You</h1>
            <div class="col-md-8">


                <table class="table table-hover table-dark" style="width: 500px;">
                    <thead>
                        <tr>
                            <th style="color:#2EAC6D;">Title</th>
                            <th style="color:#2EAC6D;">Artist</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            

            //check connection
            if($connection->connect_error){
                die("connection failed: ".$connection->connect_error);
            }

            //read all row from database table
            // $sql="SELECT * FROM spotify_top_100_2019 ORDER BY popularity DESC LIMIT 10";
            $sql="SELECT a.title, a.artist FROM spotify_top_100_2019 a INNER JOIN popularity b WHERE a.ID = b.ID ORDER BY b.popularity DESC LIMIT 10";
            $result=$connection->query($sql);

            if(!$result){
                die("Invalid query: ".$connection->error);
            }

            //read data of each row
            while($row = $result->fetch_assoc()){
                echo"<tr>
                <td>". $row["title"]."</td>
                <td>". $row["artist"]."</td>
            </tr>";
            }
            ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table-responsive table-hover table-dark" style="width: 270px;">
                    <thead>
                        <tr>
                            <th style="color:#2EAC6D;">Title</th>
                            <th style="color:#2EAC6D;">Artist</th>
                            
                        </tr>
                    </thead>
                    <tbody>
            <?php

            $user = $_SESSION["username"];
            
            //read all row from database table
            // $sql="SELECT * FROM spotify_top_100_2019";
            // $q="SELECT * FROM favorite WHERE lagu IN (SELECT title FROM spotify_top_100_2019 WHERE user)";
            // $q="SELECT a.lagu FROM favorite a WHERE a.lagu IN (SELECT b.title,b.id_genre FROM spotify_top_100_2019 b  IN (SELECT c.genre FROM genre c WHERE b.id_genre = c.id ))";
            
            $q="SELECT * FROM spotify_top_100_2019 s WHERE s.id_genre IN (SELECT id_genre FROM spotify_top_100_2019 WHERE title IN( SELECT lagu FROM favorite WHERE username ='".$_SESSION["username"]."')) AND s.title NOT IN (SELECT lagu FROM favorite WHERE username ='".$_SESSION["username"]."')";
            
            $result=$connection->query($q);

            if(!$result){
                die("Invalid query: ".$connection->error);
            }

            //read data of each row
            while($row = $result->fetch_assoc()){
                echo"<tr>
                <td>". $row["title"]."</td>
                <td>". $row["artist"]."</td>
                </tr>";
            }
            ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>


</body>

</html>