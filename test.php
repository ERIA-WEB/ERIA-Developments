<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8"> 
<title>Azure file read/write test</title> 
</head> 

<body> 
<?php 
 
//phpinfo( ); 
 
echo "<h1>Azure storage test</h1>\n"; 

$txt = date('m-d-Y h:i:s a', time());  
echo "Current date/time: "; 
echo $txt . "<p>\n"; 

// Write test 

$myfile = fopen("test.txt", "a") or die("Unable to open file for write!"); 
fwrite($myfile, $txt . "\n"); 
echo "Current date/time is successfully written to file.<br>"; 
fclose($myfile); 

// Read test 

$myfile = fopen("test.txt", "r") or die("Unable to open file for read!"); 
echo "Current log file content is successfully read: <p>"; 
while ($line = fgets($myfile)) { 
   echo $line . "<br>\n"; 
} 

fclose($myfile); 

?>
 
</body> 
</html> 