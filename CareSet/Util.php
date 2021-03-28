<?php
namespace CareSet;

/*
	These are CareSet utility for things that CareSet php scripts are going to need across projects..
	Basically it a series of static functions in an a class to get a namespace...
	Call it like
	CareSetUtil::something_something($an_arg, $another_arg);

	This class should never be instantiated. All of the functions are static.
	This class does rely on Laravel Helpver functions... specificall the env function

*/


//this class generates the SQL from the schema model that is generated in CSVTools
class Util
{




	//accepts either a full file name or a full path... will convert full paths tojust file names to work on them properly..
	//RIF strings in dirctory names, (etc) do not matter..
	//this file does not validate if the path exists on the disk, etc etc..
	public static function mineValidRIFString($file_path_or_name){

		if(strpos($file_path_or_name,'/') !== false){
			//then this is a file_path
			$path_parts = pathinfo($file_path_or_name);
			$file_name = $path_parts['basename'];
		}else{
			//then this is a file name.
			$file_name = $file_path_or_name;
		}

		


	}

/*
	calls healthchecks.io and will throw an appropriate error if the envirornment variable needed to do so is not set.
	Usage: at the very end of the file, add something like the following: 

	        $hping_result = \CareSet\Util::hping('YOUR_HPING');
                $this->info($hping_result);

	where YOUR_HPING is set to a healthchecks.io url that exists in your .env file. 

*/

	public static function hping($hping_url_env_var, $is_fail = false, $exit_code = 0){
	$env_dir = __DIR__.'/..';

	try {
    		$dotenv = \Dotenv\Dotenv::create($env_dir)->load();
	} catch (\Dotenv\Exception\InvalidPathException $e) {
    		echo $e;
	}


		echo "About to use env() to look for $hping_url_env_var\n";
		$hping_url = env($hping_url_env_var,-1);

		if($hping_url == -1){
			echo "The env returned the default, is it working at all?\n";
			exit();
		}		
		

                if(is_null($hping_url) || strlen($hping_url) < 10){
                        $error_msg = "hping Error: $hping_url_env_var not set in .env\n";
                        throw new \Exception($error_msg);
                }else{
			//if we get here then the environment variable is set..
			if (filter_var($hping_url, FILTER_VALIDATE_URL) !== false){
				//this looks like a basically good hping_url...

				//OK, but did we succeed?
				if($is_fail){ //leveraging https://healthchecks.io/docs/signaling_failures/
					if($exit_code != 0){
						//then we are going to leverage the ability of hping to track error codes
						$hping_url = "$hping_url/$exit_code";
					}else{
						//then this is a generic fail, 
						$hping_url = "$hping_url/fail";
					}		
					file_get_contents($hping_url);
					return("hping fail. Failed to finish correctly");	
				}else{
	                        	file_get_contents($hping_url);
                        		return ("hping hit. all done.");  //this should be the only place where this phrase exists
				}
			}else{
				//if we get here then hping env variable is set, but it is not avalid url..
				$error_msg = "hping Error: $hping_url does not validate as a url better check the value in the .env file ";
                        	throw new \Exception($error_msg);
			}

                }


	}

}

