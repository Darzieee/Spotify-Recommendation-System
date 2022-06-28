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
            <a href="index.php">
                <li class="brand"><i class="fab fa-spotify"></i> Spotify</li>
            </a>
        </ul>
    </div>

    <h1 style="color:#FFF;">Favourite</h1>
    
    <table class="table table-hover table-dark" style="width: 500px;">
        <thead>
            <tr>
                <th style="color:#2EAC6D;">Title</th>
                <th style="color:#2EAC6D;">Artist</th>
            </tr>
        </thead>
        <tbody>
                <tr>

                    <?php
                        $username=mysqli_real_escape_string($connection,$_SESSION["username"]);
                        $q="SELECT * FROM spotify_top_100_2019 WHERE title IN (SELECT lagu FROM favorite WHERE username='$username')";
                        $res=mysqli_query($connection,$q);

                        while ($row=mysqli_fetch_assoc($res))
                        {
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                            echo $row["title"];
                                        ?>
                                    </td>
                                    <td>
                                    <?php
                                            echo $row["artist"];
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }
                        //get post value
                        // if(isset($_POST['choose']))
                        // {
                        //     echo $letter =  $_POST['choose']; //get check box value
                        // }
                    ?>
            </table>
        </tbody>
    </table>


</body>

</html>