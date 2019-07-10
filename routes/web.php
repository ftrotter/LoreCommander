<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/mockup',function () {
        $content = view('dashboard_mockup');
        $test_data = ['content' => $content];
        return view('main_html',$test_data);
});


/*
This is an auto generated route file from DURC
this will be automatically overwritten by future DURC runs.


*/

 
//DURC->	lore.creature
Route::resource("/DURC/creature", 'creatureController');
Route::get("/DURC/json/creature/{creature_id}", 'creatureController@jsonone');
Route::get("/DURC/json/creature/", 'creatureController@jsonall');
Route::get("/DURC/searchjson/creature/", 'creatureController@search');

 
//DURC->	lore.mtgset
Route::resource("/DURC/mtgset", 'mtgsetController');
Route::get("/DURC/json/mtgset/{mtgset_id}", 'mtgsetController@jsonone');
Route::get("/DURC/json/mtgset/", 'mtgsetController@jsonall');
Route::get("/DURC/searchjson/mtgset/", 'mtgsetController@search');

 
//DURC->	lore.person
Route::resource("/DURC/person", 'personController');
Route::get("/DURC/json/person/{person_id}", 'personController@jsonone');
Route::get("/DURC/json/person/", 'personController@jsonall');
Route::get("/DURC/searchjson/person/", 'personController@search');

 
//DURC->	lore.person_creature_relation
Route::resource("/DURC/person_creature_relation", 'person_creature_relationController');
Route::get("/DURC/json/person_creature_relation/{person_creature_relation_id}", 'person_creature_relationController@jsonone');
Route::get("/DURC/json/person_creature_relation/", 'person_creature_relationController@jsonall');
Route::get("/DURC/searchjson/person_creature_relation/", 'person_creature_relationController@search');

 
//DURC->	lore.relation
Route::resource("/DURC/relation", 'relationController');
Route::get("/DURC/json/relation/{relation_id}", 'relationController@jsonone');
Route::get("/DURC/json/relation/", 'relationController@jsonall');
Route::get("/DURC/searchjson/relation/", 'relationController@search');




