<?php
		
$myfile = fopen("Tokens.txt", "r") or die("Unable to open file!");
		list($tok,$sid) = explode(",",chop(fgets($myfile)),2); // chop() is a must because fgets() returns new line character
		fclose($myfile);
		if($sid == $_POST["sessionid"])
		
		{
			
			echo $tok;
		}
		else
			echo 'Invalid token';
			exit();
			


  ?>