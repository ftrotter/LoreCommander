<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TwoMySQLHandler\TwoMySQLHandler;

class LoggingTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing the Logging System';

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

//Import class

$pdo = \DB::connection()->getPdo();

$extra_fields = ['username', 'userid'];
$extra_fields = [];

//Create MysqlHandler
$mySQLHandler = new TwoMySQLHandler($pdo,"lore_log", "log_message", "log_context", $extra_fields, \Monolog\Logger::DEBUG);

$channel = 'logger_test';
//Create logger
$logger = new \Monolog\Logger($channel);
$logger->pushHandler($mySQLHandler);

//Now you can use the logger, and further attach additional information
$logger->addWarning("This is a great message, woohoo!", array('username'  => 'John Doe', 'userid'  => 245));

    }
}
