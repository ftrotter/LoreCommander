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

 
//DURC->	lore.cardface_classofcreature_atag
Route::resource("/DURC/cardface_classofcreature_atag", 'cardface_classofcreature_atagController');
Route::get("/DURC/json/cardface_classofcreature_atag/{cardface_classofcreature_atag_id}", 'cardface_classofcreature_atagController@jsonone');
Route::get("/DURC/json/cardface_classofcreature_atag/", 'cardface_classofcreature_atagController@jsonall');
Route::get("/DURC/searchjson/cardface_classofcreature_atag/", 'cardface_classofcreature_atagController@search');

 
//DURC->	lore.classofcreature
Route::resource("/DURC/classofcreature", 'classofcreatureController');
Route::get("/DURC/json/classofcreature/{classofcreature_id}", 'classofcreatureController@jsonone');
Route::get("/DURC/json/classofcreature/", 'classofcreatureController@jsonall');
Route::get("/DURC/searchjson/classofcreature/", 'classofcreatureController@search');

 
//DURC->	lore.classofcreature_cardface
Route::resource("/DURC/classofcreature_cardface", 'classofcreature_cardfaceController');
Route::get("/DURC/json/classofcreature_cardface/{classofcreature_cardface_id}", 'classofcreature_cardfaceController@jsonone');
Route::get("/DURC/json/classofcreature_cardface/", 'classofcreature_cardfaceController@jsonall');
Route::get("/DURC/searchjson/classofcreature_cardface/", 'classofcreature_cardfaceController@search');

 
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

 
//DURC->	lore.person_classofcreature_tag
Route::resource("/DURC/person_classofcreature_tag", 'person_classofcreature_tagController');
Route::get("/DURC/json/person_classofcreature_tag/{person_classofcreature_tag_id}", 'person_classofcreature_tagController@jsonone');
Route::get("/DURC/json/person_classofcreature_tag/", 'person_classofcreature_tagController@jsonall');
Route::get("/DURC/searchjson/person_classofcreature_tag/", 'person_classofcreature_tagController@search');

 
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

