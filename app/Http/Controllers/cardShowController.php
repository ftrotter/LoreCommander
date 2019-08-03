<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cardShowController extends Controller
{



	public function showCard($channel_id){

		return view('show_card',['channel_id'  => $channel_id]);
		
	}


	public function sendCardPush($channel_id,$multiverse_id){

	        $app_key = config('broadcasting.connections.pusher.key');
        	$app_secret = config('broadcasting.connections.pusher.secret');
        	$app_id = config('broadcasting.connections.pusher.app_id');
        	$cluster = config('broadcasting.connections.pusher.options.cluster');

        	$pusher = new \Pusher\Pusher($app_key, $app_secret, $app_id,['cluster' => $cluster]);

        	$pusher->trigger( $channel_id, 'show_this_card',  ['multiverse_id' => $multiverse_id] );

		return("Showing card $scryfall_id");

	}



}
