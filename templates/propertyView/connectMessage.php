<?php

$date = $_POST['date'];
$image = $_POST['image'];
$title = $_POST['title'];
$text = $_POST['text'];
$property_id = $_POST['property_id'];

$conn = new mysqli('localhost', 'devuser', 'devpass', 'csba_db');

if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
} else {
    $date = '28.07.2021';

    $sql =
        "INSERT INTO news (date, image, title, text, property_id) 
values ('$date','$image', '$title', '$text', '$property_id')";

    if ($conn->query($sql)) {
        echo 'New record is inserted successfully';
        header('refresh:2;url=../propview/');
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }
    $conn->close();
}

?>

