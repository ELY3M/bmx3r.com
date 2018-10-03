<?

$femail = $_GET['femail'];
$temail = $_GET['temail'];


$date = date("D, m-d-y");
$time = date("g:i A");
$ip=getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$referer=getenv("HTTP_REFERER");
$agent=getenv("HTTP_USER_AGENT");


$headers = "From: \"" . $femail . "\" <" . $femail . ">\r\n";
$headers .= "Reply-To: \"" . $femail . "\" <". $femail .">\r\n";
$headers .= "X-Priority: 1\r\n";
$headers .= "X-MSMail-Priority: High\r\n";
$headers .= "X-Mailer: OutLook\n";
$headers .= 'MIME-Version: 1.0' . "\n";

$subject = "Email read by ".$_GET['temail'];
$body = "$temail read email at $time on $date\n";
$body .= "$ip ($hostname)\n";
$body .= "$agent\n";
$body .= "$referer\n";

mail($femail, $subject, $body, $headers);
header('Location: image.gif');

?>
