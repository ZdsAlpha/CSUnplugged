<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
require_once('main.php');
if (!isset($_SESSION["username"])){
    echo "-1";
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files'])) {
        $errors = [];
        $path = 'videos/';
        $extensions = ['mp4'];
        $all_files = count($_FILES['files']['tmp_name']);
        if ($all_files == 0){
            echo "-1";
            exit();
        }
        for ($i = 0; $i < $all_files; $i++) {
            $file_name = $_FILES['files']['name'][$i];
            $file_tmp = $_FILES['files']['tmp_name'][$i];
            $file_type = $_FILES['files']['type'][$i];
            $file_size = $_FILES['files']['size'][$i];
            $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i])));

            $file = $path . $file_name;

            if (!in_array($file_ext, $extensions)) {
                echo "-1";
                exit();
            }

            if ($file_size > 1048576000) {
                echo "-1";
                exit();
            }
            move_uploaded_file($file_tmp, $file);
        }
        $db = connect_db();
        $title = urldecode($_SERVER['HTTP_TITLE']);
        $intro = urldecode($_SERVER['HTTP_INTRODUCTION']);
        $instruct = urldecode($_SERVER['HTTP_INSTRUCTIONS']);
        $skills = urldecode($_SERVER['HTTP_SKILLS']);
        $user = $_SESSION["username"];
        $query = "INSERT INTO activities (user,title,intro,instruct,skills,video) VALUES ('$user','$title','$intro','$instruct','$skills','$file')";
        if ($result = $db -> query($query)) {
            echo "1";
        }
        else {
            echo "-1";
        }
        $db -> close();
    }
}
?>