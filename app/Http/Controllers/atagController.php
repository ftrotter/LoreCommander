<?php
/*
Note: because this file was signed, everyting orignally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=b8513532365a1600654528f3e0ac9014
*/
namespace App\Http\Controllers;

use App\atag;
use App\DURC\Controllers\atagController as DURCParentController;
use Illuminate\Http\Request;

class atagController extends DURCParentController
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
     * @param  \App\$atag  $atag
     * @return \Illuminate\Http\Response
     */
    public function show(atag $atag){
        // enter your stuff here if you want...
	return(parent::show($atag));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\atag  $atag
     * @return \Illuminate\Http\Response
     */
    public function edit(atag $atag, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($atag));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\atag  $atag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, atag $atag){
        // enter your stuff here if you want...
	return(parent::update($request,$atag));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\atag  $atag
     * @return \Illuminate\Http\Response
     */
    public function destroy(atag $atag){
        // enter your stuff here if you want...
	return(parent::destroy($atag));
    }

}
