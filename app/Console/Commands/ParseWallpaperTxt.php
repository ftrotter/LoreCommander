<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ParseWallpaperTxt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scry:parse_wallpaper_txt {txt_file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save the full wallpaper page from W of the C as text file and then use this to mine the wallpaper links';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file_name = $this->argument('txt_file_name');

	if(!file_exists($file_name)){
		$this->error("Error: File does not exist. Looked in $file_name");
	}else{
		$this->info("File Exists.");
	}

	$file_array = file($file_name);
	$relevant_file_array = [];
	$is_header_done = false;

	foreach($file_array as $this_line){

		$this_line = trim($this_line);	
		if($this_line == 'Complete List of Wallpapers'){
			$is_header_done = true; //the good part has started right!!
		}

		if($is_header_done){
			if($this_line == 'MORE WALLPAPERS TO COME!'){
				//then the good part is over..
				break; //lets get out of this forloop... we have what we came for...
			}
			if(strlen($this_line) > 0){
				$relevant_file_array[] = $this_line;
			}
		}

	}

	//lets trim the fat a little more... by removing the first block which is header stuff..
	//lets also convert this into one large string at the same time..
	$file_string = '';
	$is_first_block_done =  false;
	foreach($relevant_file_array as $this_line){
		if(!$is_first_block_done){
			if($this_line == '*'){//this means the first block is done.. 
				$is_first_block_done = true; //from this point forward.. we will pay attenion!!
			}
		}else{
			$file_string .= "$this_line\n"; //we need to add a newline, because we previously trimmed...
		}
	}

	$wallpaper_blocks = explode('*',$file_string);

	foreach($wallpaper_blocks as $this_block){

		//we do not always get to have these... 
		$set = null;
		$release_date = null;

		$block_lines = explode("\n",$this_block);
		//not sure why there is a blank array element at $block_lines[0] but there sure is one.
		$blank_line = array_shift($block_lines);
		$art_title = array_shift($block_lines);
		$next = array_shift($block_lines); //sometimes there is no set and date... 

		$set_date_split_string = ") "; //the set and date section takes the form '(set) 01/01/2000' which makes ') ' the seperator between the two data points..

		if(strpos($next,$set_date_split_string)){
			list($set, $release_date) = explode($set_date_split_string,$next); //the set and date section takes the form '(set) 01/01/2000' which makes ') ' the seperator between the two data points..
			$set = substr($set,1); //remove the leading '(' from this string..
			$next = array_shift($block_lines);
		}

		//now we are at the author..
		$author = $next;
		$author = substr($author,3); //remove the 'By ' characters from the author string...

		//uncomment this to see progress..
		//echo " art=$art_title\n set=$set\n release_date=$release_date\n author=$author\n";

		//from here, its easier just to extract the urls using a regex
		$rest_of_block = implode('   ',$block_lines);

		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $rest_of_block, $match);

		$urls = $match[0];
		$mysql_date = date("Y-m-d", strtotime($release_date)); 

		$fill_data = [
			'art_name' => $art_title,
			'set_name' => $set,
			'art_release_date' => $mysql_date,
			'author_name' => $author,
		];


		$list_of_url_names = [
			'tablet' => 'Tablet',
			'facebook' => 'Facebook',
			'iphone' => 'iPhone',
			'ipad' => 'iPad',
			'twitter' => 'Twitter',
			'mobile' => 'Mobile',
			'gameinfo' => 'Gameinfo',
			'wallpapermobile' => 'Mobile',
			'wallpapertablet' => 'Tablet',
			'wallpaperfacebook' => 'Facebook',
			'facebookcover' => 'Facebook',
			'wallpapertwitter' => 'Twitter',
			'twitterheader' => 'Twitter',
			'wallpaper2560x1600' => '2560x1600',
			];

		$this_wallpaper = \App\wallpaper::updateOrCreate(['art_name' => $art_title],
									$fill_data);


		$bad_url_list = [
			'https://media.magic.wizards.com/images/wallpaper/Ob-Nixilis',
			'https://media.magic.wizards.com/images/wallpaper/Look-at-Me',
			'https://media.magic.wizards.com/images/wallpaper/Karametra',
			];


		foreach($urls as $this_url){

			if(in_array($this_url,$bad_url_list)){
				//this is not real...
				continue;
			}

			if(strpos(strtolower($this_url),'://media.magic.wizards.com') !== false){ //who cares about other urls? all facebook and twitter and nonesense

				//the standard process for getting a file name out of a url...
				$path = parse_url($this_url, PHP_URL_PATH);
				$path_parts = pathinfo($path);
				$just_filename_no_extension = $path_parts['filename'];
				$full_filename = $path_parts['basename'];

				//but the MTG files are helpfully segmented with underscore...
				$file_segments = explode('_',$just_filename_no_extension);

				//we need a default if one of our two methods fails...
				$name = 'Unknown Size';

				$is_highest_resolution = 0 ; //has to be the starting assumption..

				foreach($file_segments as $this_segment){
					//first we test to see if there is valid named segment
					foreach($list_of_url_names as $this_name){
						if(array_key_exists(strtolower($this_segment),$list_of_url_names)){
							//these means that it was facebook, or twitter or whatever...
							$name = $list_of_url_names[strtolower($this_segment)];
						}
					}
					//then we test for a simension like: 2560x1600
					//here is the regular expression that matches that pattern, thanks https://stackoverflow.com/a/31809994/144364
					if(preg_match("/([0-9]+x[0-9]+)/",strtolower($this_segment))) {
						$name = strtolower($this_segment); //not sure what it is, but it takes the screen dimension pattern and it works for the name!!
					}


					if($name == '2560x1600'){ //we know that when these appear, they are the highest res
						$is_highest_resolution = 1;
					}
					
				}


				if(count($urls) == 1){
					//then this is automatically the highest resolution
					$is_highest_resolution = 1;
				}


				//calculate the local path...
				$dir = base_path() . "/public/wallpapers/";

				$file_destination = $dir . $full_filename; //this is where the local copy goes

				if(!file_exists($file_destination)){
					//and if we have not downloaded it already... here it goes...
					file_put_contents($file_destination, fopen($this_url, 'r'));
				}

				$this_wallpaper_url = \App\wallpaper_url::updateOrCreate(['wallpaper_url' => $this_url], [
								'wallpaper_local_path' => $file_destination,
								'wallpaper_id' => $this_wallpaper->id,
								'wallpaper_url_name' => $name,
								'is_highest_resolution' => $is_highest_resolution,
							]);

				$this_wallpaper_url->save();
			}
		}

	}
	
	echo "\n";
	$this->info('script end.');

    }
}
