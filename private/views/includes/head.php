<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if(isset($css['estructura'])){
            echo "<link rel=\"stylesheet\" href=\"".URLROOT."/public/css/estructura.css\">";
        }
        if(isset($css['login'])){
            echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/login.css\">";
        }
        if(isset($css['tablas'])){
            echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/tablas.css\">";
        }
        if (isset($css['form'])) {
            echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/form.css\">";
        }
        // if($css['']){
        // }
    ?>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Exo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title><?php SITENAME ?></title>
</head>

<body>