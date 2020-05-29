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
        $file_name = $this->argument('html_file_name');

	if(!file_exists($file_name)){
		$this->error("Error: File does not exist. Looked in $file_name");
	}else{
		$this->info("File Exists.");
	}

	$file_array = file($file_name);
	$relevant_file_array = [];
	$is_header = true;

	foreach($file_arary as $this_line){

		$this_line = trim($this_line);	
		if($this_line == 'Complete List of Wallpapers'){
			$is_header = false; //the good part has started right!!
		}

		if(!$is_header){
			if($this_line == 'MORE WALLPAPERS TO COME!'){
				//then the good part is over..
				break(); //lets get out of this forloop... we have what we came for...
			}

			$relevant_file_array[] = $this_line;

		}

	}

	foreach($relevant_file_array as $this_line){
		$this->info($this_line);
	}

	$this->info('script end.');

    }
}
