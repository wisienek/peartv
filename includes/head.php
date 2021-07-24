<?php
    session_start();
    if(!isset($_SESSION['id'])){
        return header("Location: index.html");
    }
?>

<!DOCTYPE html>
<html lang="pl" style="height: 100vh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PearTV</title>

    <link rel="stylesheet" href="./includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="./includes/css/main.css">
    <script src="./includes/js/jquery.js" ></script>
    <script src="./includes/js/bootstrap.bundle.min.js"></script>
    <style>
        body{
            background-image: url("./includes/img/pear.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PearTV</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="profile.php" id="home">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="movies.php" id="movies">Movies</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="list.php" id="myList">My list</a>
          </li>
        </ul>
      </div>
      <a href="server/logout.php" style="color: white">Wyloguj</a>
    </div>
</nav>