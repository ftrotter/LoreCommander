<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=49792d81bd2c56ffea5e696f691d3241
*/
namespace App\Http\Controllers;

use App\charactertest;
use App\DURC\Controllers\charactertestController as DURCParentController;
use Illuminate\Http\Request;

class charactertestController extends DURCParentController
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
    public function create(Request $request){
        // enter your stuff here if you want...
	return(parent::create($request));
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
     * @param  \App\$charactertest  $charactertest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, charactertest $charactertest){
        // enter your stuff here if you want...
	return(parent::show($request, $charactertest));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\charactertest  $charactertest
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, charactertest $charactertest, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($request, $charactertest));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\charactertest  $charactertest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, charactertest $charactertest){
        // enter your stuff here if you want...
	return(parent::update($request,$charactertest));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\charactertest  $charactertest
     * @return \Illuminate\Http\Response
     */
    public function destroy(charactertest $charactertest){
        // enter your stuff here if you want...
	return(parent::destroy($charactertest));
    }

}
