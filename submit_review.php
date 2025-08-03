<?php
session_start();
require_once("connection.php");
$conn = Connect();

$car_id = $_POST['car_id'];
$username = $_POST['username'];
$rating = $_POST['rating'];
$comment = mysqli_real_escape_string($conn, $_POST['comment']);

$sql = "INSERT INTO reviews (car_id, username, rating, comment) 
        VALUES ('$car_id', '$username', '$rating', '$comment')";

if (mysqli_query($conn, $sql)) {
    header("Location: booking.php?car_id=$car_id&review=success");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
