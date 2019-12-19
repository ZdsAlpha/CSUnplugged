<?php
    session_start();
    //error_reporting(E_ERROR | E_PARSE);
    require_once('main.php');
    if ($_SESSION["username"]){
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="controller.js"></script>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <form method="POST">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="feather icon-unlock auth-icon"></i>
                        </div>
                        <h3 class="mb-4">Register</h3>
                        <div class="input-group mb-3">
                            <input id="username" type="text" class="form-control" placeholder="Username" required="" name="username">
                        </div>
                        <div class="input-group mb-3">
                            <input id="fn" type="text" class="form-control" placeholder="First Name" required="" name="fn">
                            <input id="ln" type="text" class="form-control" placeholder="Last Name" required="" name="ln">
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control pwd" placeholder="Password" required="" name="password">
                        </div>
                        <button class="btn btn-primary shadow-2 mb-4" style="background: rgb(29, 191, 115);border-color: rgb(29, 191, 115);width: 100px;">Register</button>
                        <?php
                            if ($_POST["username"] && $_POST["fn"] && $_POST["ln"] && $_POST["password"]){
                                $db = connect_db();
                                if ($db -> connect_errno){
                                    echo "<h4 style='color: red;'>".$db -> connect_error."!</h4>";
                                }
                                else {
                                    $query = "SELECT * FROM users WHERE user='".$_POST["username"]."'";
                                    $result = $db -> query($query);
                                    if ($result -> num_rows == 0){
                                        $query = "INSERT INTO users VALUES ('".$_POST["username"]."','".$_POST["fn"]."','".$_POST["ln"]."','".$_POST["password"]."',0)";
                                        if ($result = $db -> query($query)) {
                                            echo "<h4 style='color: green;'>Registered!</h4>";
                                            $_SESSION["username"] = $_POST["username"];
                                            $_SESSION["admin"] = "0";
                                        }
                                        else{
                                            echo "<h4 style='color: green;'>Registration Failed!</h4>";
                                            echo "<h4 style='color: red;'>".$query."</h4>";
                                        }
                                    }
                                    else {
                                        echo "<h4 style='color: red;'>User already exists!</h4>";
                                    }
                                }
                                $db -> close();
                            }
                            else{
                                echo "<h4 style='color: green;'>Enter details!</h4>";
                            }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>