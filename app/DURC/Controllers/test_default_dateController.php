<?php

namespace App\DURC\Controllers;

use App\test_default_date;
use Illuminate\Http\Request;
use ftrotter\DURC\DURC;
use ftrotter\DURC\DURCController;
use Illuminate\Support\Facades\View;
use ftrotter\DURC\DURCInvalidDataException;

class test_default_dateController extends DURCController
{


	public $view_data = [];

	protected static $hidden_fields_array = [

	];


	public function getWithArgumentArray(){
		
		$with_summary_array = [];

		return($with_summary_array);
		
	}


	private function _get_index_list(Request $request){

		$return_me = [];

		$with_argument = $this->getWithArgumentArray();

		$these = test_default_date::with($with_argument)->paginate(100);

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

                                        if ( isset( test_default_date::$field_type_map[$lowest_key] ) ) {
                                            $field_type = test_default_date::$field_type_map[ $lowest_key ];
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = DURC::formatForDisplay( $field_type, $lowest_key, $lowest_data, true );
                                        } else {
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = $lowest_data;
                                        }
                                }
                        }

                        if ( isset( test_default_date::$field_type_map[$key] ) ) {
                            $field_type = test_default_date::$field_type_map[ $key ];
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
		$page = $request->input('page');

		//TODO we need to escape this query string to avoid SQL injection.

		//what is the field I should be searching
                $search_fields = test_default_date::getSearchFields();

		//sometimes there is an image field that contains the url of an image
		//but this is typically null
		$img_field = test_default_date::getImgField();

		$where_sql = '';
		$or = '';
		foreach($search_fields as $this_field){
			$where_sql .= " $or $this_field LIKE '%$q%'  ";
			$or = ' OR ';
		}

		$query = test_default_date::whereRaw($where_sql);
		            
		$count = $query->count();			
		$these = $query
		            ->skip(20*($page-1))
					->take(20)
					->get();
					
        $more = $count > $page * 20;

		$return_me['pagination'] = ['more' => $more];
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

			//show the id of the data at the end of the select..
			$tmp['text'] .= ' ('.$this_row['id'].')';;

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
     * @param  \App\test_default_date  $test_default_date
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
        $durc_template_results = view('DURC.test_default_date.index',$this->view_data);        
        return view($main_template_name,['content' => $durc_template_results]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request){

        $myNewtest_default_date = new test_default_date();

        //the games we play to easily auto-generate code..
        $tmp_test_default_date = $myNewtest_default_date;
        
        $tmp_test_default_date->id = $request->id;
        $tmp_test_default_date->datetime_none = $request->datetime_none;
        $tmp_test_default_date->date_none = $request->date_none;
        $tmp_test_default_date->datetime_current = $request->datetime_current;
        $tmp_test_default_date->date_current = $request->date_current;
        $tmp_test_default_date->datetime_null = $request->datetime_null;
        $tmp_test_default_date->date_null = $request->date_null;
        $tmp_test_default_date->datetime_defined = $request->datetime_defined;
        $tmp_test_default_date->date_defined = $request->date_defined;


        try {
            $tmp_test_default_date->save();

        $new_id = $myNewtest_default_date->id;
        return redirect("/DURC/test_default_date/$new_id")->with('status', 'Data Saved!');
        } catch (DURCInvalidDataException $e) {
            return back()->withInput()->with('errors', $tmp_test_default_date->getErrors());

        } catch (\Exception $e) {
            return back()->withInput()->with('status', 'There was an error in your data: '.$e->getMessage());

        }

        
    }//end store function

    /**
     * Display the specified resource.
     * @param  \App\$test_default_date  $test_default_date
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, test_default_date $test_default_date){
	return($this->edit($request, $test_default_date));
    }

    /**
     * Get a json version of the given object 
     * @param  \App\test_default_date  $test_default_date
     * @return JSON of the object
     */
    public function jsonone(Request $request, $test_default_date_id){
		$test_default_date = \App\test_default_date::find($test_default_date_id);
		if ($test_default_date === null) {
            return response()->json("test_default_date with id = {$test_default_date_id} Not Found", 404);
        }
		$test_default_date = $test_default_date->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
		$return_me_array = $test_default_date->toArray();
		$search_fields = \App\test_default_date::getSearchFields();

        $tmp_text = '';
        foreach($return_me_array as $field => $data){
            if(in_array($field, $search_fields)){
                //then we need to show this text!!
                $tmp_text .=  "$data ";
            }
        }
        $return_me_array['text'] = trim($tmp_text);

        //show the id of the data at the end of the select..
        $return_me_array['text'] .= ' ('.$return_me_array['id'].')';
		
		
		//lets see if we can calculate a card-img-top for a front end bootstrap card interface
		$img_uri_field = \App\test_default_date::getImgField();
		if(!is_null($img_uri_field)){ //then this object has an image link..
			if(!isset($return_me_array['card_img_top'])){ //allow the user to use this as a field without pestering..
				$return_me_array['card_img_top'] = $test_default_date->$img_uri_field;
			}
		}

		//lets get a card_body from the DURC mode class!!
		if(!isset($return_me_array['card_body'])){ //allow the user to use this as a field without pestering..
			//this is simply the name unless someone has put work into this...
			$return_me_array['card_body'] = $test_default_date->getCardBody();
		}
		
		return response()->json($return_me_array);
 	}


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        // but really, we are just going to edit a new object..
        $new_instance = new test_default_date();
        return $this->edit($request, $new_instance); 
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\test_default_date  $test_default_date
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, test_default_date $test_default_date){

        $main_template_name = $this->_getMainTemplateName();
        
        // in case there's flashed input
        $this->view_data = $request->old();
    
        //do we have a status message in the session? The view needs it...
        $this->view_data['session_status'] = session('status',false);
        if($this->view_data['session_status']){
            $this->view_data['has_session_status'] = true;
        }else{
            $this->view_data['has_session_status'] = false;
        }
        
        // Do we have errors in the session? If so, set local error_messages array, 
        // which contains an array for each field containing error messages
        $error_messages = [];
        if ($errors = session('errors', false)) {
            $error_messages = $errors->getMessages();
        }
    
        $this->view_data['csrf_token'] = csrf_token();
        
        foreach ( test_default_date::$field_type_map as $column_name => $field_type ) {
            // If this field name is in the configured list of hidden fields, do not display the row.
            $this->view_data["{$column_name}_row_class"] = '';
            if ( in_array( $column_name, self::$hidden_fields_array ) ) {
                $this->view_data["{$column_name}_row_class"] = 'd-none';
            }
            
            // If this field has any errors, set them, otherwise tell view that has_errors is false for this field
            $this->view_data['errors'][$column_name]['has_errors'] = false;
            if (isset($error_messages[$column_name])) {
                $this->view_data['errors'][$column_name]['has_errors'] = true;
                $this->view_data['errors'][$column_name]['messages'] = $error_messages[$column_name];
            }
        }
    
        if($test_default_date->exists){	
    
      		//well lets properly eager load this object with a refresh to load all of the related things
      		$test_default_date = $test_default_date->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
    
      		//put the contents into the view...
		//we have to do this even if the object is new, because sometimes the variable is set from a GET or POST request... 
      		foreach($test_default_date->toArray() as $key => $value){
                
                	if (array_key_exists($key, $request->old())) {
                    		$input = $request->old($key);
                	} else {
                    		$input = $value;
                	}
            
                	if ( isset( test_default_date::$field_type_map[$key] ) ) {
                		$field_type = test_default_date::$field_type_map[ $key ];
                		$this->view_data[$key] = DURC::formatForDisplay( $field_type, $key, $input );
        		} else {
                		$this->view_data[$key] = $input;
        		}
                
       	 		// If this is a nullable field, see whether null checkbox should be checked by default
       	 		if ($test_default_date->isFieldNullable($key) &&
                		$input == null) {
                		$this->view_data["{$key}_checked"] = "checked";
        		}
       		}
    
            	//what is this object called?
            	$name_field = $test_default_date->_getBestName();
            	$this->view_data['is_new'] = false;
            	$this->view_data['durc_instance_name'] = $test_default_date->$name_field;

        }else{
		//this has not been saved yet, but we still want to honor GET and POST variables etc. 
        	$test_default_date = new test_default_date();
		$params = $request->all(); //this will include GET and POST variables, etc
		$test_default_date->fill($params);  //this will initialize the contents of the object with anything in the GET etc.
		foreach($params as $key => $value){
			$this->view_data[$key] = $value;
		}
            	$this->view_data['is_new'] = true;
        }
    
        $debug = false;
        if($debug){
            echo '<pre>';
            var_export($this->view_data);
            exit();
        }
        
    
        $durc_template_results = view('DURC.test_default_date.edit',$this->view_data);        
        return view($main_template_name,['content' => $durc_template_results]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\test_default_date  $test_default_date
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, test_default_date $test_default_date){

        $tmp_test_default_date = $test_default_date;
        
        $tmp_test_default_date->id = $request->id;
        $tmp_test_default_date->datetime_none = $request->datetime_none;
        $tmp_test_default_date->date_none = $request->date_none;
        $tmp_test_default_date->datetime_current = $request->datetime_current;
        $tmp_test_default_date->date_current = $request->date_current;
        $tmp_test_default_date->datetime_null = $request->datetime_null;
        $tmp_test_default_date->date_null = $request->date_null;
        $tmp_test_default_date->datetime_defined = $request->datetime_defined;
        $tmp_test_default_date->date_defined = $request->date_defined;

        $id = $test_default_date->id;
        
        try {
            $tmp_test_default_date->save();

            return redirect("/DURC/test_default_date/$id")->with('status', 'Data Saved!');
        } catch (DURCInvalidDataException $e) {
            return back()->withInput()->with('errors', $tmp_test_default_date->getErrors());

        } catch (\Exception $e) {
            return back()->withInput()->with('status', 'There was an error in your data: '.$e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\test_default_date  $test_default_date
     * @return \Illuminate\Http\Response
     */
    public function destroy(test_default_date $test_default_date){
	    return test_default_date::destroy( $test_default_date->id );  
    }
    
    /**
     * Restore the specified resource from storage.
     * @param  $id ID of resource
     * @return \Illuminate\Http\Response
     */
    public function restore( $id )
    {
        $test_default_date = test_default_date::withTrashed()->find($id)->restore();
        return redirect("/DURC/test_soft_delete/$id")->with('status', 'Data Restored!');
    }
}
