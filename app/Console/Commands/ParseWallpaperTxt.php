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

	}


	$this->info('script end.');

    }
}
