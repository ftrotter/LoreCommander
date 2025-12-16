<?php

$clean_up_commands = [
	"composer clear-cache > /dev/null 2>&1", //make composer see the new files
	"composer dump-autoload > /dev/null 2>&1", //and refresh the composer cache...
	"php artisan cache:clear",
	"php artisan route:clear",
	"php artisan config:clear ",
	"php artisan view:clear",

];

	//for the cleanup commands, we just want them to silently run... so we use exec without an echo
	foreach($clean_up_commands as $this_command){
		//echo "Running: $this_command\n";
		exec($this_command,$output,$return_status);
		
		//DURC tries to respect error codes for returned status.. so this works as expected.
		if($return_status > 0){ //then it retueded an error!!
			echo "Error: $this_command failed... returned $return_status stopping\n";
			exit(100);
		}
	}

echo "clean up tasks finished. all done\n";
