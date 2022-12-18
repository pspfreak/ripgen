<?php

// Include the database connection file
include 'support/connect.php';

// Get the identifier from the URL
$identifier = isset($_GET['id']) ? $_GET['id'] : null;

// If the identifier is not set, select a random identifier from the database
if (!$identifier) {
    // Select a random identifier from the database
    $sql = "SELECT Identifier FROM entry ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $identifier = $row['Identifier'];
	header('Location: '. $identifier);
}

// Prepare a SQL statement to retrieve the data for the specified identifier
$sql = "SELECT name, y1, y2, message FROM entry WHERE Identifier = ?";
$stmt = mysqli_prepare($conn, $sql);

// Bind the identifier as a parameter to the statement
mysqli_stmt_bind_param($stmt, 's', $identifier);

// Execute the statement
mysqli_stmt_execute($stmt);

// Bind the results to variables
mysqli_stmt_bind_result($stmt, $name, $y1, $y2, $message);

// Fetch the data from the result set
mysqli_stmt_fetch($stmt);

// Close the statement
mysqli_stmt_close($stmt);

?>
<!DOCTYPE html>
<html>
<head>
<?php require 'support/head.php' ?>
<title>RIP <?php echo $name; ?></title>
</head>
<body>
<?php require 'support/nav.php' ?>
  <div id="index-banner" class="container">
    <div class="section no-pad-bot" style="text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; color: white;">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">RIP <?php echo $name; ?></h1>
		<h5 class="header center light"><?php echo $y1; ?> - <?php echo $y2; ?></h5>
        <div class="row center">
          <h5 class="header col s12 light"><?php echo $message; ?></h5>
        </div>
<div class="row center">
  <a href="gen.php" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Generate Your Own!</a>
</div>
<br><br>

</div>
</div>
    
  </div>
<?php require 'support/footer.php' ?>
  </body>
</html>
