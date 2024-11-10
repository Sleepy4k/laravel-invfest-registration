<?php

//Default values for the Cacheable trait - Can be overridden per model
return [
    //How long should cache last in general?
    'ttl' => 604800, //7 days
    //By what should cache entries be prefixed?
    'prefix' => 'cacheable',
    //What is the identifying, unique column name?
    'identifier' => 'id',
    //Do you need logging?
    'logging' => [
        'enabled' => config('app.debug'),
        'level' => 'debug',
    ],
];
