<?php
// Connect to MySQL server
$mysqli = new mysqli("localhost", "root", "", "user_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Insert post into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $content = $_POST["content"];

    $sql = "INSERT INTO posts (title, author, content) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    // Check for errors in preparing the SQL statement
    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("sss", $title, $author, $content);
    $stmt->execute();

    // Check for errors in executing the SQL statement
    if ($stmt->errno) {
        die("Execution failed: " . $stmt->error);
    }

    $stmt->close();
}

// Fetch the newly added post
$newPostId = $mysqli->insert_id;
$sql = "SELECT * FROM posts WHERE id = $newPostId";
$result = $mysqli->query($sql);

// Construct the HTML for the new post
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $newPostHTML = '
        <h2>' . $row["title"] . '</h2>
        <p class="author">Author: ' . $row["author"] . '</p>
        <p>' . $row["content"] . '</p>
        <div class="comments" id="comments-post-' . $row["id"] . '">
            <!-- Dynamic comments for this post will be displayed here -->
        </div>
        <div class="add-comment">
            <form id="comment-form-' . $row["id"] . '" onsubmit="addComment(event, ' . $row["id"] . ')">
                <input type="hidden" name="post_id" value="' . $row["id"] . '">
                <input type="text" name="name" placeholder="Your Name" required><br>
                <textarea name="comment" placeholder="Add your comment" required></textarea><br>
                <button type="submit">Add Comment</button>
            </form>
        </div>';
    echo $newPostHTML;
}

$mysqli->close();
?>
