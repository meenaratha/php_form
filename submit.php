<?php
include('dbconnection.php');
$msg = ""; // Initialize $msg

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['location'])){
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
	$location = mysqli_real_escape_string($con, $_POST['location']);
	
	mysqli_query($con, "INSERT INTO contact_us(name, email, mobile, location) VALUES('$name', '$email', '$mobile', '$location')");
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
	if($mail->send()){
		// Mail sent
	} else {
		// Error occurred
	}
	echo $msg;
}
?>
