<?php
// Make a MySQL Connection
($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost",  "admin",  "redacted")) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . ripdb)) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));

// Get all the data from the "?rgang" table
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ripgen") 
or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));  

echo "<table border='1'>";
echo "<tr> <th>ID</th> <th>IP</th> <th>Terms</th> <th>Name</th> <th>Message</th> <th>Year 1</th> <th>Year 2</th> <th>Condolences URL</th> <th>Song URL</th> <th>Background URL</th></tr>";
// keeps getting the next row until there are no more to get
while($row = mysqli_fetch_array( $result )) {
    // Print out the contents of each row into a table
    echo "<tr><td>"; 
    echo "<a href='https://rip.lennycrew.com/rip?id=" . $row['id'] . "'>" . $row['id'] . "</a>";
    echo "</td><td>"; 
    echo $row['ip'];
    echo "</td><td>"; 
    echo $row['terms'];
    echo "</td><td>"; 
    echo $row['name'];
    echo "</td><td>"; 
    echo $row['msg'];
    echo "</td><td>"; 
    echo $row['y1'];
    echo "</td><td>";
    echo $row['y2'];
    echo "</td><td>"; 
    echo "<a href='" . $row['curl'] . "'>" . $row['curl'] . "</a>";
    echo "</td><td>"; 
    echo $row['sid'];
    echo "</td><td>"; 
    echo "<a href='" . $row['bgurl'] . "'>" . $row['bgurl'] . "</a>";
    echo "</td></tr>"; 
} 

echo "</table>";
?>