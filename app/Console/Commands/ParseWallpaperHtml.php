<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ParseWallpaperHtml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scry:parse_wallpaper_html {html_file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save the HTML to the full wallpaper page from W of the C and then use this to mine the wallpaper links';

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

	$dom = new \DOMDocument();

	libxml_use_internal_errors(true);
	$dom->loadHTMLFile($file_name);
	libxml_clear_errors();

	$xpath = new \DOMXpath($dom);
	$wallpaper_divs = $xpath->query("//div[contains(@class,'wallpaper')]");

	foreach($wallpaper_divs as $this_div){

		$h3_tags = $this_div->getElementsByTagName('h3');
		foreach($h3_tags as $this_h3){
			$card_name = $this_h3->textContent;
			$this->info("processing $card_name");
		}
		if($h3_tags->length > 1){
			if($card_name == 'MORE WALLPAPERS TO COME!'){
				//this is the last div and it is special and not a problem
			}else{
				$this->error("Too many h3 tags with $card_name");
				exit();
			}
		}
		$this->info('between');
		$p_tags = $this_div->getElementsByTagName('p');

		$p_tag_array = []; //its just easier to work with...
		foreach($p_tags as $this_p){
			$p_tag_array[] = $this_p;
			$this->info($this_p->textContent);
		}	


	}


	$this->info('script end.');

    }
}
