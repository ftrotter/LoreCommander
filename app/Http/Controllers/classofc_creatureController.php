<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=64d5b7776946cefb048cb9ae11d8edab
*/
namespace App\Http\Controllers;

use App\classofc_creature;
use App\DURC\Controllers\classofc_creatureController as DURCParentController;
use Illuminate\Http\Request;

class classofc_creatureController extends DURCParentController
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
     * @param  \App\$classofc_creature  $classofc_creature
     * @return \Illuminate\Http\Response
     */
    public function show(classofc_creature $classofc_creature){
        // enter your stuff here if you want...
	return(parent::show($classofc_creature));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\classofc_creature  $classofc_creature
     * @return \Illuminate\Http\Response
     */
    public function edit(classofc_creature $classofc_creature, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($classofc_creature));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\classofc_creature  $classofc_creature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, classofc_creature $classofc_creature){
        // enter your stuff here if you want...
	return(parent::update($request,$classofc_creature));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\classofc_creature  $classofc_creature
     * @return \Illuminate\Http\Response
     */
    public function destroy(classofc_creature $classofc_creature){
        // enter your stuff here if you want...
	return(parent::destroy($classofc_creature));
    }

}
