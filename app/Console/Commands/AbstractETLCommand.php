<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

abstract class AbstractETLCommand  extends Command
{


	protected function run_sql_loop($sql, $is_echo_full_sql = false, $start_time = null){
	
		//we need raw database access. No reason to go through Eloquent.
		$pdo = DB::connection()->getPdo();

		//sometimes we want to start the timer for the whole process...
		//but if we do not, then lets just run the timer for the sql loop...
		if(is_null($start_time)){
			$start_time = microtime(true);
		}


		if(!is_array($sql)){
			//we do not actually want to crash in this case...
			$initial_sql = $sql; //save this for later..
			$sql = [];
			$sql[] = $initial_sql; //later has arrived... and now we have an array of sql commands... 
		}

		$total_steps = count($sql); 

		$current_step = 1;

		//time to loop over the SQL!!
		foreach($sql as $comment => $this_sql){

			if(is_array($this_sql)){
				echo "AbstratctETLCommand:run_sql_loop Error: the sql must be a flat array of comments => sql commands... this has a sub array, which we cannot handle.\n";
				exit(1); //return failure...
			}

			$this_sql = trim($this_sql); //no excess whitespace please...
			if(strlen($this_sql) > 0){
					//then this comment in the sql actually has text that we should run as sql
				//we always echo the status and the comment	
				echo "Status $current_step of $total_steps)\t\t$comment\n";
				if($is_echo_full_sql){
					//we we are developing it is useful to see the sql in the logs...
					echo "Running $this_sql\n";
				}
				
				$rows_affected = $pdo->exec($this_sql);
					
				if($rows_affected === false){	
					//then we had an error...
					$error_array = $pdo->errorInfo();
					echo "Error: SQL Failed with:\n";
					foreach($error_array as $error_part){
						echo "\t$error_part\n";
					}
					exit(1);
				}

				echo "SQL Executed without error. Rows Affected: $rows_affected \n";
				
			}else{
				//then this is just a key.. 
				// not anything to do... it just means that $sql['something'] = ''; 
				//was left as a note for the next step... we just echo those 'something' out...
				echo "No SQL for: $comment\n";

			}
		}

	}

}
