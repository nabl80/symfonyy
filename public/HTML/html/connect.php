<?php

$name = $_POST['name'];
$surname = $_POST['surname'];
$agency = $_POST['agency'];
$website = $_POST['website'];
$country = $_POST['country'];
$email = $_POST['email'];
$password = $_POST['password'];

$conn = new mysqli('localhost', 'devuser', 'devpass', 'csba_db');

if (mysqli_connect_error()) {
    exit('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
} else {
    $hashed = hash('sha512', $password);
    $sql =
        "INSERT INTO agency (name, surname, agency, website, country, email, password) 
values ('$name','$surname', '$agency', '$website', '$country', '$email', '$hashed')";

    if ($conn->query($sql)) {
        echo 'New record is inserted successfully';
        header('refresh:2;url=../index.html');
    } else {
        echo 'Error: '.$sql.'<br>'.$conn->error;
    }
    $conn->close();
}

?>

