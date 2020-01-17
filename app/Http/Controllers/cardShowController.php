<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TwoMySQLHandler\TwoMySQLHandler;

class cardShowController extends Controller
{



	public function showCard($channel_id){

		return view('show_card',['channel_id'  => $channel_id]);
		
	}

	public function showJustCard($channel_id){

		return view('show_just_card',['channel_id'  => $channel_id]);
		
	}

	public function sendCardPush($channel_id,$multiverse_id){

	        $app_key = config('broadcasting.connections.pusher.key');
        	$app_secret = config('broadcasting.connections.pusher.secret');
        	$app_id = config('broadcasting.connections.pusher.app_id');
        	$cluster = config('broadcasting.connections.pusher.options.cluster');

        	$pusher = new \Pusher\Pusher($app_key, $app_secret, $app_id,['cluster' => $cluster]);

        	$pusher->trigger( $channel_id, 'show_this_card',  ['multiverse_id' => $multiverse_id] );


		//lets log this  using the generic logger, because we need to learn to use this.. 
		$pdo = \DB::connection()->getPdo();
		$mySQLHandler = new TwoMySQLHandler($pdo, "lore_log", "log_message", "log_context", [], \Monolog\Logger::DEBUG);	
		$logger = new \Monolog\Logger('CardViewer');
		$logger->pushHandler($mySQLHandler);
		$logger->addInfo("Showing Card",['multiverse_id' => $multiverse_id]);
		

		//lets also have an entry into 
		$scanhistory = \App\scanhistory::create([
								'viewchannel' => $channel_id,
								'multiverse_id' => $multiverse_id,
						]);

		$scanhistory->save();

		return("Showing card $multiverse_id");

	}



}
