<?php
include('dbconnection.php');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $location = $_POST['location'];

    // Validate input
    if(empty($name) || empty($email) || empty($mobile) || empty($location)) {
        echo "<script>alert('All fields are required.')</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.')</script>";
    } else {
        // Prepare and bind
        $stmt = $con->prepare("INSERT INTO appointment (name, email, mobile, location) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $mobile, $location);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Data inserted successfully.')</script>";
            
            // Prepare the email
            $to = $email;
            $subject = "Appointment Confirmation";
            $message = "Hello $name,\n\nYour appointment details are as follows:\n\nName: $name\nEmail: $email\nMobile: $mobile\nLocation: $location\n\nThank you!";
            $headers = "From: meenatchipkr@gmail.com";

            // Send the email
            if(mail($to, $subject, $message, $headers)) {
                echo "<script>alert('Data inserted successfully and email sent.')</script>";
            } else {
                echo "<script>alert('Data inserted successfully but email not sent.')</script>";
            
        }


        } else {
            echo "<script>alert('Error inserting data.')</script>";
        }

        // Close the statement
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php form</title>
    <link rel="stylesheet" href="style.css">
     <!-- Font Awesome 6.5.2 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha384-ZJfY7Pf7XJcQp/4UuMcUarj4m8EPVcL3EyE4v2YI2md4LClG0C3RfhczV6q9vznA" crossorigin="anonymous">
</head>
<body>
</head>
<body>
   
<div class="container">
  <form method="post" action="">
    <div class="row">
      <h4>Get In Touch</h4>
      <div class="input-group input-group-icon">
        <input type="text" name="name" id="name" placeholder="Full Name"/>
        <div class="input-icon"><svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></div>
        <span class="error"></span>
    </div>
     
      <div class="input-group input-group-icon">
        <input type="email" name="email" id="email" placeholder="Email Adress"/>
        <div class="input-icon"><svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></div>
        <span class="error"></span>  
    </div>
      <div class="input-group input-group-icon">
        <input type="number" name="mobile" id="mobile" placeholder="Mobile No"/>
        <div class="input-icon"><svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M16 64C16 28.7 44.7 0 80 0H304c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H80c-35.3 0-64-28.7-64-64V64zM224 448a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM304 64H80V384H304V64z"/></svg></div>
        <span class="error"></span>  
    </div>
      <div class="input-group input-group-icon">
        <input type="text" name="location" id="location" placeholder="Location"/>
        <div class="input-icon"><svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg></div>
        <span class="error"></span>  
    </div>
    </div>
    <!-- <div class="row">
      <div class="col-half">
        <h4>Date of Birth</h4>
        <div class="input-group">
          <div class="col-third">
            <input type="text" placeholder="DD"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="MM"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="YYYY"/>
          </div>
        </div>
      </div>
      <div class="col-half">
        <h4>Gender</h4>
        <div class="input-group">
          <input id="gender-male" type="radio" name="gender" value="male"/>
          <label for="gender-male">Male</label>
          <input id="gender-female" type="radio" name="gender" value="female"/>
          <label for="gender-female">Female</label>
        </div>
      </div>
    </div> -->
    <div class="form-button">
       <button type="submit" name="submit">Submit</button> 
        </div>
  </form>
</div>



</body>
</html>