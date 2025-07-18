<?php

namespace App\DURC\Controllers;

use App\uniquecomment_cluster;
use Illuminate\Http\Request;
use ftrotter\DURC\DURC;
use ftrotter\DURC\DURCController;
use Illuminate\Support\Facades\View;
use ftrotter\DURC\DURCInvalidDataException;

class uniquecomment_clusterController extends DURCController
{


	public $view_data = [];

	protected static $hidden_fields_array = [

	];


	public function getWithArgumentArray(){
		
		$with_summary_array = [];
		$with_summary_array[] = "unique_comment:id,".\App\comment::getNameField();
		$with_summary_array[] = "other_unique_comment:id,".\App\comment::getNameField();

		return($with_summary_array);
		
	}


	private function _get_index_list(Request $request){

		$return_me = [];

		$with_argument = $this->getWithArgumentArray();

		$these = uniquecomment_cluster::with($with_argument)->paginate(100);

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

                                        if ( isset( uniquecomment_cluster::$field_type_map[$lowest_key] ) ) {
                                            $field_type = uniquecomment_cluster::$field_type_map[ $lowest_key ];
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = DURC::formatForDisplay( $field_type, $lowest_key, $lowest_data, true );
                                        } else {
                                            $return_me_data[$data_i][$key .'_id_DURClabel'] = $lowest_data;
                                        }
                                }
                        }

                        if ( isset( uniquecomment_cluster::$field_type_map[$key] ) ) {
                            $field_type = uniquecomment_cluster::$field_type_map[ $key ];
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
                $search_fields = uniquecomment_cluster::getSearchFields();

		//sometimes there is an image field that contains the url of an image
		//but this is typically null
		$img_field = uniquecomment_cluster::getImgField();

		$where_sql = '';
		$or = '';
		foreach($search_fields as $this_field){
			$where_sql .= " $or $this_field LIKE '%$q%'  ";
			$or = ' OR ';
		}

		$query = uniquecomment_cluster::whereRaw($where_sql);
		            
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
     * @param  \App\uniquecomment_cluster  $uniquecomment_cluster
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
        $durc_template_results = view('DURC.uniquecomment_cluster.index',$this->view_data);        
        return view($main_template_name,['content' => $durc_template_results]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */ 
    public function store(Request $request){

        $myNewuniquecomment_cluster = new uniquecomment_cluster();

        //the games we play to easily auto-generate code..
        $tmp_uniquecomment_cluster = $myNewuniquecomment_cluster;
        
        $tmp_uniquecomment_cluster->unique_comment_id = $request->unique_comment_id;
        $tmp_uniquecomment_cluster->other_unique_comment_id = $request->other_unique_comment_id;
        $tmp_uniquecomment_cluster->score = $request->score;
        $tmp_uniquecomment_cluster->diff_text = $request->diff_text;


        try {
            $tmp_uniquecomment_cluster->save();

        $new_id = $myNewuniquecomment_cluster->id;
        return redirect("/DURC/uniquecomment_cluster/$new_id")->with('status', 'Data Saved!');
        } catch (DURCInvalidDataException $e) {
            return back()->withInput()->with('errors', $tmp_uniquecomment_cluster->getErrors());

        } catch (\Exception $e) {
            return back()->withInput()->with('status', 'There was an error in your data: '.$e->getMessage());

        }

        
    }//end store function

    /**
     * Display the specified resource.
     * @param  \App\$uniquecomment_cluster  $uniquecomment_cluster
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, uniquecomment_cluster $uniquecomment_cluster){
	return($this->edit($request, $uniquecomment_cluster));
    }

    /**
     * Get a json version of the given object 
     * @param  \App\uniquecomment_cluster  $uniquecomment_cluster
     * @return JSON of the object
     */
    public function jsonone(Request $request, $uniquecomment_cluster_id){
		$uniquecomment_cluster = \App\uniquecomment_cluster::find($uniquecomment_cluster_id);
		if ($uniquecomment_cluster === null) {
            return response()->json("uniquecomment_cluster with id = {$uniquecomment_cluster_id} Not Found", 404);
        }
		$uniquecomment_cluster = $uniquecomment_cluster->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
		$return_me_array = $uniquecomment_cluster->toArray();
		$search_fields = \App\uniquecomment_cluster::getSearchFields();

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
		$img_uri_field = \App\uniquecomment_cluster::getImgField();
		if(!is_null($img_uri_field)){ //then this object has an image link..
			if(!isset($return_me_array['card_img_top'])){ //allow the user to use this as a field without pestering..
				$return_me_array['card_img_top'] = $uniquecomment_cluster->$img_uri_field;
			}
		}

		//lets get a card_body from the DURC mode class!!
		if(!isset($return_me_array['card_body'])){ //allow the user to use this as a field without pestering..
			//this is simply the name unless someone has put work into this...
			$return_me_array['card_body'] = $uniquecomment_cluster->getCardBody();
		}
		
		return response()->json($return_me_array);
 	}


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        // but really, we are just going to edit a new object..
        $new_instance = new uniquecomment_cluster();
        return $this->edit($request, $new_instance); 
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\uniquecomment_cluster  $uniquecomment_cluster
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, uniquecomment_cluster $uniquecomment_cluster){

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
        
        foreach ( uniquecomment_cluster::$field_type_map as $column_name => $field_type ) {
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
    
        if($uniquecomment_cluster->exists){	
    
      		//well lets properly eager load this object with a refresh to load all of the related things
      		$uniquecomment_cluster = $uniquecomment_cluster->fresh_with_relations(); //this is a custom function from DURCModel. you can control what gets autoloaded by modifying the DURC_selfish_with contents on your customized models
    
      		//put the contents into the view...
		//we have to do this even if the object is new, because sometimes the variable is set from a GET or POST request... 
      		foreach($uniquecomment_cluster->toArray() as $key => $value){
                
                	if (array_key_exists($key, $request->old())) {
                    		$input = $request->old($key);
                	} else {
                    		$input = $value;
                	}
            
                	if ( isset( uniquecomment_cluster::$field_type_map[$key] ) ) {
                		$field_type = uniquecomment_cluster::$field_type_map[ $key ];
                		$this->view_data[$key] = DURC::formatForDisplay( $field_type, $key, $input );
        		} else {
                		$this->view_data[$key] = $input;
        		}
                
       	 		// If this is a nullable field, see whether null checkbox should be checked by default
       	 		if ($uniquecomment_cluster->isFieldNullable($key) &&
                		$input == null) {
                		$this->view_data["{$key}_checked"] = "checked";
        		}
       		}
    
            	//what is this object called?
            	$name_field = $uniquecomment_cluster->_getBestName();
            	$this->view_data['is_new'] = false;
            	$this->view_data['durc_instance_name'] = $uniquecomment_cluster->$name_field;

        }else{
		//this has not been saved yet, but we still want to honor GET and POST variables etc. 
        	$uniquecomment_cluster = new uniquecomment_cluster();
		$params = $request->all(); //this will include GET and POST variables, etc
		$uniquecomment_cluster->fill($params);  //this will initialize the contents of the object with anything in the GET etc.
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
        
    
        $durc_template_results = view('DURC.uniquecomment_cluster.edit',$this->view_data);        
        return view($main_template_name,['content' => $durc_template_results]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\uniquecomment_cluster  $uniquecomment_cluster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, uniquecomment_cluster $uniquecomment_cluster){

        $tmp_uniquecomment_cluster = $uniquecomment_cluster;
        
        $tmp_uniquecomment_cluster->unique_comment_id = $request->unique_comment_id;
        $tmp_uniquecomment_cluster->other_unique_comment_id = $request->other_unique_comment_id;
        $tmp_uniquecomment_cluster->score = $request->score;
        $tmp_uniquecomment_cluster->diff_text = $request->diff_text;

        $id = $uniquecomment_cluster->id;
        
        try {
            $tmp_uniquecomment_cluster->save();

            return redirect("/DURC/uniquecomment_cluster/$id")->with('status', 'Data Saved!');
        } catch (DURCInvalidDataException $e) {
            return back()->withInput()->with('errors', $tmp_uniquecomment_cluster->getErrors());

        } catch (\Exception $e) {
            return back()->withInput()->with('status', 'There was an error in your data: '.$e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\uniquecomment_cluster  $uniquecomment_cluster
     * @return \Illuminate\Http\Response
     */
    public function destroy(uniquecomment_cluster $uniquecomment_cluster){
	    return uniquecomment_cluster::destroy( $uniquecomment_cluster->id );  
    }
    
    /**
     * Restore the specified resource from storage.
     * @param  $id ID of resource
     * @return \Illuminate\Http\Response
     */
    public function restore( $id )
    {
        $uniquecomment_cluster = uniquecomment_cluster::withTrashed()->find($id)->restore();
        return redirect("/DURC/test_soft_delete/$id")->with('status', 'Data Restored!');
    }
}
