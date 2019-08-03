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

Route::get('changeCard/{channel_id}/{scryfall_id}', 'cardShowController@sendCardPush');
Route::get('showCard/{channel_id}', 'cardShowController@showCard');


Route::get('pusher', function () {


        $app_key = config('broadcasting.connections.pusher.key');
        $app_secret = config('broadcasting.connections.pusher.secret');
        $app_id = config('broadcasting.connections.pusher.app_id');
        $cluster = config('broadcasting.connections.pusher.options.cluster');

        echo "Creating pusher with \n\tapp_key:$app_key\n\tapp_secret:$app_secret\n\tapp_id:$app_id\n\tapp_cluster:$cluster\n";

        $pusher = new \Pusher\Pusher($app_key, $app_secret, $app_id,['cluster' => $cluster]);

        $pusher->trigger( 'in_closure', 'my_event', 'hello world' );

        //return view('pusher_test');

});

/*
This is an auto generated route file from DURC
this will be automatically overwritten by future DURC runs.


*/

 
//DURC->	lore.card
Route::resource("/DURC/card", 'cardController');
Route::get("/DURC/json/card/{card_id}", 'cardController@jsonone');
Route::get("/DURC/json/card/", 'cardController@jsonall');
Route::get("/DURC/searchjson/card/", 'cardController@search');

 
//DURC->	lore.cardface
Route::resource("/DURC/cardface", 'cardfaceController');
Route::get("/DURC/json/cardface/{cardface_id}", 'cardfaceController@jsonone');
Route::get("/DURC/json/cardface/", 'cardfaceController@jsonall');
Route::get("/DURC/searchjson/cardface/", 'cardfaceController@search');

 
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




