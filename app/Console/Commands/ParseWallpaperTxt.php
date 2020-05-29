<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
		}else{
			$set = 'none';
			$release_date = 'none';
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

		$this_wallpaper = \App\wallpaper::updateOrCreate(['art_name' => $art_title],
									$fill_data);
		
		foreach($urls as $this_url){
			$name = 'something';

			$this_wallpaper_url = \App\wallpaper_url::create([
								'wallpaper_id' => $this_wallpaper->id,
								'wallpaper_url_name' => $name,
								'wallpaper_url' => $this_url
							]);
			$this_wallpaper_url->save();
		}

	}
	

	$this->info('script end.');

    }
}
