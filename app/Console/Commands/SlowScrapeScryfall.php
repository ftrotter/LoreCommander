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
				$this_set[$check_me] = null; //we want somethi
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

		if($this_set['foil_only']){
			$this_set['is_foil_only'] = 1;
		}else{
			$this_set['is_foil_only'] = 0;
		}

		unset($this_set['id']); //we have our own id.
		unset($this_set['object']);//this is always 'set' and we do not care
		unset($this_set['uri']); //this variable name was too vauge
		unset($this_set['digital']);
		unset($this_set['foil_only']);
	
		$DURCmtgset = \App\mtgset::firstOrNew(['scryfall_id' => $scryfall_id]);
		$DURCmtgset->fill($this_set);
		$DURCmtgset->save();


		//prep for the next loop
		$set_code_list[$DURCmtgset->id] = $this_set['code']; //we will use the to download the cards a set at a time in a moment		

	}
	
	foreach($set_code_list as $mtgset_id => $this_set_code){
		echo $this_set_code . "\n";
	}


	//some meta mapping data to help us map each card to the right local variables.

		//fields that should just be copied into the namespace..
		$card_field_mirror = [
			'lang',
			'oracle_id',
			'rulings_uri',
			'layout',
			'rarity',
			'set_name',
			'set_type',
			];

		$cardface_field_mirror = [
			'artist',
			'flavor_text',
			'border_color',
			'type_line',
			'mana_cost',
		];

		$cardface_convert_to_tiny_int = [
			'foil',
			'nonfoil',
			'oversized',
			];

		$card_convert_to_tiny_int = [
			'reserved',
			'reprint',
			'variation',
			'promo',
			'story_spotlight',
			

		];

		$is_legal = [
			'oldschool',
			'duel',
			'commander',
			'penny',
			'vintage',
			'pauper',
			'legacy',
			'modern',
			'frontier',
			'future',
			'standard',
		];

		//set this so that we can uses less / greater than to see if legal
		$legal_lookup = [
			'banned' => -2,
			'not_legal' => -1,
			'restricted' => 1,
			'legal' => 2,
		];

		$is_color = [
			
		];


	$cards = \App\ScryfallAPI::getAllCardsInSet($this_set_code);

	foreach($cards as $this_outer_card){

		//first we consider the cardfaces...
	
		$card_loop = [];
		$card_fill = [];
		$carface_fill = [];

		if(isset($this_outer_card['card_faces'])){
			//then this card has more than one card face..
			foreach($this_outer_card['card_faces'] as $this_face){
				$card_loop[] = array_merge($this_face,$this_outer_card); //will flatten the card face and the card into one big thing...
			}
		}else{
			$card_loop[] = $this_outer_card; //we only have 1 card <-> cardface
		}	
	
		foreach($card_loop as $this_card){


			//these we rename..
			$scryfall_id = $this_card['id'];
			$card_fill['scryfall_id'] = $scryfall_id;
			$card_fill['scryfall_api_uri'] = $this_card['uri'];		
			$card_fill['scryfall_web_uri'] = $this_card['scryfall_uri'];

			if(isset($this_card['variation_of'])){
				$card_fill['variation_of_scryfall_id'] = $this_card['variation_of'];
			}else{
				$card_fill['variation_of_scryfall_id'] = null;
			}

			foreach($card_convert_to_tiny_int as $is_postfix){
				if(isset($this_card[$is_postfix])){
					if($this_card[$is_postfix]){
						$card_fill["is_$is_postfix"] = 1;
					}else{
						$card_fill["is_$is_postfix"] = 0;
					}
				}else{
					$card_fill["is_$is_postfix"] = 0;//missing values get zero
				}
			}

			//
			foreach($card_field_mirror as $this_field){
				if(isset($this_card[$this_field])){
					$card_fill[$this_field] = $this_card[$this_field]; //pretty obvious
				}else{
					$card_fill[$this_field] = null; //should be accepted by the DB
				}
			}

			//flatten the legalities i.e. legacy, modern and standard
			if(isset($this_card['legalities'])){
				foreach($this_card['legalities'] as $legal_in => $legal_status){
					$legal_score = $legal_lookup[$legal_status];
					$card_fill["legal_$legal_in"] = $legal_score; //it is 0 by dfault..
				}
			}

			//flattent the games array i.e. mtgo, arena, print
			if(isset($this_card['games'])){
				foreach($this_card['games'] as $this_game){
					$card_fill["is_game_$this_game"] = 1; //it is 0 by dfault..
				}
			}

			$DURC_card = \App\card::firstOrNew(['scryfall_id' => $scryfall_id]);
			$DURC_card->fill($card_fill);
			$DURC_card->save();

		 


		}

	}
	

    }
}
