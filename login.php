<! DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title> LOGIN SPOTIFY</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="spotify.css">
    </head>

    <?php
	session_start();

    require_once "vendor/autoload.php";
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = ($_POST['username']);
            $password = ($_POST['password']);
            $pass_hash = md5($password);

            

            $_SESSION['username'] = $username;
		    $_SESSION['password'] = $password;
            

                if(empty($username)){
                    die("invalid username");
                }

                if(empty($password)){
                    die("Enter your password");
                }

                $con = new MongoDB\Client("mongodb://localhost:27017");

                // Select Database
                if($con){
                    $db = $con->user;
                    // Select Collection
                    $collection = $db->dbuser;
                    $qry = $collection->find(array('username' => $username));
                    $result = $collection->findOne($qry);

                    foreach($qry as $userFind) {
                        $storedUsername = $userFind['username'];
                        $storedPassword = $userFind['password'];
                    }

                    if($username==$storedUsername && $password==$storedPassword){
                        echo "You are successfully loggedIn";
                        ?>
                        <script>
                            window.location.assign("index.php");
                        </script>
                            
                        <?php
                    }else{
                        echo "Wrong combination of username and password";
                    }
                }
                else
                {
                    die("Mongo DB not connected!");
                }
}
?>

    <style>
        html {
            height: 100%;
        }

        body {
            height: 100%;
            background: linear-gradient(90deg, #000 0%, #5B5656 50%, #2EAC6D 100%);
        }

        .global-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
        }

        form {
            padding-top: 5px;
            font-size: 14px;
            margin-top: 5px;
        }

        .card-title {
            font-weight: 300;
        }

        .btn {
            font-size: 14px;
            margin-top: 20px;
        }

        .login-form {
            width: 330px;

            background-color: #393E46;
        }

        .sign-up {
            text-align: center;
            padding: 20px 0 0;
        }

        .alert {
            margin-bottom: -30px;
            font-size: 13px;
            margin-top: 20px;
        }
    </style>

    <body>
        <div class="pt-5">
            <center>
                <img src="SpotifyLogo.png" alt="" style="height:150; width:260; margin-right:0.5cm;">
                <div class="card login-form">
                    <div class="card-body">

                        <div class="card-text">
                            <form action="login.php" method="POST">
                                <div class="form-group">
                                    <b><label for="exampleInputEmail1" style="color:#2EAC6D;"> Username </label></b>
                                    <input type="text" class="form-control form-control-sm" id="username"
                                        name="username" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <b><label for="exampleInputPassword1" style="color:#2EAC6D;">Password </label></b>

                                    <input type="password" class="form-control form-control-sm" id="password"
                                        name="password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-success" style="width: 100%;">Sign
                                    In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </center>
    </body>

    </html>