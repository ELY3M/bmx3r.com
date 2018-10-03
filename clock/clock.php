<html>
<head>
<title>My Clock :D</title>
<!--
<meta http-equiv="refresh" content="1; URL=clock.php">
-->
<?
$hours = date("h");
$minutes = date("i");
$seconds = date("s");
$ampm = date("a");
$hours1= substr("$hours", 0, 1);
$hours2 = substr("$hours", 1, 1);
$minutes1 = substr("$minutes", 0, 1);
$minutes2 = substr("$minutes", 1, 1);
$seconds1 = substr("$seconds", 0, 1);
$seconds2 = substr("$seconds", 1, 1);
/* AM or PM */
if($ampm == "am")
{
$time_ampm = "am.gif";
}
else
{
$time_ampm = "pm.gif";
}

/* hours*/
print "<img src=\"$hours1.gif\"><img src=\"$hours2.gif\"><img src=\"colon.gif\">";

/* minutes */
print "<img src=\"$minutes1.gif\"><img src=\"$minutes2.gif\"><img src=\"colon.gif\">";

/* seconds, and AM or PM */
print "<img src=\"$seconds1.gif\"><img src=\"$seconds2.gif\"><img src=\"$time_ampm\">";

?>


