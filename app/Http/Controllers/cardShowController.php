<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use TwoMySQLHandler\TwoMySQLHandler;

class cardShowController extends Controller
{

	public $demo_card_list = [
			[	
				'multi_id' => '461089',
				'name' => 'Giant Growth',
			],
			[	
				'multi_id' => '526238',
				'name' => 'Counterspell',
			],
			[	
				'multi_id' => '489616',
				'name'  => 'Serra Angel',
			],
			[	
				'multi_id' => '442071',
				'name' 	=> 'Dark Ritual',
			],
			[	
				'multi_id' => '438694', 
				'name' => 'Fireball',
			],
		];


/*
	Shows the core Card interface, which gives the details of the card as well as card variations..
	Note: FireFox will fail if you have privacy badger running without approving the scryfall api url.
*/
	public function showCard($channel_id){

		$current_url = url()->full();
		$url = url('/');


		return view('show_card',[
				'channel_id'  => $channel_id,
				'base_url' => $url,
				'current_url' => $current_url,
				'demo_card_list' => json_decode(json_encode($this->demo_card_list)),
				]);
		
	}

/*
	Shows just the art!!
	Note: FireFox will fail if you have privacy badger running without approving the scryfall api url.
*/
	public function showArtCard($channel_id){

		$current_url = url()->full();
		$url = url('/');


		return view('show_art_card',[
				'channel_id'  => $channel_id,
				'base_url' => $url,
				'current_url' => $current_url,
				'demo_card_list' => json_decode(json_encode($this->demo_card_list)),
				]);
		
	}

/*
	Literally just shows a big picture of the card. 
	Note: FireFox will fail if you have privacy badger running without approving the scryfall api url.

*/
	public function showJustCard($channel_id){


		$current_url = url()->full();
		$url = url('/');



		return view('show_just_card',[
				'channel_id'  => $channel_id,
				'base_url' => $url,
				'current_url' => $current_url,
				'demo_card_list' => json_decode(json_encode($this->demo_card_list)),
				]);
		
	}
/*

	This is the back end function that interacts with pusher and sends the singal to the various tracking televisions...

*/
	public function sendCardPush($channel_id,$multiverse_id){

	        $app_key = config('broadcasting.connections.pusher.key');
        	$app_secret = config('broadcasting.connections.pusher.secret');
        	$app_id = config('broadcasting.connections.pusher.app_id');
        	$cluster = config('broadcasting.connections.pusher.options.cluster');

		if(is_null($app_key) || $app_key == ''){
			return response()->json([
				'result' => 'error',
				'error_message' => 'Pusher PUSHER_APP_KEY not configured in .env',
			]);
		}

		if(is_null($app_secret) || $app_secret == ''){
			return response()->json([
				'result' => 'error',
				'error_message' => 'Pusher PUSHER_APP_SECRET not configured in .env',
			]);
		}

		if(is_null($app_id) || $app_id == ''){
			return response()->json([
				'result' => 'error',
				'error_message' => 'Pusher PUSHER_APP_ID not configured .env',
			]);
		}
		
		if(is_null($cluster) || $cluster == ''){
			return response()->json([
				'result' => 'error',
				'error_message' => 'Pusher PUSHER_APP_CLUSTER not configured .env',
			]);
		}


        	$pusher = new \Pusher\Pusher($app_key, $app_secret, $app_id,['cluster' => $cluster]);

        	$pusher->trigger( $channel_id, 'show_this_card',  ['multiverse_id' => $multiverse_id] );

/*
		//lets log this  using the generic logger, because we need to learn to use this.. 
		$pdo = \DB::connection()->getPdo();
		$mySQLHandler = new TwoMySQLHandler($pdo, "lore_log", "log_message", "log_context", [], \Monolog\Logger::DEBUG);	
		$logger = new \Monolog\Logger('CardViewer');
		$logger->pushHandler($mySQLHandler);
		$logger->addInfo("Showing Card",['multiverse_id' => $multiverse_id]);
*/		

		//lets also have an entry into 
		$scanhistory = \App\scanhistory::create([
								'viewchannel' => $channel_id,
								'multiverse_id' => $multiverse_id,
						]);

		$scanhistory->save();

//		return("Showing card $multiverse_id");
		return response()->json([
			'result' => 'success',
			'showing_card_id' => $multiverse_id,
			'button_class' => 'btn-success',
			'button_text' => 'Card Data Sent',
		]);

	}



}
