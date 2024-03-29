<?php
    session_start();
    //error_reporting(E_ERROR | E_PARSE);
    require_once('main.php');
    if (!isset($_SESSION["username"])){
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CS Unplugged</title>
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
                    <h3 class="mb-4">Upload Activity</h3>
                    <div class="card-body" style="text-align: left;">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Activity Title">
                        </div>
                        <div class="form-group">
                            <label>Introduction</label>
                            <textarea class="form-control" id="introduction" placeholder="Activity Introduction" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Instructions</label>
                            <textarea class="form-control" id="instructions" placeholder="Activity Instructions" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Skills Required</label>
                            <textarea class="form-control" id="skills" placeholder="Activity Skills" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Video</label>
                            <div class="custom-file">
                                <input id="file" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                           </div>
                        </div>
                        <div style="width: 100%; text-align: right;">
                            <button class="btn btn-primary" id="submit-button">Submit</button>
                        </div>
                        <div class="form-group">
                            <h4 id="message" style="color: red;"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="upload.js"></script>
</body>
</html>
