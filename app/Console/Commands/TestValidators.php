<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestValidators extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scry:test_validators';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command should fail because of validators';

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

	$this->info('validation has begun');

        $filtertestObj = new \App\filtertest;

	$filtertestObj->test_url = "not a url";
	$filtertestObj->test_json = "not json";	
	
	$filtertestObj->save();

    }
}
