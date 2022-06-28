<?php
            
            session_start();
            $servername="localhost";
            $username="root";
            $password="";
            $database="spotify";
                        //create connection
            $connection=new mysqli($servername,$username,$password,$database);
?>