<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");

// Execute the SQL script to insert student records
$sql = "
    INSERT INTO student (studentid, password, firstname, lastname, DOB, house, town, county, country, postcode) 
    VALUES
    ('20000000', 'test', 'John', 'Doe', '1995-05-15', '123 Main St', 'Anytown', 'Anycounty', 'United Kingdom', 'AB1 2CD'),
    ('20000001', 'test', 'Jane', 'Smith', '1996-08-20', '456 Elm St', 'Othertown', 'Othercounty', 'United Kingdom', 'EF3 4GH'),
    ('20000002', 'test', 'Michael', 'Johnson', '1997-11-25', '789 Oak St', 'Somewhere', 'Somestate', 'United Kingdom', 'IJ5 6KL'),
    ('20000003', 'test', 'Emily', 'Williams', '1998-02-10', '1011 Pine St', 'Nowhere', 'Nowherecounty', 'United Kingdom', 'MN7 8OP'),
    ('20000004', 'test', 'David', 'Brown', '1999-04-05', '1213 Cedar St', 'Anywhere', 'Anywherecounty', 'United Kingdom', 'QR9 0ST')
";

// Insert student records into the database
$result = mysqli_query($conn, $sql);

// Check if the insertion was successful
if ($result) {
    echo "Student records inserted successfully!<br>";
} else {
    echo "Error inserting student records: " . mysqli_error($conn) . "<br>";
}

// Close the database connection
mysqli_close($conn);

?>
