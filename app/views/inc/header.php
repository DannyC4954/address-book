<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/css/stylesheet.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Playfair+Display&display=swap" rel="stylesheet">
    <title><?php echo $data["title"];?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?php echo URLROOT;?>/js/main.js"></script>
  </head>
  <body>
    <header>
      <div class="nav">
        <div class="nav-part">
          <a class="logo" href="<?php echo URLROOT;?>">Address Book</a>
        </div>
        <div class="nav-part right mt-2">
          <a class="nav-option" href="<?php echo URLROOT;?>">Home</a>
          <a class="nav-option" href="<?php echo URLROOT;?>/add">Add</a>
          <img class="st-icon menu" src="<?php echo URLROOT;?>/img/icons/hamburger.png" />
        </div>
      </div>
      <div class="side-bar">
        <div class="exit">
          <img class="close-icon" src="<?php echo URLROOT;?>/img/icons/close.png" />
        </div>
        <div class="options">
          <a href="<?php echo URLROOT;?>">Home</a>
          <a href="<?php echo URLROOT;?>/add">Add</a>
        </div>
      </div>
    </header>
    <section>
