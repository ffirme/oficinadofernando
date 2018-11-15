<?php

return [

    /* Options (mysql, sqlite) */
    'driver' => 'sqlite',

    'sqlite' => [
        'database' => 'database.sqlite'
    ],

    'mysql' => [
        'host' => 'localhost',
        'database' => 'mustapower',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci'
    ]
];