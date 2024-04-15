<?php
// Connect to MySQL server
$mysqli = new mysqli("localhost", "root", "", "user_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Insert comment into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $post_id = $_POST["post_id"];

    $sql = "INSERT INTO comments (name, comment, post_id) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    
    // Check for errors in preparing the SQL statement
    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("ssi", $name, $comment, $post_id);
    $stmt->execute();
    
    // Check for errors in executing the SQL statement
    if ($stmt->errno) {
        die("Execution failed: " . $stmt->error);
    }

    $stmt->close();
}

// Retrieve comments from the database
if (isset($_POST["post_id"])) {
    $sql = "SELECT name, comment FROM comments WHERE post_id = ?";
    $stmt = $mysqli->prepare($sql);
    $post_id = $_POST["post_id"];
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch and display comments
    while ($row = $result->fetch_assoc()) {
        echo "<div class='comment'>";
        echo "<p class='comment-author'>" . $row["name"] . "</p>";
        echo "<p>" . $row["comment"] . "</p>";
        echo "</div>";
    }

    $stmt->close();
}

$mysqli->close();
?>
