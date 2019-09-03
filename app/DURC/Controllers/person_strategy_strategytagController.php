<?php

namespace App\DURC\Controllers;

use App\person_strategy_strategytag;
use Illuminate\Http\Request;
use CareSet\DURC\DURC;
use CareSet\DURC\DURCController;
use Illuminate\Support\Facades\View;

class person_strategy_strategytagController extends DURCController
{


	public $view_data = [];

	protected static $hidden_fields_array = [
		'created_at',
		'updated_at',

	];


	public function getWithArgumentArray(){
		
		$with_summary_array = [];
		$with_summary_array[] = "person:id,".\App\person::getNameField();
		$with_summary_array[] = "strategy:id,".\App\strategy::getNameField();
		$with_summary_array[] = "strategytag:id,".\App\strategytag::getNameField();

		return($with_summary_array);
		
	}


	private function _get_index_list(Request $request){

		$return_me = [];

		$with_argument = $this->getWithArgumentArray();

		$these = person_strategy_strategytag::with($with_argument)->paginate(100);

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

                                        if ( isset( person_strategy_strategytag::$field_type_map[$lowest_key] ) ) {
                                            $field_type = person_strategy_strategytag::$field_type_map[ $lowest_key ];
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = DURC::formatForDisplay( $field_type, $lowest_key, $lowest_data, true );
                                        } else {
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = $lowest_data;
                                        }
                                }
                        }

                        if ( isset( person_strategy_strategytag::$field_type_map[$key] ) ) {
                            $field_type = person_strategy_strategytag::$field_type_map[ $key ];
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
                $search_fields = person_strategy_strategytag::getSearchFields();

		//sometimes there is an image field that contains the url of an image
		//but this is typically null
		$img_field = person_strategy_strategytag::getImgField();

		$where_sql = '';
		$or = '';
		foreach($search_fields as $this_field){
			$where_sql .= " $or $this_field LIKE '%$q%'  ";
			$or = ' OR ';
		}

		$these = person_strategy_strategytag::whereRaw($where_sql)
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
			$tmp['text'] = trim($tmp_text);

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
     * @param  \App\person_strategy_strategytag  $person_strategy_strategytag
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
	$durc_template_results = view('DURC.person_strategy_strategytag.index',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request){

	$myNewperson_strategy_strategytag = new person_strategy_strategytag();

	//the games we play to easily auto-generate code..
	$tmp_person_strategy_strategytag = $myNewperson_strategy_strategytag;
			$tmp_person_strategy_strategytag->id = DURC::formatForStorage( 'id', 'int', $request->id ); 
		$tmp_person_strategy_strategytag->person_id = DURC::formatForStorage( 'person_id', 'int', $request->person_id ); 
		$tmp_person_strategy_strategytag->strategy_id = DURC::formatForStorage( 'strategy_id', 'int', $request->strategy_id ); 
		$tmp_person_strategy_strategytag->strategytag_id = DURC::formatForStorage( 'strategytag_id', 'int', $request->strategytag_id ); 
		$tmp_person_strategy_strategytag->is_bulk_linker = DURC::formatForStorage( 'is_bulk_linker', 'tinyint', $request->is_bulk_linker ); 
		$tmp_person_strategy_strategytag->link_note = DURC::formatForStorage( 'link_note', 'varchar', $request->link_note ); 
		$tmp_person_strategy_strategytag->save();


	$new_id = $myNewperson_strategy_strategytag->id;

	return redirect("/DURC/person_strategy_strategytag/$new_id")->with('status', 'Data Saved!');
    }//end store function

    /**
     * Display the specified resource.
     * @param  \App\$person_strategy_strategytag  $person_strategy_strategytag
     * @return \Illuminate\Http\Response
     */
    public function show(person_strategy_strategytag $person_strategy_strategytag){
	return($this->edit($person_strategy_strategytag));
    }

    /**
     * Get a json version of the given object 
     * @param  \App\person_strategy_strategytag  $person_strategy_strategytag
     * @return JSON of the object
     */
    public function jsonone(Request $request, $person_strategy_strategytag_id){
		$person_strategy_strategytag = \App\person_strategy_strategytag::find($person_strategy_strategytag_id);
		$person_strategy_strategytag = $person_strategy_strategytag->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
		$return_me_array = $person_strategy_strategytag->toArray();
		
		//lets see if we can calculate a card-img-top for a front end bootstrap card interface
		$img_uri_field = \App\person_strategy_strategytag::getImgField();
		if(!is_null($img_uri_field)){ //then this object has an image link..
			if(!isset($return_me_array['card-img-top'])){ //allow the user to use this as a field without pestering..
				$return_me_array['card-img-top'] = $person_strategy_strategytag->$img_uri_field;
			}
		}

		//lets see if can calculate the same for a card title... which is actually inside a card-body.. so we will be building a little html snippet...
		$name_field = \App\person_strategy_strategytag::getNameField();
		if($name_field){ //then this object has a name
			if(!isset($return_me_array['card-img-body'])){ //allow the user to use this as a field without pestering..
				$display_name = $person_strategy_strategytag->$name_field;
				$return_me_array['card-img-body'] = "
  <div class='card-body'>
    <h5 class='card-title'>$display_name</h5>
  </div>
";

			}
		}
		
		return response()->json($return_me_array);
 	}


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(){
	// but really, we are just going to edit a new object..
	$new_instance = new person_strategy_strategytag();
	return $this->edit($new_instance);
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\person_strategy_strategytag  $person_strategy_strategytag
     * @return \Illuminate\Http\Response
     */
    public function edit(person_strategy_strategytag $person_strategy_strategytag){

	$main_template_name = $this->_getMainTemplateName();

	//do we have a status message in the session? The view needs it...
	$this->view_data['session_status'] = session('status',false);
	if($this->view_data['session_status']){
		$this->view_data['has_session_status'] = true;
	}else{
		$this->view_data['has_session_status'] = false;
	}

	$this->view_data['csrf_token'] = csrf_token();
	
	
	foreach ( person_strategy_strategytag::$field_type_map as $column_name => $field_type ) {
        // If this field name is in the configured list of hidden fields, do not display the row.
        $this->view_data["{$column_name}_row_class"] = '';
        if ( in_array( $column_name, self::$hidden_fields_array ) ) {
            $this->view_data["{$column_name}_row_class"] = 'd-none';
        }
    }

	if($person_strategy_strategytag->exists){	//we will not have old data if this is a new object

		//well lets properly eager load this object with a refresh to load all of the related things
		$person_strategy_strategytag = $person_strategy_strategytag->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models

		//put the contents into the view...
		foreach($person_strategy_strategytag->toArray() as $key => $value){
			if ( isset( person_strategy_strategytag::$field_type_map[$key] ) ) {
                $field_type = person_strategy_strategytag::$field_type_map[ $key ];
                $this->view_data[$key] = DURC::formatForDisplay( $field_type, $key, $value );
            } else {
                $this->view_data[$key] = $value;
            }
		}

		//what is this object called?
		$name_field = $person_strategy_strategytag->_getBestName();
		$this->view_data['is_new'] = false;
		$this->view_data['durc_instance_name'] = $person_strategy_strategytag->$name_field;
	}else{
		$this->view_data['is_new'] = true;
	}

	$debug = false;
	if($debug){
		echo '<pre>';
		var_export($this->view_data);
		exit();
	}
	

	$durc_template_results = view('DURC.person_strategy_strategytag.edit',$this->view_data);        
	return view($main_template_name,['content' => $durc_template_results]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\person_strategy_strategytag  $person_strategy_strategytag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, person_strategy_strategytag $person_strategy_strategytag){

	$tmp_person_strategy_strategytag = $person_strategy_strategytag;
			$tmp_person_strategy_strategytag->id = DURC::formatForStorage( 'id', 'int', $request->id ); 
		$tmp_person_strategy_strategytag->person_id = DURC::formatForStorage( 'person_id', 'int', $request->person_id ); 
		$tmp_person_strategy_strategytag->strategy_id = DURC::formatForStorage( 'strategy_id', 'int', $request->strategy_id ); 
		$tmp_person_strategy_strategytag->strategytag_id = DURC::formatForStorage( 'strategytag_id', 'int', $request->strategytag_id ); 
		$tmp_person_strategy_strategytag->is_bulk_linker = DURC::formatForStorage( 'is_bulk_linker', 'tinyint', $request->is_bulk_linker ); 
		$tmp_person_strategy_strategytag->link_note = DURC::formatForStorage( 'link_note', 'varchar', $request->link_note ); 
		$tmp_person_strategy_strategytag->save();


	$id = $person_strategy_strategytag->id;

	return redirect("/DURC/person_strategy_strategytag/$id")->with('status', 'Data Saved!');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\person_strategy_strategytag  $person_strategy_strategytag
     * @return \Illuminate\Http\Response
     */
    public function destroy(person_strategy_strategytag $person_strategy_strategytag){
	    return person_strategy_strategytag::destroy( $person_strategy_strategytag->id );  
    }
    
    /**
     * Restore the specified resource from storage.
     * @param  $id ID of resource
     * @return \Illuminate\Http\Response
     */
    public function restore( $id )
    {
        $person_strategy_strategytag = person_strategy_strategytag::withTrashed()->find($id)->restore();
        return redirect("/DURC/test_soft_delete/$id")->with('status', 'Data Restored!');
    }
}
