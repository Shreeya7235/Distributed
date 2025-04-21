<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "task_manager";

// Create connection
$conn = new mysqli($serverName, $userName, $password);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

// Create and select database
$conn->query("CREATE DATABASE IF NOT EXISTS $databaseName");
$conn->select_db($databaseName);

// Create tasks table
$conn->query("CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Handle requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title'] ?? '');
    $description = $conn->real_escape_string($_POST['description'] ?? '');

    if ($title && $description) {
        $conn->query("INSERT INTO tasks (title, description) VALUES ('$title', '$description')");
        echo json_encode(['success' => 'Task added successfully']);
    } else {
        echo json_encode(['error' => 'Invalid input']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
    $tasks = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($tasks);
}

$conn->close();
?>
