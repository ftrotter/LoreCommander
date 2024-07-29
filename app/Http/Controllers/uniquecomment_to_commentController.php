<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=6c4ffa0637a3c6da97a6ad15db86da47
*/
namespace App\Http\Controllers;

use App\uniquecomment_to_comment;
use App\DURC\Controllers\uniquecomment_to_commentController as DURCParentController;
use Illuminate\Http\Request;

class uniquecomment_to_commentController extends DURCParentController
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
     * @param  \App\$uniquecomment_to_comment  $uniquecomment_to_comment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, uniquecomment_to_comment $uniquecomment_to_comment){
        // enter your stuff here if you want...
	return(parent::show($request, $uniquecomment_to_comment));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\uniquecomment_to_comment  $uniquecomment_to_comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, uniquecomment_to_comment $uniquecomment_to_comment, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($request, $uniquecomment_to_comment));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\uniquecomment_to_comment  $uniquecomment_to_comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, uniquecomment_to_comment $uniquecomment_to_comment){
        // enter your stuff here if you want...
	return(parent::update($request,$uniquecomment_to_comment));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\uniquecomment_to_comment  $uniquecomment_to_comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(uniquecomment_to_comment $uniquecomment_to_comment){
        // enter your stuff here if you want...
	return(parent::destroy($uniquecomment_to_comment));
    }

}
