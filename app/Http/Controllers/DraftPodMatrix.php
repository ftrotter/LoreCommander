<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DraftPodMatrix  extends Controller
{

	public function show_matrix(){



		$all_pod_sizes = [
			6,7,8,9,10,11,12

		];

		$good_pod_sizes = [
			6,8,10
			];




		echo "<pre>";
		for($i = 1; $i <= 100; $i++){
				
			echo "$i total players\n";

			if(in_array($i,$good_pod_sizes)){
				echo "\t\tThis is an even pod of $i\n";
			}
			
			$results = [];
			foreach($all_pod_sizes as $this_size){
				$is_good_size = false;

				if(in_array($this_size,$good_pod_sizes)){
					$is_good_size = true;
				}
				
				$remainder = $i % $this_size; 
				$division = $i / $this_size; 				
			

				if($division > 1){
					$pod_count = floor($division);

					if($remainder == 0){
						if($this_size == 8){
							$results['perfect'][] = "\t\t$i is a perfect number with $pod_count pods of $this_size and one pod of size $remainder\n";			
						}else{
							$results['great'][] = "\t\t$i is a great number with $pod_count pods of $this_size and one pod of size $remainder\n";			
						}
					}else{

						if(
							in_array($remainder,$good_pod_sizes) || (
							$is_good_size && in_array($remainder,$all_pod_sizes))
							){
							$results['good'][] = "\t\t$i is a good number with $pod_count pods of $this_size and one pod of size $remainder\n";		
						}
					}
					
				}
		
			}

			if(isset($results['perfect'])){
				echo $results['perfect'][0];
			}else{
				var_export($results);
			}
		}


	}

	private function is_whole_number($number){
		return($number == intval($number));
	}


}
