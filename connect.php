<?php
// Capture form data
$firstName = $_POST['firstName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$gender = $_POST['gender'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$number = $_POST['number'] ?? '';

// Database connection
$conn = new mysqli('localhost', 'root', '', 'test');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");

// Check if prepare() failed
if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

// Bind parameters (assuming number should be treated as a string)
$stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $password, $number);

// Execute the statement and check if it was successful
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
