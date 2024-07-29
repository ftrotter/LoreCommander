<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=121f48e3a157ea8d1778dad814b97e31
*/
namespace App\Http\Controllers;

use App\uniquecomment_cluster;
use App\DURC\Controllers\uniquecomment_clusterController as DURCParentController;
use Illuminate\Http\Request;

class uniquecomment_clusterController extends DURCParentController
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
     * @param  \App\$uniquecomment_cluster  $uniquecomment_cluster
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, uniquecomment_cluster $uniquecomment_cluster){
        // enter your stuff here if you want...
	return(parent::show($request, $uniquecomment_cluster));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\uniquecomment_cluster  $uniquecomment_cluster
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, uniquecomment_cluster $uniquecomment_cluster, $is_new = false){
        // enter your stuff here if you want...
	return(parent::edit($request, $uniquecomment_cluster));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\uniquecomment_cluster  $uniquecomment_cluster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, uniquecomment_cluster $uniquecomment_cluster){
        // enter your stuff here if you want...
	return(parent::update($request,$uniquecomment_cluster));
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\uniquecomment_cluster  $uniquecomment_cluster
     * @return \Illuminate\Http\Response
     */
    public function destroy(uniquecomment_cluster $uniquecomment_cluster){
        // enter your stuff here if you want...
	return(parent::destroy($uniquecomment_cluster));
    }

}
