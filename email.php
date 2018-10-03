<?php>
// save this code as a php file
// System0 Simple Email Form
// please visit http://www.system0.net/support_forums/ for help with this script.

// Change these values to suit your needs


$error_message="All fields must be completed"; // Change this error message to whatever you wish.

$youremailaddress="elym@mboca.com"; // the email address of where the message will be sent

?>


<form action="" method="post">
<!------ Ask for the details---------->

<BODY BGCOLOR="#000000" TEXT="blue" LINK="blue" VLINK="blue" ALINK="blue"></BODY><FONT FACE="fixedsys">

<p><center>

<FONT FACE="fixedsys">
Name: <input type="text" size=30 name="name"><br>
Email: <input type="text" size=30  name="email"><br>
Subject: <input type="text" size=30  name="subject"><br>
Text: <textarea name="message" cols="40" rows="5"></textarea><br>

<input type="submit" name="submit" value="Send">
<input type="reset" name="Reset" value="Reset">
</form>




<?php

$hostname = gethostbyaddr($REMOTE_ADDR);
$date = date("D, m-d-y");
$time = date("g:i A");


if ($submit) { // if the submit button was pressed

	if($name && $subject && $email && $message ) { //  if all fields were completed

		// check if email syntax is valid
		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email) )
		{

		  echo "The e-mail was not valid";

		}

		else {

			mail("$youremailaddress","$subject","$message \n\n IP: $REMOTE_ADDR ($hostname) \n $HTTP_USER_AGENT on $date at $time \n From: $HTTP_REFERER","From: $name <$email>") or die("email error");



			echo "<p>Your message has been sent";   // if all went well, display message was sent

		} // end of is email valid or not



	} // end of if all fields were completed

else {

echo "<br>$error_message<BR>"; // if not all were filled in, display error message
}


} // end php if statement


?>