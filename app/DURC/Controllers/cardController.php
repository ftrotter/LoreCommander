<?php

namespace App\DURC\Controllers;

use App\card;
use Illuminate\Http\Request;
use CareSet\DURC\DURC;
use CareSet\DURC\DURCController;
use Illuminate\Support\Facades\View;

class cardController extends DURCController
{


	public $view_data = [];

	protected static $hidden_fields_array = [
		'created_at',
		'updated_at',

	];


	public function getWithArgumentArray(){
		
		$with_summary_array = [];
		$with_summary_array[] = "mtgset:id,".\App\mtgset::getNameField();

		return($with_summary_array);
		
	}


	private function _get_index_list(Request $request){

		$return_me = [];

		$with_argument = $this->getWithArgumentArray();

		$these = card::with($with_argument)->paginate(100);

        	foreach($these->toArray() as $key => $value){ //add the contents of the obj to the the view 
			$return_me[$key] = $value;
        	}

		//collapse and format joined data..
		$return_me_data = [];
        foreach($return_me['data'] as $data_i => $data_row){
                foreach($data_row as $key => $value){
                        if(is_array($value)){
                                foreach($value as $lowest_key => $lowest_data){
                                        //then this is a loaded attribute..
                                        //lets move it one level higher...

                                        if ( isset( card::$field_type_map[$lowest_key] ) ) {
                                            $field_type = card::$field_type_map[ $lowest_key ];
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = DURC::formatForDisplay( $field_type, $lowest_key, $lowest_data, true );
                                        } else {
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = $lowest_data;
                                        }
                                }
                        }

                        if ( isset( card::$field_type_map[$key] ) ) {
                            $field_type = card::$field_type_map[ $key ];
                            $return_me_data[$data_i][$key] = DURC::formatForDisplay( $field_type, $key, $value, true );
                        } else {
                            $return_me_data[$data_i][$key] = $value;
                        }
                }
        }
        $return_me['data'] = $return_me_data;
		
		
                foreach($return_me['data'] as $data_i => $data_row){
                        foreach($data_row as $key => $value){
                                if(is_array($value)){
                                        foreach($value as $lowest_key => $lowest_data){
                                                //then this is a loaded attribute..
                                                //lets move it one level higher...
                                                $return_me['data'][$data_i][$key .'_id_DURClabel'] = $lowest_data;
                                        }
                                        unset($return_me['data'][$data_i][$key]);
                                }
                        }
                }


		//helps with logic-less templating...
		if($return_me['first_page_url'] == $return_me['last_page_url']){
			$return_me['is_need_paging'] = false;
		}else{
			$return_me['is_need_paging'] = true;
		}

		if($return_me['current_page'] == 1){
			$return_me['first_page_class'] = 'disabled';
			$return_me['prev_page_class'] = 'disabled';
		}else{
			$return_me['first_page_class'] = '';
			$return_me['prev_page_class'] = '';
		}


		if($return_me['current_page'] == $return_me['last_page']){
			$return_me['next_page_class'] = 'disabled';
			$return_me['last_page_class'] = 'disabled';
		}else{
			$return_me['next_page_class'] = '';
			$return_me['last_page_class'] = '';
		}

		return($return_me);
	}

	/**
	*	A simple function that allows fo rthe searching of this object type in the db, 
	*	And returns the results in a select2-json compatible way.
	*	This powers the select2 widgets across the forms...
	*/
   	public function search(Request $request){

		$q = $request->input('q');

		//TODO we need to escape this query string to avoid SQL injection.

		//what is the field I should be searching
                $search_fields = card::getSearchFields();

		//sometimes there is an image field that contains the url of an image
		//but this is typically null
		$img_field = card::getImgField();

		$where_sql = '';
		$or = '';
		foreach($search_fields as $this_field){
			$where_sql .= " $or $this_field LIKE '%$q%'  ";
			$or = ' OR ';
		}

		$these = card::whereRaw($where_sql)
					->take(20)
					->get();


		$return_me['pagination'] = ['more' => false];
		$raw_array = $these->toArray();

		$real_array = [];
		foreach($raw_array as $this_row){
			$tmp = [ 'id' => $this_row['id']];
			$tmp_text = '';
			foreach($this_row as $field => $data){
				if(in_array($field,$search_fields)){
					//then we need to show this text!!
					$tmp_text .=  "$data ";
				}
			}
			$tmp['text'] = $tmp_text;

			if(!is_null($img_field)){ //then there is an image for this entry
				$tmp['img_field'] = $img_field;
				if(isset($this_row[$img_field])){
					$tmp['img_url'] = $this_row[$img_field];
				}else{	
					$tmp['img_url'] = null;
				}
			}

			$real_array[] = $tmp;
		}


		$return_me['results'] = $real_array;

		// you might this helpful for debugging..
		//$return_me['where'] = $where_sql;

		return response()->json($return_me);

	}

    /**
     * Get a json version of all the objects.. 
     * @param  \App\card  $card
     * @return JSON of the object
     */
    public function jsonall(Request $request){
		return response()->json($this->_get_index_list($request));
 	}

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
	$main_template_name = $this->_getMainTemplateName();


	$this->view_data = $this->_get_index_list($request);

	if($request->has('debug')){
		var_export($this->view_data);
		exit();
	}
	$durc_template_results = view('DURC.card.index',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request){

	$myNewcard = new card();

	//the games we play to easily auto-generate code..
	$tmp_card = $myNewcard;
			$tmp_card->id = DURC::formatForStorage( 'id', 'int', $request->id ); 
		$tmp_card->scryfall_id = DURC::formatForStorage( 'scryfall_id', 'varchar', $request->scryfall_id ); 
		$tmp_card->lang = DURC::formatForStorage( 'lang', 'varchar', $request->lang ); 
		$tmp_card->oracle_id = DURC::formatForStorage( 'oracle_id', 'varchar', $request->oracle_id ); 
		$tmp_card->rulings_uri = DURC::formatForStorage( 'rulings_uri', 'varchar', $request->rulings_uri ); 
		$tmp_card->scryfall_web_uri = DURC::formatForStorage( 'scryfall_web_uri', 'varchar', $request->scryfall_web_uri ); 
		$tmp_card->scryfall_api_uri = DURC::formatForStorage( 'scryfall_api_uri', 'varchar', $request->scryfall_api_uri ); 
		$tmp_card->layout = DURC::formatForStorage( 'layout', 'varchar', $request->layout ); 
		$tmp_card->rarity = DURC::formatForStorage( 'rarity', 'varchar', $request->rarity ); 
		$tmp_card->released_at = DURC::formatForStorage( 'released_at', 'varchar', $request->released_at ); 
		$tmp_card->set_name = DURC::formatForStorage( 'set_name', 'varchar', $request->set_name ); 
		$tmp_card->set_type = DURC::formatForStorage( 'set_type', 'int', $request->set_type ); 
		$tmp_card->mtgset_id = DURC::formatForStorage( 'mtgset_id', 'int', $request->mtgset_id ); 
		$tmp_card->variation_of_scryfall_id = DURC::formatForStorage( 'variation_of_scryfall_id', 'varchar', $request->variation_of_scryfall_id ); 
		$tmp_card->edhrec_rank = DURC::formatForStorage( 'edhrec_rank', 'int', $request->edhrec_rank ); 
		$tmp_card->is_promo = DURC::formatForStorage( 'is_promo', 'tinyint', $request->is_promo ); 
		$tmp_card->is_reserved = DURC::formatForStorage( 'is_reserved', 'tinyint', $request->is_reserved ); 
		$tmp_card->is_story_spotlight = DURC::formatForStorage( 'is_story_spotlight', 'tinyint', $request->is_story_spotlight ); 
		$tmp_card->is_reprint = DURC::formatForStorage( 'is_reprint', 'int', $request->is_reprint ); 
		$tmp_card->is_variation = DURC::formatForStorage( 'is_variation', 'tinyint', $request->is_variation ); 
		$tmp_card->is_game_paper = DURC::formatForStorage( 'is_game_paper', 'tinyint', $request->is_game_paper ); 
		$tmp_card->is_game_mtgo = DURC::formatForStorage( 'is_game_mtgo', 'tinyint', $request->is_game_mtgo ); 
		$tmp_card->is_game_arena = DURC::formatForStorage( 'is_game_arena', 'tinyint', $request->is_game_arena ); 
		$tmp_card->legal_oldschool = DURC::formatForStorage( 'legal_oldschool', 'tinyint', $request->legal_oldschool ); 
		$tmp_card->legal_duel = DURC::formatForStorage( 'legal_duel', 'tinyint', $request->legal_duel ); 
		$tmp_card->legal_commander = DURC::formatForStorage( 'legal_commander', 'tinyint', $request->legal_commander ); 
		$tmp_card->legal_brawl = DURC::formatForStorage( 'legal_brawl', 'tinyint', $request->legal_brawl ); 
		$tmp_card->legal_penny = DURC::formatForStorage( 'legal_penny', 'tinyint', $request->legal_penny ); 
		$tmp_card->legal_vintage = DURC::formatForStorage( 'legal_vintage', 'tinyint', $request->legal_vintage ); 
		$tmp_card->legal_pauper = DURC::formatForStorage( 'legal_pauper', 'tinyint', $request->legal_pauper ); 
		$tmp_card->legal_legacy = DURC::formatForStorage( 'legal_legacy', 'tinyint', $request->legal_legacy ); 
		$tmp_card->legal_modern = DURC::formatForStorage( 'legal_modern', 'tinyint', $request->legal_modern ); 
		$tmp_card->legal_frontier = DURC::formatForStorage( 'legal_frontier', 'tinyint', $request->legal_frontier ); 
		$tmp_card->legal_future = DURC::formatForStorage( 'legal_future', 'tinyint', $request->legal_future ); 
		$tmp_card->legal_standard = DURC::formatForStorage( 'legal_standard', 'tinyint', $request->legal_standard ); 
		$tmp_card->save();


	$new_id = $myNewcard->id;

	return redirect("/DURC/card/$new_id")->with('status', 'Data Saved!');
    }//end store function

    /**
     * Display the specified resource.
     * @param  \App\$card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(card $card){
	return($this->edit($card));
    }

    /**
     * Get a json version of the given object 
     * @param  \App\card  $card
     * @return JSON of the object
     */
    public function jsonone(Request $request, $card_id){
		$card = \App\card::find($card_id);
		$card = $card->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
		return response()->json($card->toArray());
 	}


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(){
	// but really, we are just going to edit a new object..
	$new_instance = new card();
	return $this->edit($new_instance);
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(card $card){

	$main_template_name = $this->_getMainTemplateName();

	//do we have a status message in the session? The view needs it...
	$this->view_data['session_status'] = session('status',false);
	if($this->view_data['session_status']){
		$this->view_data['has_session_status'] = true;
	}else{
		$this->view_data['has_session_status'] = false;
	}

	$this->view_data['csrf_token'] = csrf_token();
	
	
	foreach ( card::$field_type_map as $column_name => $field_type ) {
        // If this field name is in the configured list of hidden fields, do not display the row.
        $this->view_data["{$column_name}_row_class"] = '';
        if ( in_array( $column_name, self::$hidden_fields_array ) ) {
            $this->view_data["{$column_name}_row_class"] = 'd-none';
        }
    }

	if($card->exists){	//we will not have old data if this is a new object

		//well lets properly eager load this object with a refresh to load all of the related things
		$card = $card->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models

		//put the contents into the view...
		foreach($card->toArray() as $key => $value){
			if ( isset( card::$field_type_map[$key] ) ) {
                $field_type = card::$field_type_map[ $key ];
                $this->view_data[$key] = DURC::formatForDisplay( $field_type, $key, $value );
            } else {
                $this->view_data[$key] = $value;
            }
		}

		//what is this object called?
		$name_field = $card->_getBestName();
		$this->view_data['is_new'] = false;
		$this->view_data['durc_instance_name'] = $card->$name_field;
	}else{
		$this->view_data['is_new'] = true;
	}

	$debug = false;
	if($debug){
		echo '<pre>';
		var_export($this->view_data);
		exit();
	}
	

	$durc_template_results = view('DURC.card.edit',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, card $card){

	$tmp_card = $card;
			$tmp_card->id = DURC::formatForStorage( 'id', 'int', $request->id ); 
		$tmp_card->scryfall_id = DURC::formatForStorage( 'scryfall_id', 'varchar', $request->scryfall_id ); 
		$tmp_card->lang = DURC::formatForStorage( 'lang', 'varchar', $request->lang ); 
		$tmp_card->oracle_id = DURC::formatForStorage( 'oracle_id', 'varchar', $request->oracle_id ); 
		$tmp_card->rulings_uri = DURC::formatForStorage( 'rulings_uri', 'varchar', $request->rulings_uri ); 
		$tmp_card->scryfall_web_uri = DURC::formatForStorage( 'scryfall_web_uri', 'varchar', $request->scryfall_web_uri ); 
		$tmp_card->scryfall_api_uri = DURC::formatForStorage( 'scryfall_api_uri', 'varchar', $request->scryfall_api_uri ); 
		$tmp_card->layout = DURC::formatForStorage( 'layout', 'varchar', $request->layout ); 
		$tmp_card->rarity = DURC::formatForStorage( 'rarity', 'varchar', $request->rarity ); 
		$tmp_card->released_at = DURC::formatForStorage( 'released_at', 'varchar', $request->released_at ); 
		$tmp_card->set_name = DURC::formatForStorage( 'set_name', 'varchar', $request->set_name ); 
		$tmp_card->set_type = DURC::formatForStorage( 'set_type', 'int', $request->set_type ); 
		$tmp_card->mtgset_id = DURC::formatForStorage( 'mtgset_id', 'int', $request->mtgset_id ); 
		$tmp_card->variation_of_scryfall_id = DURC::formatForStorage( 'variation_of_scryfall_id', 'varchar', $request->variation_of_scryfall_id ); 
		$tmp_card->edhrec_rank = DURC::formatForStorage( 'edhrec_rank', 'int', $request->edhrec_rank ); 
		$tmp_card->is_promo = DURC::formatForStorage( 'is_promo', 'tinyint', $request->is_promo ); 
		$tmp_card->is_reserved = DURC::formatForStorage( 'is_reserved', 'tinyint', $request->is_reserved ); 
		$tmp_card->is_story_spotlight = DURC::formatForStorage( 'is_story_spotlight', 'tinyint', $request->is_story_spotlight ); 
		$tmp_card->is_reprint = DURC::formatForStorage( 'is_reprint', 'int', $request->is_reprint ); 
		$tmp_card->is_variation = DURC::formatForStorage( 'is_variation', 'tinyint', $request->is_variation ); 
		$tmp_card->is_game_paper = DURC::formatForStorage( 'is_game_paper', 'tinyint', $request->is_game_paper ); 
		$tmp_card->is_game_mtgo = DURC::formatForStorage( 'is_game_mtgo', 'tinyint', $request->is_game_mtgo ); 
		$tmp_card->is_game_arena = DURC::formatForStorage( 'is_game_arena', 'tinyint', $request->is_game_arena ); 
		$tmp_card->legal_oldschool = DURC::formatForStorage( 'legal_oldschool', 'tinyint', $request->legal_oldschool ); 
		$tmp_card->legal_duel = DURC::formatForStorage( 'legal_duel', 'tinyint', $request->legal_duel ); 
		$tmp_card->legal_commander = DURC::formatForStorage( 'legal_commander', 'tinyint', $request->legal_commander ); 
		$tmp_card->legal_brawl = DURC::formatForStorage( 'legal_brawl', 'tinyint', $request->legal_brawl ); 
		$tmp_card->legal_penny = DURC::formatForStorage( 'legal_penny', 'tinyint', $request->legal_penny ); 
		$tmp_card->legal_vintage = DURC::formatForStorage( 'legal_vintage', 'tinyint', $request->legal_vintage ); 
		$tmp_card->legal_pauper = DURC::formatForStorage( 'legal_pauper', 'tinyint', $request->legal_pauper ); 
		$tmp_card->legal_legacy = DURC::formatForStorage( 'legal_legacy', 'tinyint', $request->legal_legacy ); 
		$tmp_card->legal_modern = DURC::formatForStorage( 'legal_modern', 'tinyint', $request->legal_modern ); 
		$tmp_card->legal_frontier = DURC::formatForStorage( 'legal_frontier', 'tinyint', $request->legal_frontier ); 
		$tmp_card->legal_future = DURC::formatForStorage( 'legal_future', 'tinyint', $request->legal_future ); 
		$tmp_card->legal_standard = DURC::formatForStorage( 'legal_standard', 'tinyint', $request->legal_standard ); 
		$tmp_card->save();


	$id = $card->id;

	return redirect("/DURC/card/$id")->with('status', 'Data Saved!');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(card $card){
	    return card::destroy( $card->id );  
    }
    
    /**
     * Restore the specified resource from storage.
     * @param  $id ID of resource
     * @return \Illuminate\Http\Response
     */
    public function restore( $id )
    {
        $card = card::withTrashed()->find($id)->restore();
        return redirect("/DURC/test_soft_delete/$id")->with('status', 'Data Restored!');
    }
}
