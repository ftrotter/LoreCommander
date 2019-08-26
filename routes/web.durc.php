<?php
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

 
//DURC->	lore.classofcreature
Route::resource("/DURC/classofcreature", 'classofcreatureController');
Route::get("/DURC/json/classofcreature/{classofcreature_id}", 'classofcreatureController@jsonone');
Route::get("/DURC/json/classofcreature/", 'classofcreatureController@jsonall');
Route::get("/DURC/searchjson/classofcreature/", 'classofcreatureController@search');

 
//DURC->	lore.classofcreature_copy
Route::resource("/DURC/classofcreature_copy", 'classofcreature_copyController');
Route::get("/DURC/json/classofcreature_copy/{classofcreature_copy_id}", 'classofcreature_copyController@jsonone');
Route::get("/DURC/json/classofcreature_copy/", 'classofcreature_copyController@jsonall');
Route::get("/DURC/searchjson/classofcreature_copy/", 'classofcreature_copyController@search');

 
//DURC->	lore.classofcreature_creature
Route::resource("/DURC/classofcreature_creature", 'classofcreature_creatureController');
Route::get("/DURC/json/classofcreature_creature/{classofcreature_creature_id}", 'classofcreature_creatureController@jsonone');
Route::get("/DURC/json/classofcreature_creature/", 'classofcreature_creatureController@jsonall');
Route::get("/DURC/searchjson/classofcreature_creature/", 'classofcreature_creatureController@search');

 
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

 
//DURC->	lore.person_creature_tag
Route::resource("/DURC/person_creature_tag", 'person_creature_tagController');
Route::get("/DURC/json/person_creature_tag/{person_creature_tag_id}", 'person_creature_tagController@jsonone');
Route::get("/DURC/json/person_creature_tag/", 'person_creature_tagController@jsonall');
Route::get("/DURC/searchjson/person_creature_tag/", 'person_creature_tagController@search');

 
//DURC->	lore.tag
Route::resource("/DURC/tag", 'tagController');
Route::get("/DURC/json/tag/{tag_id}", 'tagController@jsonone');
Route::get("/DURC/json/tag/", 'tagController@jsonall');
Route::get("/DURC/searchjson/tag/", 'tagController@search');

