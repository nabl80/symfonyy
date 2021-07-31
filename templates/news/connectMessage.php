<?php

$date = $_POST['date'];
$image = $_POST['image'];
$name = $_POST['name'];
$text = $_POST['text'];
$property = $_POST['property'];


$conn = new mysqli('localhost', 'devuser', 'devpass', 'csba_db');


if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
} else {
    $today = date("d.m.Y");
    $property=1;
    $sql =
        "INSERT INTO news (date, image, name, text, property) 
values ('$today','$image', '$name', '$text', $property)";

    if ($conn->query($sql)) {
        echo "New record is inserted successfully";
        header("refresh:2;url=../index.html");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

?>

