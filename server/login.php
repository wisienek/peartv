<?php
session_start();
require('./database.php');

$email =        isset($_POST['email'])? $_POST['email']         : null;
$password =     isset($_POST['password'])? $_POST['password']   : null;
$rejestruj =    isset($_POST['rejestruj'])? $_POST['rejestruj'] : null;
$name =         isset($_POST['name'])? $_POST['name']           : null;
$surname =      isset($_POST['surname'])? $_POST['surname']     : null;
$birth =        isset($_POST['birth'])? $_POST['birth']         : null;


if($rejestruj === "tak"){

    if(($password == null || strlen($password) < 4) || ($email == null || !filter_var($email, FILTER_VALIDATE_EMAIL)) || ( $name == null || strlen($name) < 3 || $name != clean($name) ) || ( $surname == null || strlen($surname) < 3 || $surname != clean($surname) ) || ($birth == null || strtotime(date("Y-m-d")) - strtotime($birth) < 0 ) ){
        echo "Za mało danych lub dane nie spełniają wymagań!";
        return header("HTTP/1.1 500 Internal Server Error");
    }

    $hashed = password_hash($password, PASSWORD_BCRYPT);

    $sql = "SELECT id FROM Customers WHERE email='$email';";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        echo "Jest już użytkownik z takim mailem!";
        return header("HTTP/1.1 500 Internal Server Error");
    }

    $sql = "INSERT INTO Customers(email, password, name, surname, birth) VALUES('$email', '$hashed', '$name', '$surname', '$birth');";

    if($conn->query($sql) === TRUE){
        $sql = "SELECT * FROM Customers WHERE email='$email';";
        $result = $conn->query($sql);
        
        if($result->num_rows == 0){
            echo "Coś poszło nie tak";
            return header("HTTP/1.1 500 Internal Server Error");
        }

        $row = $result->fetch_assoc();

        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['surname'];
        $_SESSION['birth'] = $row['birth'];

        echo "Zarejestrowano!";
        return header("Location: http://localhost/peartv/profile.php");
    }else{
        return "ERROR: ".$conn->error;
    }


}else{
    $sql = "SELECT * FROM Customers WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows == 0){
        echo "Nie ma użytkownika z takim mailem!";
        return header("HTTP/1.1 500 Internal Server Error");
    }
    $row = $result->fetch_assoc();

    if(password_verify($password, $row['password'] )){
        echo "Zalogowano!";

        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['surname'];
        $_SESSION['birth'] = $row['birth'];

        header("Location: ../profile.php");
        return;
    }else{
        echo "Niepoprawne hasło!";
        return header("HTTP/1.1 500 Internal Server Error");
    }

    return header("HTTP/1.1 500 Internal Server Error");
}



function clean($string) {
    $string = str_replace(' ', '-', $string); 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
}