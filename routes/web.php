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

Route::get('pod_matrix', 'DraftPodMatrix@show_matrix');



Route::get('changeCard/{channel_id}/{multiverse_id}', 'cardShowController@sendCardPush');
Route::get('showCard/{channel_id}', 'cardShowController@showCard');
Route::get('showJustCard/{channel_id}', 'cardShowController@showJustCard');
Route::get('showArtCard/{channel_id}', 'cardShowController@showArtCard');

Route::get('genericLinkerForm/{durc_type_left}/{durc_type_right}/{durc_type_link}','GenericLinker@linkForm');
Route::post('genericLinkerSave/{durc_type_left}/{durc_type_right}/{durc_type_link}','GenericLinker@linkSaver');


Route::get('scryProxy/cards/multiverse/{multiverse_id}', 'ScryFallAPIProxy@cardFromMulti');


Route::get('pusher', function () {


        $app_key = config('broadcasting.connections.pusher.key');
        $app_secret = config('broadcasting.connections.pusher.secret');
        $app_id = config('broadcasting.connections.pusher.app_id');
        $cluster = config('broadcasting.connections.pusher.options.cluster');

	//echo "Creating pusher with \n\tapp_key:$app_key\n\tapp_secret:$app_secret\n\tapp_id:$app_id\n\tapp_cluster:$cluster\n";

        $pusher = new \Pusher\Pusher($app_key, $app_secret, $app_id,['cluster' => $cluster]);

        $pusher->trigger( 'in_closure', 'my_event', 'hello world' );

        //return view('pusher_test');

});

/*
This is an auto generated route file from DURC
this will be automatically overwritten by future DURC runs.


*/

 
//DURC->	DURC_aaa.author
Route::resource("/DURC/author", 'authorController');
Route::get("/DURC/json/author/{author_id}", 'authorController@jsonone');
Route::get("/DURC/json/author/", 'authorController@jsonall');
Route::get("/DURC/searchjson/author/", 'authorController@search');

 
//DURC->	DURC_aaa.author_book
Route::resource("/DURC/author_book", 'author_bookController');
Route::get("/DURC/json/author_book/{author_book_id}", 'author_bookController@jsonone');
Route::get("/DURC/json/author_book/", 'author_bookController@jsonall');
Route::get("/DURC/searchjson/author_book/", 'author_bookController@search');

 
//DURC->	DURC_aaa.authortype
Route::resource("/DURC/authortype", 'authortypeController');
Route::get("/DURC/json/authortype/{authortype_id}", 'authortypeController@jsonone');
Route::get("/DURC/json/authortype/", 'authortypeController@jsonall');
Route::get("/DURC/searchjson/authortype/", 'authortypeController@search');

 
//DURC->	DURC_aaa.book
Route::resource("/DURC/book", 'bookController');
Route::get("/DURC/json/book/{book_id}", 'bookController@jsonone');
Route::get("/DURC/json/book/", 'bookController@jsonall');
Route::get("/DURC/searchjson/book/", 'bookController@search');

 
//DURC->	DURC_aaa.characterTest
Route::resource("/DURC/charactertest", 'charactertestController');
Route::get("/DURC/json/charactertest/{charactertest_id}", 'charactertestController@jsonone');
Route::get("/DURC/json/charactertest/", 'charactertestController@jsonall');
Route::get("/DURC/searchjson/charactertest/", 'charactertestController@search');

 
//DURC->	DURC_aaa.comment
Route::resource("/DURC/comment", 'commentController');
Route::get("/DURC/json/comment/{comment_id}", 'commentController@jsonone');
Route::get("/DURC/json/comment/", 'commentController@jsonall');
Route::get("/DURC/searchjson/comment/", 'commentController@search');

 
//DURC->	DURC_aaa.donation
Route::resource("/DURC/donation", 'donationController');
Route::get("/DURC/json/donation/{donation_id}", 'donationController@jsonone');
Route::get("/DURC/json/donation/", 'donationController@jsonall');
Route::get("/DURC/searchjson/donation/", 'donationController@search');
Route::get("/DURC/donation/restore/{id}", 'donationController@restore');
 
//DURC->	DURC_aaa.filterTest
Route::resource("/DURC/filtertest", 'filtertestController');
Route::get("/DURC/json/filtertest/{filtertest_id}", 'filtertestController@jsonone');
Route::get("/DURC/json/filtertest/", 'filtertestController@jsonall');
Route::get("/DURC/searchjson/filtertest/", 'filtertestController@search');

 
//DURC->	DURC_aaa.foreignkeytestgizmo
Route::resource("/DURC/foreignkeytestgizmo", 'foreignkeytestgizmoController');
Route::get("/DURC/json/foreignkeytestgizmo/{foreignkeytestgizmo_id}", 'foreignkeytestgizmoController@jsonone');
Route::get("/DURC/json/foreignkeytestgizmo/", 'foreignkeytestgizmoController@jsonall');
Route::get("/DURC/searchjson/foreignkeytestgizmo/", 'foreignkeytestgizmoController@search');
Route::get("/DURC/foreignkeytestgizmo/restore/{id}", 'foreignkeytestgizmoController@restore');
 
//DURC->	DURC_aaa.foreignkeytestthingy
Route::resource("/DURC/foreignkeytestthingy", 'foreignkeytestthingyController');
Route::get("/DURC/json/foreignkeytestthingy/{foreignkeytestthingy_id}", 'foreignkeytestthingyController@jsonone');
Route::get("/DURC/json/foreignkeytestthingy/", 'foreignkeytestthingyController@jsonall');
Route::get("/DURC/searchjson/foreignkeytestthingy/", 'foreignkeytestthingyController@search');
Route::get("/DURC/foreignkeytestthingy/restore/{id}", 'foreignkeytestthingyController@restore');
 
//DURC->	DURC_aaa.funnything
Route::resource("/DURC/funnything", 'funnythingController');
Route::get("/DURC/json/funnything/{funnything_id}", 'funnythingController@jsonone');
Route::get("/DURC/json/funnything/", 'funnythingController@jsonall');
Route::get("/DURC/searchjson/funnything/", 'funnythingController@search');

 
//DURC->	DURC_aaa.magicField
Route::resource("/DURC/magicfield", 'magicfieldController');
Route::get("/DURC/json/magicfield/{magicfield_id}", 'magicfieldController@jsonone');
Route::get("/DURC/json/magicfield/", 'magicfieldController@jsonall');
Route::get("/DURC/searchjson/magicfield/", 'magicfieldController@search');
Route::get("/DURC/magicfield/restore/{id}", 'magicfieldController@restore');
 
//DURC->	DURC_aaa.post
Route::resource("/DURC/post", 'postController');
Route::get("/DURC/json/post/{post_id}", 'postController@jsonone');
Route::get("/DURC/json/post/", 'postController@jsonall');
Route::get("/DURC/searchjson/post/", 'postController@search');

 
//DURC->	DURC_aaa.sibling
Route::resource("/DURC/sibling", 'siblingController');
Route::get("/DURC/json/sibling/{sibling_id}", 'siblingController@jsonone');
Route::get("/DURC/json/sibling/", 'siblingController@jsonall');
Route::get("/DURC/searchjson/sibling/", 'siblingController@search');

 
//DURC->	DURC_aaa.tags_report
Route::resource("/DURC/tags_report", 'tags_reportController');
Route::get("/DURC/json/tags_report/{tags_report_id}", 'tags_reportController@jsonone');
Route::get("/DURC/json/tags_report/", 'tags_reportController@jsonall');
Route::get("/DURC/searchjson/tags_report/", 'tags_reportController@search');

 
//DURC->	DURC_aaa.test_boolean
Route::resource("/DURC/test_boolean", 'test_booleanController');
Route::get("/DURC/json/test_boolean/{test_boolean_id}", 'test_booleanController@jsonone');
Route::get("/DURC/json/test_boolean/", 'test_booleanController@jsonall');
Route::get("/DURC/searchjson/test_boolean/", 'test_booleanController@search');

 
//DURC->	DURC_aaa.test_created_only
Route::resource("/DURC/test_created_only", 'test_created_onlyController');
Route::get("/DURC/json/test_created_only/{test_created_only_id}", 'test_created_onlyController@jsonone');
Route::get("/DURC/json/test_created_only/", 'test_created_onlyController@jsonall');
Route::get("/DURC/searchjson/test_created_only/", 'test_created_onlyController@search');

 
//DURC->	DURC_aaa.test_default_date
Route::resource("/DURC/test_default_date", 'test_default_dateController');
Route::get("/DURC/json/test_default_date/{test_default_date_id}", 'test_default_dateController@jsonone');
Route::get("/DURC/json/test_default_date/", 'test_default_dateController@jsonall');
Route::get("/DURC/searchjson/test_default_date/", 'test_default_dateController@search');

 
//DURC->	DURC_aaa.test_null_default
Route::resource("/DURC/test_null_default", 'test_null_defaultController');
Route::get("/DURC/json/test_null_default/{test_null_default_id}", 'test_null_defaultController@jsonone');
Route::get("/DURC/json/test_null_default/", 'test_null_defaultController@jsonall');
Route::get("/DURC/searchjson/test_null_default/", 'test_null_defaultController@search');

 
//DURC->	DURC_aaa.vote
Route::resource("/DURC/vote", 'voteController');
Route::get("/DURC/json/vote/{vote_id}", 'voteController@jsonone');
Route::get("/DURC/json/vote/", 'voteController@jsonall');
Route::get("/DURC/searchjson/vote/", 'voteController@search');

 
//DURC->	DURC_irs.nonprofitcorp
Route::resource("/DURC/nonprofitcorp", 'nonprofitcorpController');
Route::get("/DURC/json/nonprofitcorp/{nonprofitcorp_id}", 'nonprofitcorpController@jsonone');
Route::get("/DURC/json/nonprofitcorp/", 'nonprofitcorpController@jsonall');
Route::get("/DURC/searchjson/nonprofitcorp/", 'nonprofitcorpController@search');

 
//DURC->	DURC_northwind_data.inventoryTransaction
Route::resource("/DURC/inventorytransaction", 'inventorytransactionController');
Route::get("/DURC/json/inventorytransaction/{inventorytransaction_id}", 'inventorytransactionController@jsonone');
Route::get("/DURC/json/inventorytransaction/", 'inventorytransactionController@jsonall');
Route::get("/DURC/searchjson/inventorytransaction/", 'inventorytransactionController@search');

 
//DURC->	DURC_northwind_data.invoice
Route::resource("/DURC/invoice", 'invoiceController');
Route::get("/DURC/json/invoice/{invoice_id}", 'invoiceController@jsonone');
Route::get("/DURC/json/invoice/", 'invoiceController@jsonall');
Route::get("/DURC/searchjson/invoice/", 'invoiceController@search');

 
//DURC->	DURC_northwind_data.order
Route::resource("/DURC/order", 'orderController');
Route::get("/DURC/json/order/{order_id}", 'orderController@jsonone');
Route::get("/DURC/json/order/", 'orderController@jsonall');
Route::get("/DURC/searchjson/order/", 'orderController@search');

 
//DURC->	DURC_northwind_data.orderDetail
Route::resource("/DURC/orderdetail", 'orderdetailController');
Route::get("/DURC/json/orderdetail/{orderdetail_id}", 'orderdetailController@jsonone');
Route::get("/DURC/json/orderdetail/", 'orderdetailController@jsonall');
Route::get("/DURC/searchjson/orderdetail/", 'orderdetailController@search');

 
//DURC->	DURC_northwind_data.order_2017
Route::resource("/DURC/order_2017", 'order_2017Controller');
Route::get("/DURC/json/order_2017/{order_2017_id}", 'order_2017Controller@jsonone');
Route::get("/DURC/json/order_2017/", 'order_2017Controller@jsonall');
Route::get("/DURC/searchjson/order_2017/", 'order_2017Controller@search');

 
//DURC->	DURC_northwind_data.order_2018
Route::resource("/DURC/order_2018", 'order_2018Controller');
Route::get("/DURC/json/order_2018/{order_2018_id}", 'order_2018Controller@jsonone');
Route::get("/DURC/json/order_2018/", 'order_2018Controller@jsonall');
Route::get("/DURC/searchjson/order_2018/", 'order_2018Controller@search');

 
//DURC->	DURC_northwind_data.order_2019
Route::resource("/DURC/order_2019", 'order_2019Controller');
Route::get("/DURC/json/order_2019/{order_2019_id}", 'order_2019Controller@jsonone');
Route::get("/DURC/json/order_2019/", 'order_2019Controller@jsonall');
Route::get("/DURC/searchjson/order_2019/", 'order_2019Controller@search');

 
//DURC->	DURC_northwind_data.purchaseOrder
Route::resource("/DURC/purchaseorder", 'purchaseorderController');
Route::get("/DURC/json/purchaseorder/{purchaseorder_id}", 'purchaseorderController@jsonone');
Route::get("/DURC/json/purchaseorder/", 'purchaseorderController@jsonall');
Route::get("/DURC/searchjson/purchaseorder/", 'purchaseorderController@search');

 
//DURC->	DURC_northwind_data.purchaseOrderDetail
Route::resource("/DURC/purchaseorderdetail", 'purchaseorderdetailController');
Route::get("/DURC/json/purchaseorderdetail/{purchaseorderdetail_id}", 'purchaseorderdetailController@jsonone');
Route::get("/DURC/json/purchaseorderdetail/", 'purchaseorderdetailController@jsonall');
Route::get("/DURC/searchjson/purchaseorderdetail/", 'purchaseorderdetailController@search');

 
//DURC->	DURC_northwind_model.appstring
Route::resource("/DURC/appstring", 'appstringController');
Route::get("/DURC/json/appstring/{appstring_id}", 'appstringController@jsonone');
Route::get("/DURC/json/appstring/", 'appstringController@jsonall');
Route::get("/DURC/searchjson/appstring/", 'appstringController@search');

 
//DURC->	DURC_northwind_model.customer
Route::resource("/DURC/customer", 'customerController');
Route::get("/DURC/json/customer/{customer_id}", 'customerController@jsonone');
Route::get("/DURC/json/customer/", 'customerController@jsonall');
Route::get("/DURC/searchjson/customer/", 'customerController@search');
Route::get("/DURC/customer/restore/{id}", 'customerController@restore');
 
//DURC->	DURC_northwind_model.employee
Route::resource("/DURC/employee", 'employeeController');
Route::get("/DURC/json/employee/{employee_id}", 'employeeController@jsonone');
Route::get("/DURC/json/employee/", 'employeeController@jsonall');
Route::get("/DURC/searchjson/employee/", 'employeeController@search');

 
//DURC->	DURC_northwind_model.employeePrivilege
Route::resource("/DURC/employeeprivilege", 'employeeprivilegeController');
Route::get("/DURC/json/employeeprivilege/{employeeprivilege_id}", 'employeeprivilegeController@jsonone');
Route::get("/DURC/json/employeeprivilege/", 'employeeprivilegeController@jsonall');
Route::get("/DURC/searchjson/employeeprivilege/", 'employeeprivilegeController@search');

 
//DURC->	DURC_northwind_model.inventoryTransactionType
Route::resource("/DURC/inventorytransactiontype", 'inventorytransactiontypeController');
Route::get("/DURC/json/inventorytransactiontype/{inventorytransactiontype_id}", 'inventorytransactiontypeController@jsonone');
Route::get("/DURC/json/inventorytransactiontype/", 'inventorytransactiontypeController@jsonall');
Route::get("/DURC/searchjson/inventorytransactiontype/", 'inventorytransactiontypeController@search');

 
//DURC->	DURC_northwind_model.orderDetailStat
Route::resource("/DURC/orderdetailstat", 'orderdetailstatController');
Route::get("/DURC/json/orderdetailstat/{orderdetailstat_id}", 'orderdetailstatController@jsonone');
Route::get("/DURC/json/orderdetailstat/", 'orderdetailstatController@jsonall');
Route::get("/DURC/searchjson/orderdetailstat/", 'orderdetailstatController@search');

 
//DURC->	DURC_northwind_model.orderStat
Route::resource("/DURC/orderstat", 'orderstatController');
Route::get("/DURC/json/orderstat/{orderstat_id}", 'orderstatController@jsonone');
Route::get("/DURC/json/orderstat/", 'orderstatController@jsonall');
Route::get("/DURC/searchjson/orderstat/", 'orderstatController@search');

 
//DURC->	DURC_northwind_model.orderTaxStat
Route::resource("/DURC/ordertaxstat", 'ordertaxstatController');
Route::get("/DURC/json/ordertaxstat/{ordertaxstat_id}", 'ordertaxstatController@jsonone');
Route::get("/DURC/json/ordertaxstat/", 'ordertaxstatController@jsonall');
Route::get("/DURC/searchjson/ordertaxstat/", 'ordertaxstatController@search');

 
//DURC->	DURC_northwind_model.privilege
Route::resource("/DURC/privilege", 'privilegeController');
Route::get("/DURC/json/privilege/{privilege_id}", 'privilegeController@jsonone');
Route::get("/DURC/json/privilege/", 'privilegeController@jsonall');
Route::get("/DURC/searchjson/privilege/", 'privilegeController@search');

 
//DURC->	DURC_northwind_model.product
Route::resource("/DURC/product", 'productController');
Route::get("/DURC/json/product/{product_id}", 'productController@jsonone');
Route::get("/DURC/json/product/", 'productController@jsonall');
Route::get("/DURC/searchjson/product/", 'productController@search');

 
//DURC->	DURC_northwind_model.purchaseOrderStat
Route::resource("/DURC/purchaseorderstat", 'purchaseorderstatController');
Route::get("/DURC/json/purchaseorderstat/{purchaseorderstat_id}", 'purchaseorderstatController@jsonone');
Route::get("/DURC/json/purchaseorderstat/", 'purchaseorderstatController@jsonall');
Route::get("/DURC/searchjson/purchaseorderstat/", 'purchaseorderstatController@search');

 
//DURC->	DURC_northwind_model.salesReport
Route::resource("/DURC/salesreport", 'salesreportController');
Route::get("/DURC/json/salesreport/{salesreport_id}", 'salesreportController@jsonone');
Route::get("/DURC/json/salesreport/", 'salesreportController@jsonall');
Route::get("/DURC/searchjson/salesreport/", 'salesreportController@search');

 
//DURC->	DURC_northwind_model.shipper
Route::resource("/DURC/shipper", 'shipperController');
Route::get("/DURC/json/shipper/{shipper_id}", 'shipperController@jsonone');
Route::get("/DURC/json/shipper/", 'shipperController@jsonall');
Route::get("/DURC/searchjson/shipper/", 'shipperController@search');

 
//DURC->	DURC_northwind_model.supplier
Route::resource("/DURC/supplier", 'supplierController');
Route::get("/DURC/json/supplier/{supplier_id}", 'supplierController@jsonone');
Route::get("/DURC/json/supplier/", 'supplierController@jsonall');
Route::get("/DURC/searchjson/supplier/", 'supplierController@search');

 
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

 
//DURC->	lore.mverse
Route::resource("/DURC/mverse", 'mverseController');
Route::get("/DURC/json/mverse/{mverse_id}", 'mverseController@jsonone');
Route::get("/DURC/json/mverse/", 'mverseController@jsonall');
Route::get("/DURC/searchjson/mverse/", 'mverseController@search');

 
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

 
//DURC->	lore.powertoughsource
Route::resource("/DURC/powertoughsource", 'powertoughsourceController');
Route::get("/DURC/json/powertoughsource/{powertoughsource_id}", 'powertoughsourceController@jsonone');
Route::get("/DURC/json/powertoughsource/", 'powertoughsourceController@jsonall');
Route::get("/DURC/searchjson/powertoughsource/", 'powertoughsourceController@search');

 
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

 
//DURC->	lore.theme
Route::resource("/DURC/theme", 'themeController');
Route::get("/DURC/json/theme/{theme_id}", 'themeController@jsonone');
Route::get("/DURC/json/theme/", 'themeController@jsonall');
Route::get("/DURC/searchjson/theme/", 'themeController@search');

 
//DURC->	lore.vspack
Route::resource("/DURC/vspack", 'vspackController');
Route::get("/DURC/json/vspack/{vspack_id}", 'vspackController@jsonone');
Route::get("/DURC/json/vspack/", 'vspackController@jsonall');
Route::get("/DURC/searchjson/vspack/", 'vspackController@search');

 
//DURC->	lore.wallpaper
Route::resource("/DURC/wallpaper", 'wallpaperController');
Route::get("/DURC/json/wallpaper/{wallpaper_id}", 'wallpaperController@jsonone');
Route::get("/DURC/json/wallpaper/", 'wallpaperController@jsonall');
Route::get("/DURC/searchjson/wallpaper/", 'wallpaperController@search');

 
//DURC->	lore.wallpaper_illustration
Route::resource("/DURC/wallpaper_illustration", 'wallpaper_illustrationController');
Route::get("/DURC/json/wallpaper_illustration/{wallpaper_illustration_id}", 'wallpaper_illustrationController@jsonone');
Route::get("/DURC/json/wallpaper_illustration/", 'wallpaper_illustrationController@jsonall');
Route::get("/DURC/searchjson/wallpaper_illustration/", 'wallpaper_illustrationController@search');

 
//DURC->	lore.wallpaper_url
Route::resource("/DURC/wallpaper_url", 'wallpaper_urlController');
Route::get("/DURC/json/wallpaper_url/{wallpaper_url_id}", 'wallpaper_urlController@jsonone');
Route::get("/DURC/json/wallpaper_url/", 'wallpaper_urlController@jsonall');
Route::get("/DURC/searchjson/wallpaper_url/", 'wallpaper_urlController@search');

 
//DURC->	lore_price.cardprice
Route::resource("/DURC/cardprice", 'cardpriceController');
Route::get("/DURC/json/cardprice/{cardprice_id}", 'cardpriceController@jsonone');
Route::get("/DURC/json/cardprice/", 'cardpriceController@jsonall');
Route::get("/DURC/searchjson/cardprice/", 'cardpriceController@search');




