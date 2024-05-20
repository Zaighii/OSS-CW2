<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");

// Check if the form is submitted for deleting records
if(isset($_POST['delete'])) {
    foreach($_POST['checkbox'] as $id) {
        // Delete selected student records from the database
        $sql = "DELETE FROM student WHERE studentid='$id'";
        $result = mysqli_query($conn, $sql);
    }
}

// Retrieve all student records from the database
$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Start building the HTML table and form
    echo "<form method='post'>";
    echo "<table border='1'>";
    echo "<tr><th></th><th>Student ID</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Image</th></tr>";
    
    // Loop through each row of the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Output data for each student record with checkboxes
        echo "<tr>";
        echo "<td><input type='checkbox' name='checkbox[]' value='" . $row['studentid'] . "'></td>";
        echo "<td>" . $row['studentid'] . "</td>";
        
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['dob'] . "</td>";
        echo "<td>" . $row['house'] . "</td>";
        echo "<td>" . $row['town'] . "</td>";
        echo "<td>" . $row['county'] . "</td>";
        echo "<td>" . $row['country'] . "</td>";
        echo "<td>" . $row['postcode'] . "</td>";

        echo "<td><img src='" . $row['image_path'] . "' alt='Student Image' style='width: 100px; height: auto;'></td>";
        echo "</tr>";
    }
    
    // Close the HTML table and form
    echo "</table>";
    echo "<input type='submit' name='delete' value='Delete Selected'>";
    echo "</form>";
} else {
    echo "No student records found.";
}

// Close the database connection
mysqli_close($conn);

?>
