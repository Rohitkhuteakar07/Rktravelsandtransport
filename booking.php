<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $car = $_POST['car'];
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];
    $pickup_location = $_POST['pickup_location'];
    $drop_location = $_POST['drop_location'];

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

    $sql = "INSERT INTO booking (user_id, name, email, phone, car, pickup_date, return_date, pickup_location, drop_location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssss", $user_id, $name, $email, $phone, $car, $pickup_date, $return_date, $pickup_location, $drop_location);

    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
