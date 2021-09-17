<?php

namespace App;

/*
	Given the way the internet works I expect that someday, someone from scryfall.com or WoTC is going to eventually look at this file. 
Just wanted to say thanks for the amazing API, and the amazing game. Both have gien me hours of peace and mental calm. 
Its not just any thing that can keep 100% of my attention for hours at a time. I sometimes have lots of difficult problems on my mind and they can be hard to set aside.
but MTG and hacking on MTG data works. So thanks for the amazing stuff. 

This will be open source, so to whomever is reading this. 
The scraping here is intentionally very slow, please respect the scryfall.com rate limit rules.  


*/


class  ScryfallAPI {
/*
	Gets all of the card sets..
*/
	public static function getAllSets(){


		$url = "https://api.scryfall.com/sets";

		$results = ScryfallAPI::getAllAnything($url);

		return($results);

	}
/*
	Gets all the cards in a given set.
*/
	public static function getAllCardsInSet($set_code){

		$set_search = urlencode("set:$set_code unique:prints");

		$url = "https://api.scryfall.com/cards/search?q=$set_search";

		$results = ScryfallAPI::getAllAnything($url);

		return($results);

	}


/*
	This function knows how to use curl to properly page through the results and merge them all together...
	best not to feed it too much at once tho..
	since it will get all the data from the given url
	because recursion.
*/
	public static function getAllAnything($url,$page_id = 1){

		//slow down.
		sleep(1);

	
		if(strpos($url,'?') !== false){
			//then the page is just one of a set of arguments... 
			$full_url = $url . "&page=$page_id";
		}else{
			//then the page is the first argument to tack on the end of the url	
			$full_url = $url . "?page=$page_id";
		}

		$page_size = 175; //the size for the cards paging is the size for all the things...


		//$full_url = $url;
    		$ch= curl_init($full_url);

		$headers = [];
    		curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
    		curl_setopt($ch,CURLOPT_HTTPGET,TRUE);
    
    		$response= curl_exec($ch);
    		$info= curl_getinfo($ch);
    		curl_close($ch);
    
    		if($info['http_code']==200){
			$this_data = json_decode($response,true);
			if(is_null($this_data)){
				echo "Error: nothing in this_data..\n";
				var_export($this_data);
				return([]);
			}
			if(is_null($this_data['data'])){
				echo "Error: nothing in the data field..\n";
				var_export($this_data);
				return([]);
			}
			if(count($this_data['data']) == $page_size){
				//get the next page of data..
				$new_page = $page_id +  1;
				echo "Recursive Calling $new_page page of the data for $url \n";
				$new_data = ScryfallAPI::getAllAnything($url,$new_page);
				$all_data = array_merge($new_data,$this_data['data']);
				return($all_data);
			}
			return($this_data['data']);
    		}else{

			//it is possible to page past the end of the results and get a 422 status error
			///this just means that there is no more data...

			if($info['http_code'] == 422){
				//here we just return an empty array.
				return([]); 
			}


        		echo "Response : $response";
        		echo "Request not successful. Response code : ".$info['http_code']." <br>";
			echo "tried to get $full_url\n";
			exit();
    		}


	}


}
