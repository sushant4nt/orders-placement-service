<?php

return [

    /*
     * Database Connection Name
     * Specify default database connection
    */

    'default' => env('DATABASE_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
     * Database Connections
     * Specify the database connections setup
    */

    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
	        'host' => env('DATABASE_HOST', '127.0.0.1'),
	        'database' => env('DATABASE_SCHEMA', 'customer_orders'),
	        'username' => env('DATABASE_USERNAME', ''),
	        'password' => env('DATABASE_PASSWORD', ''),
	        'port' => env('DATABASE_PORT', '3306'),
            'sticky' => true,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci', 
            'strict' => false,
            'engine' => null,
        ],
    ],
];
