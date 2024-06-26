<?php
include('dbconnection.php');
$msg = ""; // Initialize $msg

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['location'])){
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$location = mysqli_real_escape_string($con, $_POST['location']);
	
	mysqli_query($con, "INSERT INTO appointment(name, email, mobile, location) VALUES('$name', '$email', '$mobile', '$location')");
	$msg = "Thank you";
	
	$html = "<table>
				<tr><td>Name</td><td>$name</td></tr>
				<tr><td>Email</td><td>$email</td></tr>
				<tr><td>Mobile</td><td>$mobile</td></tr>
				<tr><td>Location</td><td>$location</td></tr>
			</table>";
	
	include('smtp/PHPMailerAutoload.php');
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->SMTPSecure = "tls";
	$mail->SMTPAuth = true;
	$mail->Username = "poovisoft@gmail.com";
	$mail->Password = "Poovi@1997";
	$mail->SetFrom("poovisoft@gmail.com");
	$mail->addAddress("poovisoft@gmail.com");
	$mail->IsHTML(true);
	$mail->Subject = "New Contact Us";
	$mail->Body = $html;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => false
		)
	);
  $mail->SMTPDebug = 2; // Enable verbose debug output
	try {
    if($mail->send()){
        echo $msg;
    } else {
        echo "Mail could not be sent.";
    }
} catch (phpmailerException $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome 6.5.2 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha384-ZJfY7Pf7XJcQp/4UuMcUarj4m8EPVcL3EyE4v2YI2md4LClG0C3RfhczV6q9vznA" crossorigin="anonymous">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="post" action="" id="frmcontact">
            <div class="row">
                <h4>Get In Touch</h4>
                <div class="input-group input-group-icon">
                    <input type="text" name="name" id="name" placeholder="Full Name" required />
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                    <span class="error"></span>
                </div>
                <div class="input-group input-group-icon">
                    <input type="email" name="email" id="email" placeholder="Email Address" required />
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <span class="error"></span>
                </div>
                <div class="input-group input-group-icon">
                    <input type="number" name="mobile" id="mobile" placeholder="Mobile No" required />
                    <div class="input-icon"><i class="fa fa-phone"></i></div>
                    <span class="error"></span>
                </div>
                <div class="input-group input-group-icon">
                    <input type="text" name="location" id="location" placeholder="Location" required />
                    <div class="input-icon"><i class="fa fa-map-marker"></i></div>
                    <span class="error"></span>
                </div>
            </div>
            <div class="form-button">
                <button type="submit" name="submit" id="submit">Submit</button>
                <span style="color:red;" id="msg"><?php echo $msg; ?></span>
            </div>
        </form>
    </div>

    <script>
        jQuery('#frmcontact').on('submit', function(e) {
            e.preventDefault();
            jQuery('#submit').html('Please wait').attr('disabled', true);
            jQuery.ajax({
                url: 'form.php',
                type: 'post',
                data: jQuery('#frmcontact').serialize(),
                success: function(result) {
                    jQuery('#msg').html(result);
                    jQuery('#submit').html('Submit').attr('disabled', false);
                    jQuery('#frmcontact')[0].reset();
                }
            });
        });
    </script>
</body>
</html>
