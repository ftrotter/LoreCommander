<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostgresTestController extends Controller
{
    public function test()
    {
        try {
            DB::connection('pgsql')->getPdo();
            echo "Connected to the PostgreSQL database successfully!";
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
