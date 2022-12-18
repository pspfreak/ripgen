<?php

// Include the database connection file
include 'support/connect.php';

// random number function
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}

// Function to check the uniqueness of an ID
function checkUniqueID($identifier) {
    global $conn;
    // Execute a SELECT query to check if there is an existing record with the same ID
    $query = "SELECT * FROM entry WHERE Identifier = '$identifier'";
    $result = mysqli_query($conn, $query);
    // If a record is found, return false
    if (mysqli_num_rows($result) > 0) {
        return false;
    }
    // Otherwise, return true
    return true;
}
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $name = $_POST['name'];
    $y1 = $_POST['y1'];
    $y2 = $_POST['y2'];
    $msg = $_POST['msg'];
	
    // Create a unique identifier for the entry
    $identifier = generate_string($permitted_chars, 6);

    // Check if the ID is unique
    while (!checkUniqueID($identifier)) {
        // If the ID is not unique, generate a new one
        $identifier = generate_string($permitted_chars, 6);
    }

    // Get the client's IP address
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    // Sanitize the data to prevent XSS attacks
    $name = htmlspecialchars($name);
    $y1 = htmlspecialchars($y1);
    $y2 = htmlspecialchars($y2);
    $msg = htmlspecialchars($msg);

    // Prepare the SQL statement
    $sql = "INSERT INTO entry (Identifier, IP, datetime, name, y1, y2, message) VALUES (?, ?, NOW(), ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt, 'sssiis', $identifier, $ip, $name, $y1, $y2, $msg);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);
	
	header('Location: '. $identifier);
	exit;
}
?>

	
<!DOCTYPE html>
<html>
<head>
<?php require 'support/head.php' ?>
</head>
<body>
<?php require 'support/nav.php' ?>
    <div class="container section" id="gen" >
	<h2>Welcome to the <s>LennyCrew</s> pspfreak.xyz RIP Generator!</h2>
	<h4>Offically brought back from the dead! To begin, fill out the textboxes below. When you are finished, click submit, and enjoy. Page is ready for direct linking.</h4>
     <form action="gen.php" method="post">      
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input name="name" required="" type="text" size="30"></td>
                </tr>
                <tr>
                    <td>Year 1:</td>
                    <td><input name="y1" required="" type="text" maxlength="6" size="30"></td>
                </tr>
                <tr>
                    <td>Year 2:</td>
                    <td><input name="y2" required="" type="text" maxlength="6" size="30"></td>
                </tr>
                <tr>
                    <td>Message:</td>
                    <td><input name="msg" required="" type="text" size="30"></td>
                </tr>
                <tr>
                <td colspan="2"> 
                 <input type="checkbox" name="terms" value="yes"> I agree to the that my IP is logged for abuse purposes.
                </td>
                <tr>
                    <td colspan="2"><center><input name="submit" type=
                    "submit" value="Submit" id="submit"></center></td>
                </tr>
            </table>
            </form>

        </div>
<?php require 'support/footer.php' ?>
</body>
</html>



