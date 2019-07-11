<?php
/*
	This test route is automatically added.
	IF you would like to quickly see and test all of the index routes that are generated by DURC
	to use: http://[baseUrl]/durctest
	
	To remove routes from production, remove the require for this file from the register() method
	of the DURCServiceProvider.

*/

//This closure lists all of the index routes that DURC knows about...
Route::get('durctest', function () {
    $route_list = [ 




 			'/DURC/card', //from: lore.card 
 			'/DURC/card/create', //from: lore.card 
 			'/DURC/card/1', //from: lore.card 
 			'/DURC/card/1/edit', //from: lore.card 
 			'/DURC/cardface', //from: lore.cardface 
 			'/DURC/cardface/create', //from: lore.cardface 
 			'/DURC/cardface/1', //from: lore.cardface 
 			'/DURC/cardface/1/edit', //from: lore.cardface 
 			'/DURC/creature', //from: lore.creature 
 			'/DURC/creature/create', //from: lore.creature 
 			'/DURC/creature/1', //from: lore.creature 
 			'/DURC/creature/1/edit', //from: lore.creature 
 			'/DURC/mtgset', //from: lore.mtgset 
 			'/DURC/mtgset/create', //from: lore.mtgset 
 			'/DURC/mtgset/1', //from: lore.mtgset 
 			'/DURC/mtgset/1/edit', //from: lore.mtgset 
 			'/DURC/person', //from: lore.person 
 			'/DURC/person/create', //from: lore.person 
 			'/DURC/person/1', //from: lore.person 
 			'/DURC/person/1/edit', //from: lore.person 
 			'/DURC/person_creature_relation', //from: lore.person_creature_relation 
 			'/DURC/person_creature_relation/create', //from: lore.person_creature_relation 
 			'/DURC/person_creature_relation/1', //from: lore.person_creature_relation 
 			'/DURC/person_creature_relation/1/edit', //from: lore.person_creature_relation 
 			'/DURC/relation', //from: lore.relation 
 			'/DURC/relation/create', //from: lore.relation 
 			'/DURC/relation/1', //from: lore.relation 
 			'/DURC/relation/1/edit', //from: lore.relation 


	]; //end route_list

	$html = '<html><head><title>DURC Test Page</title><body><h1>DURC Test Page</h1><h3>DO NOT USE IN PRODUCTION!!!</h3>';

	$html .= '<ul>';

	foreach($route_list as $this_relative_link){
		$html  .= "<li><a href='$this_relative_link'>$this_relative_link </a> </li> ";
	}

	$html .= '</ul></body></html>';
	return $html;
}); //end DURC test route closure

Route::get('/',function () {
	$test_data = ['content' => '<h1>This is test content</h1>'];
	return view('DURC.durc_html',$test_data);
});