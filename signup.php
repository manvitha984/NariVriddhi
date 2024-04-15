<?php
// Establish connections to the databases
$connUser = mysqli_connect("localhost", "root", "", "user_db");
$connLogin = mysqli_connect("localhost", "root", "", "user_db");

// Check the connections
if (!$connUser || !$connLogin) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $Email = mysqli_real_escape_string($connUser, $_POST['Email']);
    $User = mysqli_real_escape_string($connUser, $_POST['Username']);
    $Phone_no = mysqli_real_escape_string($connUser, $_POST['Phone_no']);
    $Set_Pwd = md5($_POST['Set_Pwd']);
    $Confirm_Pwd = md5($_POST['Confirm_Pwd']);

    // Check if the email already exists in the user_form table
    $checkEmailQuery = "SELECT * FROM user_form WHERE Email = '$Email'";
    $result = mysqli_query($connUser, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'Email already exists!';
    } else {
        // Check if passwords match
        if ($Set_Pwd !== $Confirm_Pwd) {
            $error[] = 'Passwords do not match!';
        } else {
            // Insert username and password into the logindetails table
            $insertQuery = "INSERT INTO logindetails (Username, Password) VALUES ('$User', '$Set_Pwd')";

            if (mysqli_query($connLogin, $insertQuery)) {
                header('location: login.php');
                exit();
            } else {
                $error[] = 'Error: ' . mysqli_error($connLogin);
            }
        }
    }
}

mysqli_close($connUser);
mysqli_close($connLogin);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        <div class="profile-container signup-container">
        <h1 style="padding-left:300px;">Sign-up</h1><br>
            <form id="signup-form" method="post" action="" style="padding-left: 200px;">
            <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    }
                }
                ?>
                <label for="email" style="font-size: 20px;">E-mail:</label>
                <input type="email" id="email" name="Email" required style="margin-left: 120px; height:20px;">
                <br><br>
                <label for="username" style="font-size: 20px;">Username:</label>
                <input type="text" id="username" name="Username" required style="margin-left: 90px; height:20px;">
                <br><br>
                <label for="phno" style="font-size: 20px;">Phone Number:</label>
                <input type="text" id="phno" name="Phone_no" required style="margin-left: 56px; height:20px;">
                <br><br>
                <label for="password" style="font-size: 20px;">Set password:</label>
                <input type="password" id="password" name="Set_Pwd" required style="margin-left: 67px; height:20px;">
                <br><br>
                <label for="cpassword" style="font-size: 20px;">Confirm password:</label>
                <input type="password" id="cpassword" name="Confirm_Pwd" required style="margin-left: 30px; height:20px;">
                <br><br><br>
                <button class="hero-btn" type="submit" name="submit" style="font-size: 20px; margin-left: 120px;">Submit</button>
            </form>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>
