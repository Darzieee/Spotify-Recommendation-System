<?php
    include "db.php";
    $lang=$_POST["lang"];
    for ($i=0;$i<count($lang);$i++)
    {
        echo $lang[$i];
    }
    echo "<br/>";
    echo "username ".$_SESSION["username"];
    //print_r($lang);

    $username=mysqli_real_escape_string($connection,$_SESSION["username"]);
    $q="DELETE FROM favorite WHERE username='$username'";
    mysqli_query($connection,$q);


    for ($i=0;$i<count($lang);$i++)
    {
        $q="INSERT INTO favorite (username,lagu) VALUES ('$username','".mysqli_real_escape_string($connection,$lang[$i])."') ";
        mysqli_query($connection,$q);
    }


?>
<script>
    window.location.assign("index.php");
</script>