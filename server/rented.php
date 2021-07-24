<?php
session_start();
require("./database.php");

$user = $_SESSION['id'];

$query = "SELECT * FROM peartv.rentedmovies WHERE user='$user' AND DATEDIFF(NOW(), rented_to) < 0 ORDER BY rented_date ASC; ";

$result = $conn->query($query);

if($result->num_rows == 0){
    echo "Brak wypożyczonych filmów";
    return [];
}else{
    $rows = array();
    while($r = mysqli_fetch_assoc($result)){
        $rows[] = $r;
    }
    echo json_encode($rows);
    return ;
}