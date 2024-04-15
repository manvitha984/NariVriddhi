<?php
// Connect to MySQL server
$mysqli = new mysqli("localhost", "root", "", "user_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch existing posts from the database
$sql = "SELECT * FROM posts";
$result = $mysqli->query($sql);

// Generate HTML content for each post
$html = "";
while ($row = $result->fetch_assoc()) {
    $html .= "<div class='blog'>";
    $html .= "<h2>" . $row['title'] . "</h2>";
    $html .= "<p class='author'>Author: " . $row['author'] . "</p>";
    $html .= "<p>" . $row['content'] . "</p>";
    $html .= "</div>";
}

// Output the HTML content of existing posts
echo $html;

// Close database connection
$mysqli->close();
?>
