

<!--
Directory Index Script 
(Salmun Kazerounian, Jon Rifkin - 2004)

This script allows the user to view the contents
of the script directory and those below.

Input:  Current directory *relative* to script directory.
        The directory is checked to insure that it
        is *really* under the parent directory, thus
        the user cannot manipulate the directory display
        by including ".." in the input.
Output: List of current directory contents with links
        to files and links to this script with arguments
        to view subdirectories.

HISTORY
2006-08-31 - Add SHOW_DOT=0 show files which start with '.' are not shown.
-->


<?php
#  Set to 1 to show files whose names start with '.'
$SHOW_DOT = 0;
?>


<!-- HTML HEADER -->
<html>
<style type="text/css">
img       { border: 0; padding: 0 2px; vertical-align: text-bottom;
margin-bottom: 2px;}
a         { font-family: monospace; text-decoration: none;
margin-bottom: 2px;}
a:link    { color: blue; }
a:visited { color: blue; }
a:hover   { background-color: #dddddd; }
</style>
</head>
<body>

<!-- LIST DIRS AND FILES -->
<?php
#  Name of this script (to be left out of directory listing)
$THIS_SCRIPT = getenv("SCRIPT_NAME");

#  Read path argument, if blank set to "."
$dir=$_GET['dir'];
if ($dir=="" || $dir==false) {
   $dir=".";
}

#  Determine absolute path (include trailing / if not blank)
$absdir = realpath($dir);
if ($absdir != "") {
   $absdir .= "/";
}

#  Directory where script lives (include trailing / if not blank)
$scriptdir = getcwd();
if ($scriptdir != "") {
   $scriptdir .= "/";
}

#  Insure that absolute dir is under the current directory
#  This prevents users from submitting a dir argument
#  that reaches outside the directory where this script resides.
$pos = strpos($absdir,$scriptdir);

if ($pos !== 0) {
   echo "<b>ERROR</b>: An invalid directory (<b>$dir</b>) was entered.";
   exit();
}

#  Get clean reldir (need for file and directory URLs)
$reldir = substr($absdir,strlen($scriptdir));

#  Refresh PHP's (OS's ?) file and directory list cache
clearstatcache();

#  Read directories and files in current directory
$handle  = opendir($absdir);
while (false !== ($filename = readdir($handle))) 
{   
   #  Add directory to list
   if (is_dir($absdir."/".$filename)==true && $filename!=".") { $dirs[] = $filename; }
   #  Add file to list (omit this script)
   if (is_dir($absdir."/".$filename)==false && $filename!=$THIS_SCRIPT) {
      if ($SHOW_DOT || substr($filename,0,1)!=".") {
         $files[] = $filename;
      }
   }
}

#  Get parent directory unless current directory
#  is the same as the directory of this script.
$at_topdir = $absdir==$scriptdir;
if (! $at_topdir) {
   $absparentdir="";
   $subdirs=explode("/",$absdir);
   for($x=1;$x<=count($subdirs)-3;$x++) {
      $absparentdir.="/".$subdirs[$x];
   }
}

#  Get relative parent directory
$relparentdir = substr($absparentdir,strlen($scriptdir));

#  Sort file and directory list
if ($files) { sort($files); }
if ($dirs)  { sort($dirs); }

#  Show current directory
if ($reldir=="") {
   $showdir = ".";
} else {
   $showdir = $reldir;
}
echo "<i>Current Directory</i>:   <b>$showdir</b><br/><br/>\n";

#  Start display table
echo "<table border='0'><tr valign='top'>\n";


#  List parent directory if present
echo "<td align='left' width='100'>\n";
if ($at_topdir) {
   echo " \n";
} else {
   echo "<a href=\"$THIS_SCRIPT?dir=$relparentdir\"><img src=\"http://web.uconn.edu/folder.open.gif\">..</a>\n";
}
echo "</td>\n";

#  List directories if present
echo "<td align='left' width='200'>\n";
if ($dirs) {
   foreach($dirs as $name) {
      #  List child directory
      if ($name!="..") {
         echo "<a href=\"$THIS_SCRIPT?dir=$reldir$name\"><img src=\"http://web.uconn.edu/folder.gif\">$name</a><br/>\n";
      }
   }
} else {
   print " \n";
}
echo "</td>\n";

#  List files if present
echo "<td align='left' width='200'>\n";
if ($files) {
   foreach($files as $name) {
      #  Form relative path to file by removing leading /.
      echo "<a href=\"$reldir$name\"><img src=\"http://web.uconn.edu/file.gif\">$name</a><br/>\n";
   }
} else {
   print " \n";
}
echo "</td>\n";

#  Finish table
echo "</tr></table>\n";

?> 

</body>
</html>

