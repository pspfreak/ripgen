<!DOCTYPE html>
<html>
<head>
<?php require 'support/head.php' ?>
</head>
<body>
<?php require 'support/nav.php' ?>
<div class="container section" style="color:white;">
<?php
require 'support/connect.php';

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM entry");

// Execute the statement
$stmt->execute();

// Bind the result to a variable
$result = $stmt->get_result();

// Fetch the result as an associative array
$query = array();
while($query[] = $result->fetch_assoc());
array_pop($query);

// Output a dynamic table of the results with column headings.
echo '<table border="1">';
echo '<tr>';
foreach($query[0] as $key => $value) {
    echo '<td>';
    echo htmlspecialchars($key); // Sanitize the column heading
    echo '</td>';
}
echo '</tr>';
foreach($query as $row) {
    echo '<tr>';
    foreach($row as $key => $column) {
        if ($key == 'Identifier') { // Output the identifier column as a link
            echo '<td><a href="'.htmlspecialchars($column).'">'.htmlspecialchars($column).'</a></td>'; // Sanitize the identifier
        } else {
            echo '<td>';
            echo htmlspecialchars($column); // Sanitize the other columns
            echo '</td>';
        }
    }
    echo '</tr>';
}
echo '</table>';

// Close the statement
$stmt->close();

?>
</div>
<?php require 'support/footer.php' ?>
  </body>
</html>