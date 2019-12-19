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
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
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
                        <h3 class="mb-4">Login</h3>
                        <div class="input-group mb-3">
                            <input class="form-control" placeholder="Username" required="" name="username">
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" class="form-control pwd" placeholder="Password" required="" name="password">
                        </div>
                        <button class="btn btn-primary shadow-2 mb-4" style="background: rgb(29, 191, 115);border-color: rgb(29, 191, 115);width: 100px;">Login</button>
                        <?php
                            if ($_POST["username"] && $_POST["password"]){
                                $db = connect_db();
                                if ($db -> connect_errno){
                                    echo "<h4 style='color: red;'>".$db -> connect_error."!</h4>";
                                }
                                else {
                                    $query = "SELECT * FROM users WHERE user='".$_POST["username"]."' AND pass='".$_POST["password"]."'";
                                    $result = $db -> query($query);
                                    if ($result -> num_rows == 0){
                                        echo "<h4 style='color: red;'>Username or password incorrect!</h4>";
                                    }
                                    else {
                                        echo "<h4 style='color: green;'>User logged in!</h4>";
                                        $row = $result->fetch_assoc();
                                        $_SESSION["username"] = $row["user"];
                                        $_SESSION["admin"] = "".$row["admin"];
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
