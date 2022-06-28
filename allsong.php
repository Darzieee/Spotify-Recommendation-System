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

    <h1 style="color:#FFF;">All Song</h1>
<div class="container">
<form method="POST" action="simpanlagu.php">
<table  class="table-responsive table-hover table-dark table-fixed " style="width: 500px;">
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
            
            $user=$_SESSION["username"];
            $fav="SELECT title,artist FROM spotify_top_100_2019";
            $res=mysqli_query($connection,$fav);


            //read all row from database table
            $sql="SELECT * FROM spotify_top_100_2019";
            $result=$connection->query($sql);

            if(!$result){
                die("Invalid query: ".$connection->error);
            }

            
            $username=mysqli_real_escape_string($connection,$_SESSION["username"]);
                
            //read data of each row
            while($row = $result->fetch_assoc()){
                $checked="";
                $q="SELECT * FROM favorite WHERE username='$username' AND lagu='".mysqli_real_escape_string($connection,$row["title"])."'";
                
                $res2=mysqli_query($connection,$q);
                if ($row2=mysqli_fetch_assoc($res2))
                {
                    $checked="checked";
                }

                echo"<tr>
                <td><input $checked type=\"checkbox\" name='lang[]' value=\"". $row["title"]."\">". $row["title"]."</td>
                <td>". $row["artist"]."</td>
                </tr>";
                
                if(isset($_POST['submit'])){

                    if(!empty($_POST['lang'])) {
                
                        foreach($_POST['lang'] as $value){
                            echo "value : ".$value.'<br/>';
                        }
                
                    }
                }
                // echo $checked;
                // if(!empty($_POST['lang'])){
                //     foreach($_POST['lang'] as $value){
                //         echo "value : ".$value.'<br/>';
                //     }
                // }
                // if (isset($_POST['lang']) && $_POST['lang'] == true) 
                // {
                //     echo $row;
                // }
                // if($row= mysqli_fetch_assoc($res)){
                //     echo $row["title"];
                //     echo $row["artist"];
                // }
            }
            ?>
        </tbody>
    </table>

    <input type="submit" class="btn btn-success" value="Submit" name="submit" style="float:right; margin-right:469px; margin-top:10px;">

</form>
</div>



</body>

</html>