<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SlowScrapeScryfall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scry:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs Scryfall to the local database ';

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

	$set_array = \App\ScryfallAPI::getAllSets();

	$set_code_list = [];
	foreach($set_array as $this_set){
		

		//these variables may not be in the scryfall json set object, and need to be zeroed out each time..
		$to_check = [
			'mtgo_code',
			'tcgplayer_id',
			'released_at',
			'block_code',
			'block',
			'parent_set_code',
		];

		foreach($to_check as $check_me){
			if(!isset($this_set[$check_me])){
				$this_set[$check_me] = null; //we want a placeholder
			}
		}

			

	
		$this_set['scryfall_id'] = $this_set['id'];
		$this_set['mtgset_uri'] = $this_set['uri'];
		$scryfall_id = $this_set['id'];

		//convert booleans to numbers because mysql
		if($this_set['foil_only']){
			$this_set['is_foil_only'] = 1;
		}else{
			$this_set['is_foil_only'] = 0;
		}

		if($this_set['nonfoil_only']){
			$this_set['is_nonfoil_only'] = 1;
		}else{
			$this_set['is_nonfoil_only'] = 0;
		}

		if($this_set['digital']){
			$this_set['is_digital'] = 1;
		}else{
			$this_set['is_digital'] = 0;
		}

		$this_set['is_digital'] = 0;
		$this_set['is_foil_only'] = 0;

		unset($this_set['id']); //we have our own id.
		unset($this_set['object']);//this is always 'set' and we do not care
		unset($this_set['uri']); //this variable name was too vauge
		unset($this_set['digital']);
		unset($this_set['foil_only']);
		unset($this_set['nonfoil_only']);

		if(isset($this_set['arena_code'])){
			$name = $this_set['name'];
			echo "Prepping for set \"$name\"\n";
		}


		$DURCmtgset = \App\mtgset::firstOrNew(['scryfall_id' => $scryfall_id]);
		$DURCmtgset->fill($this_set);
		$DURCmtgset->save();


		//prep for the next loop
		if($this_set['card_count'] > 0){ //apparently a set can be empty. Not sure the usefulness of this..
			$set_code_list[$DURCmtgset->id] = $this_set['code']; //we will use the to download the cards a set at a time in a moment		
		}
	}
	


	//some meta mapping data to help us map each card to the right local variables.

	$is_get_all = false;
	if($is_get_all){
		$sets = \App\mtgset::all();
	}else{
		$sets = \App\mtgset::whereYear('released_at',date('Y'))->get();

	}

	echo "Working on ".count($sets) . "total sets\n";

	sleep(5);

// 	this assumes we always want to do everything
//	foreach($set_code_list as $mtgset_id => $this_set_code){

	foreach($sets as $this_set_obj){
			
		$mtgset_id = $this_set_obj->id;
		$this_set_code = $this_set_obj->code;
	
		echo "Working on setcode:$this_set_code\n";

		$Dmtgset = \App\mtgset::find($mtgset_id);
		
		try {	
		$cards = \App\ScryfallAPI::getAllCardsInSet($this_set_code);
	
		\App\ScryfallSaver::saveCardList($cards);
		
		} catch (Exception $e) {
			echo "Failed to get cards for $this_set_code\n";
		}

	} //end of set loop.


	$this->call('scry:post_sync',[]); //call scry syn with no arguments... 

        $hping_result = \CareSet\Util::hping('HC_MAIN_SYNC_URL');
        $this->info($hping_result);
	
	$this->info('all done.');
    }//end of handler function
}
