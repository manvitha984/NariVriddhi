<?php
// Establish a connection to the database
$conn = mysqli_connect("localhost", "root", "", "user_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login_btn'])) {
    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    $Password = md5($_POST['Password']); // Assuming passwords are stored as MD5 hashes

    $sql = "SELECT * FROM logindetails WHERE Username = '$Username' AND Password = '$Password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Login successful
        header('Location: home2.html');
        exit();
    } else {
        echo "<script>alert('Login unsuccessful');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
      .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
      }
      </style>
</head>
<body>
<section class="header">
        <nav style="padding-top: 30px;">
        <img style="width: 250px; margin-left: 85px;" src="imgs/nvt1.png">
        <a href="index.html"></a>
        <div class="nav-links" id="navLinks">
            <i class="fa fa-times" onclick="hidemenu()"></i>
            <ul>
                <li><a href="index.html" style="font-size: 20px;">HOME</a></li>
                <li><a href="signup.php" style="font-size: 20px;">REGISTER</a></li>
                 <li><a href="login.php" style="font-size: 20px;">LOGIN</a></li>
            </ul>
        </div>
        <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>
        <div class="profile-container">
        <h1 style="margin-left:350px;">Login</h1><br><br>
            <form id="login-form" method="post" action="" style="padding-left: 200px;">
                <label for="username" style="font-size: 20px;">Username:</label>
                <input type="text" id="Username" name="Username" style="margin-left: 60px; height:20px;">
                <br><br>
                <label for="password" style="font-size: 20px;">Password:</label>
                <input type="password" id="Password" name="Password" style="margin-left: 63px; height:20px;">
                <br><br>
                <!-- <a href="home2.html" class="hero-btn" style="font-size: 20px; margin-left: 120px;">Login
            </a> -->
                <input class="hero-btn" type="submit" value="Login" class="logBtn hero-btn" name="login_btn" style="font-size: 20px; margin-left: 120px;">
            </form>
        </div>
    </section>


    <script src="script.js"></script>
</body>
</html>

