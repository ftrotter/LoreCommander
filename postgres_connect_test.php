<?php

error_reporting(0);

function test_local_connection()
{
    $conn = pg_connect("host=localhost port=5433 dbname=lorecommander user=postgres password=rootsecret");
    if ($conn) {
        echo "Local connection successful!\n";
        pg_close($conn);
    } else {
        echo "Local connection failed.\n";
    }
}

function test_container_connection()
{
    $output = shell_exec('docker exec lorecommander_db_postgres psql -U postgres -d lorecommander -c "SELECT 1" 2>/dev/null');
    if (strpos($output, '1 row') !== false) {
        echo "Container connection successful!\n";
    } else {
        echo "Container connection failed.\n";
    }
}

function test_local_connection_bash()
{
    $password = 'rootsecret';
    $output = shell_exec("PGPASSWORD=$password psql -h localhost -p 5433 -U postgres -d lorecommander -c \"SELECT 1\" -w");
    if (strpos($output, '1 row') !== false) {
        echo "Local connection (bash) successful!\n";
    } else {
        echo "Local connection (bash) failed.\n";
    }
}

function test_container_connection_bash()
{
    $output = shell_exec('docker exec lorecommander_db_postgres psql -U postgres -d lorecommander -c "SELECT 1" 2>/dev/null');
    if (strpos($output, '1 row') !== false) {
        echo "Container connection (bash) successful!\n";
    } else {
        echo "Container connection (bash) failed.\n";
    }
}

function test_local_connection_failure()
{
    echo "\nAttempting connection with wrong password...\n";
    // Use a combination of connection string and environment variables
    // to ensure we are testing the intended configuration.
    $host = getenv('DB_HOST') ?: 'localhost';
    $port = getenv('DB_PORT') ?: '5433';
    $dbname = getenv('DB_DATABASE') ?: 'lorecommander';
    $user = getenv('DB_USERNAME') ?: 'postgres';
    $password = 'wrongpassword'; // Intentionally wrong password

    $conn_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";
    
    $conn = pg_connect($conn_string);
    
    if ($conn) {
        echo "Local connection with wrong password unexpectedly successful!\n";
        pg_close($conn);
    } else {
        echo "Local connection with wrong password failed as expected.\n";
    }
}

test_local_connection();
test_local_connection_bash();
test_container_connection();
test_container_connection_bash();
test_local_connection_failure();
