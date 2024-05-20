<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentid = $_POST['studentid'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $house = $_POST['house'];
    $town = $_POST['town'];
    $county = $_POST['county'];
    $country = $_POST['country'];
    $postcode = $_POST['postcode'];

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $message = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $message = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $image_path = $target_file;

            // Build and execute the SQL statement to insert student details into the database
            $sql = "INSERT INTO student (studentid, password, firstname, lastname, DOB, house, town, county, country, postcode, image_path) 
                    VALUES ('$studentid', '$password', '$firstname', '$lastname', '$dob', '$house', '$town', '$county', '$country', '$postcode', '$image_path')";

            $result = mysqli_query($conn, $sql);

            // Check if the insertion was successful
            if ($result) {
                $message .= " Student record inserted successfully!";
            } else {
                $message .= " Error inserting student record: " . mysqli_error($conn);
            }
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <h2>Add Student</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
        <label for="studentid">Student ID:</label><br>
        <input type="text" id="studentid" name="studentid" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" required><br><br>
        
        <label for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" required><br><br>
        
        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" required><br><br>
        
        <label for="house">House:</label><br>
        <input type="text" id="house" name="house" required><br><br>
        
        <label for="town">Town:</label><br>
        <input type="text" id="town" name="town" required><br><br>
        
        <label for="county">County:</label><br>
        <input type="text" id="county" name="county" required><br><br>
        
        <label for="country">Country:</label><br>
        <input type="text" id="country" name="country" value="United Kingdom" required><br><br>
        
        <label for="postcode">Postcode:</label><br>
        <input type="text" id="postcode" name="postcode" required><br><br>

        <label for="fileToUpload">Upload Image:</label><br>
        <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
        
        <input type="submit" value="Submit">
    </form>

    <?php echo $message; ?>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
