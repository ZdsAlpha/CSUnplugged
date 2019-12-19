<?php
session_start();
//error_reporting(E_ERROR | E_PARSE);
require_once('main.php');
if (!isset($_GET["id"])){
    exit();
}
$db = connect_db();
$query = "SELECT * FROM activities WHERE id=".$_GET["id"];
if ($result = $db -> query($query)) {
    $row = $result->fetch_assoc();
    $title = $row["title"];
    $intro = $row["intro"];
    $instruct = $row["instruct"];
    $skills = $row["skills"];
    $video = $row["video"];
}else{
    echo "Database error!";
}
$db -> close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php
            echo $title;
        ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script type="text/javascript" src="data.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content" style="width: 1000px;">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="mb-4">
                    <?php
                        echo $title;
                    ?>
                    </h3>
                    <div id="list">
                        <div class="card">
                            <div class="card-header" style="text-align: left;">
                                <h5 class="mb-0">
                                    <a class="t-title" href="#!" data-toggle="collapse" data-target="#collapse" aria-expanded="true">Introduction</a>
                                </h5>
                            </div>
                            <div id="collapse" class="card-body collapse" style="text-align: left;">
                                <p class="t-description">
                                <?php
                                    echo nl2br($intro);
                                ?>
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="text-align: left;">
                                <h5 class="mb-0">
                                    <a class="t-title" href="#!" data-toggle="collapse" data-target="#collapse1" aria-expanded="true">Instructions</a>
                                </h5>
                            </div>
                            <div id="collapse1" class="card-body collapse" style="text-align: left;">
                                <p class="t-description">
                                <?php
                                    echo nl2br($instruct);
                                ?>
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="text-align: left;">
                                <h5 class="mb-0">
                                    <a class="t-title" href="#!" data-toggle="collapse" data-target="#collapse3" aria-expanded="true">Skills Required</a>
                                </h5>
                            </div>
                            <div id="collapse3" class="card-body collapse" style="text-align: left;">
                                <p class="t-description"><?php
                                    echo nl2br($skills);
                                ?>
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="text-align: left;">
                                <h5 class="mb-0">
                                    <a class="t-title" href="#!" data-toggle="collapse" data-target="#collapse2" aria-expanded="true">Demonstration</a>
                                </h5>
                            </div>
                            <div id="collapse2" class="card-body collapse" style="text-align: center;">
                                <video width="720" height="480" controls>
                                    <source src="
                                    <?php
                                        echo $video;
                                    ?>
                                    " type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
