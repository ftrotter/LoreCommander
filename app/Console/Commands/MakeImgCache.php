<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App;

class MakeImgCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scry:img';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download local copies of scryfall images and convert them to useful sizea for icons';

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
        
		//downloading everything takes too much space
                $urls_to_hash = [
                  //    'image_uri_small'  => 'image_hash_small',
                        'image_uri_normal'  => 'image_hash_normal',
                    //    'image_uri_large' => 'image_hash_large',
                    //    'image_uri_png' => 'image_hash_png',
                        'image_uri_art_crop'  => 'image_hash_art_crop',
                  //      'image_uri_border_crop'  =>'image_hash_border_crop',
                ];

		//this is just a test for valid img urls overall... we are not nessecarily just getting the image_uri_large fields...
		$all_cardfaces = \App\cardface::where('image_uri_large', 'like', '%-%')->get();

		foreach($all_cardfaces as $this_cardface){
	
			//ensures that the md5 hashes for cards are correct...
			$this_cardface->save();
	
			foreach($urls_to_hash as $this_url => $img_hash){
				//this is the md5 of this url... 
				$this_hash = $this_cardface->$img_hash;
				$this_url = $this_cardface->$this_url;
				//echo "$this_url \n";
				$path = parse_url($this_url,  PHP_URL_PATH);
				//echo "$path\n";
				$path_parts = pathinfo($path);
				if(isset($path_parts['extension'])){
					$extension = $path_parts['extension'];
				}else{
					$extension = '';
				}
				$cache_file_name = "$this_hash.$extension";
				$img_path = base_path() . "/public/imgdata/original/$cache_file_name";
				if(!file_exists($img_path)){
					file_put_contents($img_path, file_get_contents($this_url));
					echo "saving $this_url locally to $img_path\n";
					sleep(1);
				}else{
					echo "skipping $this_url, already downloaded \n";
				}

			}
		}

    }

}
