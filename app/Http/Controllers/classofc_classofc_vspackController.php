<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=ea6eb8fd461eb4a1edae274c5b9b8515
*/
namespace App\Http\Controllers;

use App\classofc_classofc_vspack;
use App\DURC\Controllers\classofc_classofc_vspackController as DURCParentController;
use Illuminate\Http\Request;

class classofc_classofc_vspackController extends DURCParentController
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
     * @param  \App\$classofc_classofc_vspack  $classofc_classofc_vspack
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, classofc_classofc_vspack $classofc_classofc_vspack){
        // enter your stuff here if you want...
	return(parent::show($request, $classofc_classofc_vspack));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\classofc_classofc_vspack  $classofc_classofc_vspack
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, classofc_classofc_vspack $classofc_classofc_vspack, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($request, $classofc_classofc_vspack));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\classofc_classofc_vspack  $classofc_classofc_vspack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, classofc_classofc_vspack $classofc_classofc_vspack){
        // enter your stuff here if you want...
	return(parent::update($request,$classofc_classofc_vspack));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\classofc_classofc_vspack  $classofc_classofc_vspack
     * @return \Illuminate\Http\Response
     */
    public function destroy(classofc_classofc_vspack $classofc_classofc_vspack){
        // enter your stuff here if you want...
	return(parent::destroy($classofc_classofc_vspack));
    }

}
