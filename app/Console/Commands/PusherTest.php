<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PusherTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pusher:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Pusher';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


	$app_key = config('broadcasting.connections.pusher.key');
	$app_secret = config('broadcasting.connections.pusher.secret');
	$app_id = config('broadcasting.connections.pusher.app_id');
	$cluster = config('broadcasting.connections.pusher.options.cluster');

	echo "Creating pusher with \n\tapp_key:$app_key\n\tapp_secret:$app_secret\n\tapp_id:$app_id\n\tapp_cluster:$cluster\n";	

        $pusher = new \Pusher\Pusher($app_key, $app_secret, $app_id,['cluster' => $cluster]);

	$pusher->trigger( 'fucking_finally', 'my_event', 'hello world' );
    }
}
