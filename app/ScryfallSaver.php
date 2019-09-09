<?php

namespace App;

/*
       Understands to take a list of cards (could be just one) 
	and save them (trampling) to the DB.

*/


class  ScryfallSaver {


                public static  $card_field_mirror = [
                        'lang',
                        'oracle_id',
                        'rulings_uri',
                        'layout',
                        'rarity',
                        'set_name',
                        'set_type',
                        ];

                public static $cardface_field_mirror = [
                        'artist',
                        'flavor_text',
                        'border_color',
                        'type_line',
                        'mana_cost',
                        'name',
                        'oracle_text',
                        'border_color',
                        'power',
			'toughness',
                        'cardface_index', // I am building this one below...
                ];

                public static $cardface_convert_to_tiny_int = [
                        'foil',
                        'nonfoil',
                        'oversized',
                        ];

                public static $card_convert_to_tiny_int = [
                        'reserved',
                        'reprint',
                        'variation',
                        'promo',
                        'story_spotlight',
                ];

                public  static $is_legal = [
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
                public static $legal_lookup = [
                        'banned' => -2,
                        'not_legal' => -1,
                        'restricted' => 1,
                        'legal' => 2,
                ];

                public static $color_lookup = [
                        'G' => 'green',
                        'R' => 'red',
                        'U' => 'blue',
                        'B' => 'black',
                        'W' => 'white',
                ];

                public static $image_lookup = [
                        'small',
                        'normal',
                        'large',
                        'png',
                        'art_crop',
                        'border_crop',
                ];

		public static $pricetype_lookup  = [
			'usd' => 1,
			'usd_foil' => 2,
			'eur' => 3,
			'tix' => 4,
		];

	public static  function saveCardList($cards){

		foreach($cards as $this_outer_card){
			//first we consider the cardfaces...
	
			$card_loop = [];
			if(isset($this_outer_card['card_faces'])){
				//then this card has more than one card face..
				$name = $this_outer_card['name'];
				echo "Looping over $name\n";
				$is_double_face = true;
				foreach($this_outer_card['card_faces'] as $cardface_index => $this_face){
					$this_face['cardface_index'] = $cardface_index;
					$card_loop[] = array_merge($this_face,$this_outer_card); //will flatten the card face and the card into one big thing...
				}
			}else{
				$is_double_face = false;
				$this_outer_card['cardface_index'] = 0; //because it just has the one..
				$card_loop[] = $this_outer_card; //we only have 1 card <-> cardface
			}	
	
			foreach($card_loop as $this_card){
	
				if(isset($this_card['illustration_id'])){	
					$illustration_id = $this_card['illustration_id'];
				}else{
					$illustration_id = 0;
				}
				$scryfall_id = $this_card['id'];
				$cardface_index = $this_card['cardface_index'];
	
				if($is_double_face){
	
					echo "\tscrayfall_id:$scryfall_id	\tcardface_index:$cardface_index \tillustration_id:$illustration_id\n";		
					
				}
	
				$card_fill = []; //this should be the same for both card loops...
				$cardface_fill = []; //blank this out for every card loop... 
	
				//these we rename..
				$card_fill['scryfall_id'] = $scryfall_id;

				$this_set = $this_card['set'];
				$MTGSet = \App\mtgset::where('code', $this_set)->first();
				if(is_null($MTGSet->id)){
					echo "Looking up the id for set $this_set failed";
					exit();
				}	
				$mtgset_id = $MTGSet->id;
				$card_fill['mtgset_id'] = $mtgset_id;
				$card_fill['scryfall_api_uri'] = $this_card['uri'];		
				$card_fill['scryfall_web_uri'] = $this_card['scryfall_uri'];
	
				if(isset($this_card['variation_of'])){
					$card_fill['variation_of_scryfall_id'] = $this_card['variation_of'];
				}else{
					$card_fill['variation_of_scryfall_id'] = null;
				}
	
				foreach(self::$card_convert_to_tiny_int as $is_postfix){
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
				foreach(self::$card_field_mirror as $this_field){
					if(isset($this_card[$this_field])){
						$card_fill[$this_field] = $this_card[$this_field]; //pretty obvious
					}else{
						$card_fill[$this_field] = null; //should be accepted by the DB
					}
				}
	
				//flatten the legalities i.e. legacy, modern and standard
				if(isset($this_card['legalities'])){
					foreach($this_card['legalities'] as $legal_in => $legal_status){
						$legal_score = self::$legal_lookup[$legal_status];
						$card_fill["legal_$legal_in"] = $legal_score; //it is 0 by dfault..
					}
				}
	
				//flattent the games array i.e. mtgo, arena, print
				if(isset($this_card['games'])){
					foreach($this_card['games'] as $this_game){
						$card_fill["is_game_$this_game"] = 1; //it is 0 by dfault..
					}
				}
	
				//we consider each card unique in its set...
				$DURC_card = \App\card::firstOrNew(['scryfall_id' => $scryfall_id,'mtgset_id' => $mtgset_id ]);
				$DURC_card->fill($card_fill);
				$DURC_card->save();
	
				$card_id = $DURC_card->id; //need this to save the card face..
			
				$cardface_fill['card_id'] = $card_id;
				
				//first lets copy over the fields that will not change at all.. 
				foreach(self::$cardface_field_mirror as $this_field){
					if(isset($this_card[$this_field])){
						$cardface_fill[$this_field] = $this_card[$this_field]; //pretty obvious
					}else{
						$cardface_fill[$this_field] = null; //should be accepted by the DB
					}
				}
			
			 	//convert the booleans to our is_ tinyint notation...
				foreach(self::$cardface_convert_to_tiny_int as $is_postfix){
					if(isset($this_card[$is_postfix])){
						if($this_card[$is_postfix]){
							$cardface_fill["is_$is_postfix"] = 1;
						}else{
							$cardface_fill["is_$is_postfix"] = 0;
						}
					}else{
						$cardface_fill["is_$is_postfix"] = 0;//missing values get zero
					}
				}
	
				//now we calculate our is_color variables...
				$has_color = false;
				$color_count = 0;
				foreach($this_card['color_identity'] as $has_this_color){
					$color_name = self::$color_lookup[$has_this_color];
					$cardface_fill["is_color_$color_name"] = 1;				
	
					$color_count++;
					$has_color = true;
				}
			
				if(!$has_color){
					$cardface_fill["is_colorless"] = true;
				}
	
	
				$cardface_fill['color_count'] = $color_count;
	
				foreach($this_card['image_uris'] as $image_type => $image_url){
					$cardface_fill["image_uri_$image_type"] = $image_url;
				}

				//set  the default url...
				$cardface_fill['image_uri'] = $cardface_fill["image_uri_art_crop"];


				//a card face is unique on card_id plus illustration_id... probably...
				$DURC_cardface = \App\cardface::firstOrNew([
								'card_id' => $card_id,
								'illustration_id' => $illustration_id,
								]);
								$DURC_cardface->fill($cardface_fill);
				$DURC_cardface->save();


				$prices  = $this_card['prices'];
				
				foreach($prices as $this_type => $price_amount){
					$priceObj = new \App\cardprice;
					$priceObj->price = $price_amount;
					$priceObj->card_id = $card_id;
					$priceObj->scryfall_id = $scryfall_id;
					$priceObj->pricetype_id = self::$pricetype_lookup[$this_type]; 
					$priceObj->save();	
				}
	
			} //end of cardface loop
	
		} //end of card loop




	}



}
