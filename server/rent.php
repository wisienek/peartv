<?php
session_start();
require("./database.php");


$id = $_GET['id'];
$user = $_SESSION['id'];


if(!isset($id) || $id == null || !isset($user)){
    echo "Nie podano id filmu do wypożyczenia!";
    return;
}

$query = "SELECT * FROM peartv.rentedmovies WHERE movie_id='$id' AND user='$user' AND DATEDIFF(NOW(), rented_to) < 0; ";

$result = $conn->query($query);

if($result->num_rows > 0){
    echo "Masz już wypożyczony ten film!";
    return;
}

$query = "INSERT INTO peartv.rentedmovies(user, movie_id, rented_date, rented_to) VALUES ($user, $id, now(), adddate(now(), 14));";

if($conn->query($query) === TRUE){
    echo "Dodano film do biblioteki!";
    return;
}else{
    return "ERROR: ".$conn->error;
}


