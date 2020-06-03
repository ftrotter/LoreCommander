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

        $filtertestObjGood = new \App\filtertest;

	$filtertestObjGood->is_boolean = True;
	$filtertestObjGood->dec_value = 100.0;
	$filtertestObjGood->float_value = 200.0;
	$filtertestObjGood->tiny_integer = 10;
	$filtertestObjGood->small_integer = 10090;
	$filtertestObjGood->integer_field = 1099999000;
	$filtertestObjGood->test_uri = "not a url";
	$filtertestObjGood->test_url = "http://www.google.com";
	$filtertestObjGood->test_uuid = "123e4567-e89b-12d3-a456-426614174000";
	$filtertestObjGood->test_alpha = "motherhorseeyes";
	$filtertestObjGood->test_alpha_dash = "mother-9-horse-9-eyes";
	$filtertestObjGood->test_alpha_num = "mother9horse9eyes";
	$filtertestObjGood->test_email = "complaints@careset.com";
	$filtertestObjGood->test_ipv4 = "127.0.0.1";
	$filtertestObjGood->test_ipv6 = "2001:0db8:85a3:0000:0000:8a2e:0370:7334";
	$filtertestObjGood->test_json = "{\"is_json\":\"yes\"}";
	$filtertestObjGood->test_timezone = "CST";
	
	$filtertestObjGood->save();

        $filtertestObjBad = new \App\filtertest;

	$filtertestObjBad->is_boolean = "NOPE";
	$filtertestObjBad->dec_value = "A hundred";
	$filtertestObjBad->float_value = "Two hundred";
	$filtertestObjBad->tiny_integer = 10099990;
	$filtertestObjBad->small_integer = 100099999990;
	$filtertestObjBad->integer_field = 1000000009999990000;
	$filtertestObjBad->test_uri = "not a url";
	$filtertestObjBad->test_url = "not a url either";
	$filtertestObjBad->test_uuid = "not valid uuid";
	$filtertestObjBad->test_alpha = "mother9horse9eyes";
	$filtertestObjBad->test_alpha_dash = "invalid with 349258";
	$filtertestObjBad->test_alpha_num = "numbers letters and @#$%^&*";
	$filtertestObjBad->test_email = "not an email";
	$filtertestObjBad->test_ipv4 = "not an ip";
	$filtertestObjBad->test_ipv6 = "not an ip";
	$filtertestObjBad->test_json = "not json";
	$filtertestObjBad->test_timezone = "not a timezone";
	
	$filtertestObjBad->save();

    }
}
