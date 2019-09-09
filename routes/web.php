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

Route::get('changeCard/{channel_id}/{multiverse_id}', 'cardShowController@sendCardPush');
Route::get('showCard/{channel_id}', 'cardShowController@showCard');

Route::get('genericLinkerForm/{durc_type_left}/{durc_type_right}/{durc_type_link}','GenericLinker@linkForm');
Route::post('genericLinkerSave/{durc_type_left}/{durc_type_right}/{durc_type_link}','GenericLinker@linkSaver');

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

 
//DURC->	lore.artist
Route::resource("/DURC/artist", 'artistController');
Route::get("/DURC/json/artist/{artist_id}", 'artistController@jsonone');
Route::get("/DURC/json/artist/", 'artistController@jsonall');
Route::get("/DURC/searchjson/artist/", 'artistController@search');

 
//DURC->	lore.artistcredit
Route::resource("/DURC/artistcredit", 'artistcreditController');
Route::get("/DURC/json/artistcredit/{artistcredit_id}", 'artistcreditController@jsonone');
Route::get("/DURC/json/artistcredit/", 'artistcreditController@jsonall');
Route::get("/DURC/searchjson/artistcredit/", 'artistcreditController@search');

 
//DURC->	lore.atag
Route::resource("/DURC/atag", 'atagController');
Route::get("/DURC/json/atag/{atag_id}", 'atagController@jsonone');
Route::get("/DURC/json/atag/", 'atagController@jsonall');
Route::get("/DURC/searchjson/atag/", 'atagController@search');

 
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

 
//DURC->	lore.cardface_classofc_atag
Route::resource("/DURC/cardface_classofc_atag", 'cardface_classofc_atagController');
Route::get("/DURC/json/cardface_classofc_atag/{cardface_classofc_atag_id}", 'cardface_classofc_atagController@jsonone');
Route::get("/DURC/json/cardface_classofc_atag/", 'cardface_classofc_atagController@jsonall');
Route::get("/DURC/searchjson/cardface_classofc_atag/", 'cardface_classofc_atagController@search');

 
//DURC->	lore.cardface_person_atag
Route::resource("/DURC/cardface_person_atag", 'cardface_person_atagController');
Route::get("/DURC/json/cardface_person_atag/{cardface_person_atag_id}", 'cardface_person_atagController@jsonone');
Route::get("/DURC/json/cardface_person_atag/", 'cardface_person_atagController@jsonall');
Route::get("/DURC/searchjson/cardface_person_atag/", 'cardface_person_atagController@search');

 
//DURC->	lore.cardprice
Route::resource("/DURC/cardprice", 'cardpriceController');
Route::get("/DURC/json/cardprice/{cardprice_id}", 'cardpriceController@jsonone');
Route::get("/DURC/json/cardprice/", 'cardpriceController@jsonall');
Route::get("/DURC/searchjson/cardprice/", 'cardpriceController@search');

 
//DURC->	lore.classofc
Route::resource("/DURC/classofc", 'classofcController');
Route::get("/DURC/json/classofc/{classofc_id}", 'classofcController@jsonone');
Route::get("/DURC/json/classofc/", 'classofcController@jsonall');
Route::get("/DURC/searchjson/classofc/", 'classofcController@search');

 
//DURC->	lore.classofc_cardface
Route::resource("/DURC/classofc_cardface", 'classofc_cardfaceController');
Route::get("/DURC/json/classofc_cardface/{classofc_cardface_id}", 'classofc_cardfaceController@jsonone');
Route::get("/DURC/json/classofc_cardface/", 'classofc_cardfaceController@jsonall');
Route::get("/DURC/searchjson/classofc_cardface/", 'classofc_cardfaceController@search');

 
//DURC->	lore.classofc_classofc_vspack
Route::resource("/DURC/classofc_classofc_vspack", 'classofc_classofc_vspackController');
Route::get("/DURC/json/classofc_classofc_vspack/{classofc_classofc_vspack_id}", 'classofc_classofc_vspackController@jsonone');
Route::get("/DURC/json/classofc_classofc_vspack/", 'classofc_classofc_vspackController@jsonall');
Route::get("/DURC/searchjson/classofc_classofc_vspack/", 'classofc_classofc_vspackController@search');

 
//DURC->	lore.classofc_creature
Route::resource("/DURC/classofc_creature", 'classofc_creatureController');
Route::get("/DURC/json/classofc_creature/{classofc_creature_id}", 'classofc_creatureController@jsonone');
Route::get("/DURC/json/classofc_creature/", 'classofc_creatureController@jsonall');
Route::get("/DURC/searchjson/classofc_creature/", 'classofc_creatureController@search');

 
//DURC->	lore.creature
Route::resource("/DURC/creature", 'creatureController');
Route::get("/DURC/json/creature/{creature_id}", 'creatureController@jsonone');
Route::get("/DURC/json/creature/", 'creatureController@jsonall');
Route::get("/DURC/searchjson/creature/", 'creatureController@search');

 
//DURC->	lore.creature_cardface
Route::resource("/DURC/creature_cardface", 'creature_cardfaceController');
Route::get("/DURC/json/creature_cardface/{creature_cardface_id}", 'creature_cardfaceController@jsonone');
Route::get("/DURC/json/creature_cardface/", 'creature_cardfaceController@jsonall');
Route::get("/DURC/searchjson/creature_cardface/", 'creature_cardfaceController@search');

 
//DURC->	lore.mtgset
Route::resource("/DURC/mtgset", 'mtgsetController');
Route::get("/DURC/json/mtgset/{mtgset_id}", 'mtgsetController@jsonone');
Route::get("/DURC/json/mtgset/", 'mtgsetController@jsonall');
Route::get("/DURC/searchjson/mtgset/", 'mtgsetController@search');

 
//DURC->	lore.pack
Route::resource("/DURC/pack", 'packController');
Route::get("/DURC/json/pack/{pack_id}", 'packController@jsonone');
Route::get("/DURC/json/pack/", 'packController@jsonall');
Route::get("/DURC/searchjson/pack/", 'packController@search');

 
//DURC->	lore.person
Route::resource("/DURC/person", 'personController');
Route::get("/DURC/json/person/{person_id}", 'personController@jsonone');
Route::get("/DURC/json/person/", 'personController@jsonall');
Route::get("/DURC/searchjson/person/", 'personController@search');

 
//DURC->	lore.person_classofc_cardface
Route::resource("/DURC/person_classofc_cardface", 'person_classofc_cardfaceController');
Route::get("/DURC/json/person_classofc_cardface/{person_classofc_cardface_id}", 'person_classofc_cardfaceController@jsonone');
Route::get("/DURC/json/person_classofc_cardface/", 'person_classofc_cardfaceController@jsonall');
Route::get("/DURC/searchjson/person_classofc_cardface/", 'person_classofc_cardfaceController@search');

 
//DURC->	lore.person_classofc_tag
Route::resource("/DURC/person_classofc_tag", 'person_classofc_tagController');
Route::get("/DURC/json/person_classofc_tag/{person_classofc_tag_id}", 'person_classofc_tagController@jsonone');
Route::get("/DURC/json/person_classofc_tag/", 'person_classofc_tagController@jsonall');
Route::get("/DURC/searchjson/person_classofc_tag/", 'person_classofc_tagController@search');

 
//DURC->	lore.person_creature_tag
Route::resource("/DURC/person_creature_tag", 'person_creature_tagController');
Route::get("/DURC/json/person_creature_tag/{person_creature_tag_id}", 'person_creature_tagController@jsonone');
Route::get("/DURC/json/person_creature_tag/", 'person_creature_tagController@jsonall');
Route::get("/DURC/searchjson/person_creature_tag/", 'person_creature_tagController@search');

 
//DURC->	lore.person_strategy_strategytag
Route::resource("/DURC/person_strategy_strategytag", 'person_strategy_strategytagController');
Route::get("/DURC/json/person_strategy_strategytag/{person_strategy_strategytag_id}", 'person_strategy_strategytagController@jsonone');
Route::get("/DURC/json/person_strategy_strategytag/", 'person_strategy_strategytagController@jsonall');
Route::get("/DURC/searchjson/person_strategy_strategytag/", 'person_strategy_strategytagController@search');

 
//DURC->	lore.person_strategy_tag
Route::resource("/DURC/person_strategy_tag", 'person_strategy_tagController');
Route::get("/DURC/json/person_strategy_tag/{person_strategy_tag_id}", 'person_strategy_tagController@jsonone');
Route::get("/DURC/json/person_strategy_tag/", 'person_strategy_tagController@jsonall');
Route::get("/DURC/searchjson/person_strategy_tag/", 'person_strategy_tagController@search');

 
//DURC->	lore.pricetype
Route::resource("/DURC/pricetype", 'pricetypeController');
Route::get("/DURC/json/pricetype/{pricetype_id}", 'pricetypeController@jsonone');
Route::get("/DURC/json/pricetype/", 'pricetypeController@jsonall');
Route::get("/DURC/searchjson/pricetype/", 'pricetypeController@search');

 
//DURC->	lore.scanhistory
Route::resource("/DURC/scanhistory", 'scanhistoryController');
Route::get("/DURC/json/scanhistory/{scanhistory_id}", 'scanhistoryController@jsonone');
Route::get("/DURC/json/scanhistory/", 'scanhistoryController@jsonall');
Route::get("/DURC/searchjson/scanhistory/", 'scanhistoryController@search');

 
//DURC->	lore.strategy
Route::resource("/DURC/strategy", 'strategyController');
Route::get("/DURC/json/strategy/{strategy_id}", 'strategyController@jsonone');
Route::get("/DURC/json/strategy/", 'strategyController@jsonall');
Route::get("/DURC/searchjson/strategy/", 'strategyController@search');

 
//DURC->	lore.strategytag
Route::resource("/DURC/strategytag", 'strategytagController');
Route::get("/DURC/json/strategytag/{strategytag_id}", 'strategytagController@jsonone');
Route::get("/DURC/json/strategytag/", 'strategytagController@jsonall');
Route::get("/DURC/searchjson/strategytag/", 'strategytagController@search');

 
//DURC->	lore.tag
Route::resource("/DURC/tag", 'tagController');
Route::get("/DURC/json/tag/{tag_id}", 'tagController@jsonone');
Route::get("/DURC/json/tag/", 'tagController@jsonall');
Route::get("/DURC/searchjson/tag/", 'tagController@search');

 
//DURC->	lore.vspack
Route::resource("/DURC/vspack", 'vspackController');
Route::get("/DURC/json/vspack/{vspack_id}", 'vspackController@jsonone');
Route::get("/DURC/json/vspack/", 'vspackController@jsonall');
Route::get("/DURC/searchjson/vspack/", 'vspackController@search');




