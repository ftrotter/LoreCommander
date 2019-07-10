<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=04bed02229b31bce21e2e9d58047ef70
*/
namespace App\Http\Controllers;

use App\person;
use App\DURC\Controllers\personController as DURCParentController;
use Illuminate\Http\Request;

class personController extends DURCParentController
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        // enter your stuff here if you want...

	//anything you put into $this->view_data will be available in the view...
	//$this->view_data['how_cool_is_fred'] = 'very'
	//will mean that you can use {{how_cool_is_fred}} etc etc..
	//remember to look in /resources/views/DURC
	//to find the DURC generated views. Once you override those views..
	//DURC will not overwrite them anymore... same thing with this file.. you can change it and it will not
	//be overwritten by subsequent files...

	return(parent::index($request));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create(){
        // enter your stuff here if you want...
	return(parent::create());
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // enter your stuff here if you want...
	return(parent::store($request));
    }

    /**
     * Display the specified resource.
     * @param  \App\$person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(person $person){
        // enter your stuff here if you want...
	return(parent::show($person));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(person $person, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($person));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, person $person){
        // enter your stuff here if you want...
	return(parent::update($request,$person));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(person $person){
        // enter your stuff here if you want...
	return(parent::destroy($person));
    }

}
