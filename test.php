<?php

require "vendor/autoload.php";

use IconicCodes\LightValidator\LValidator;

$_POST['username'] = 'test';
$_POST['email'] = 'tes';

$_GET['id'] = 10;

$valid_ids = [1,3,4];


$rules = [
    'username' => [
        'required',
        'alphanumeric',
        'min' => 3,
        'max' => 10
    ],

    'email' => [
        'required',
        'email'
    ],

    'id' => [
        'required',
        'numeric',
        'in' => $valid_ids
    ]
];

$overrride_messages = [
    'id' =>  [ 
        'in' => ['ID Must have value betweeen ' . implode(', ', $valid_ids)]
    ],
    'username' => [
        'required' => 'Username is required',
        'string' => 'Username must be string',
        'min' => 'Username must be at least 3 characters',
        'max' => 'Username must be at most 10 characters',
    ],
    'email' => [
        'required' => 'Email is required',
    ],
    'password' => [
        'required' => 'Password is required',
        'min' => 'Password must be at least 6 characters',
        'max' => 'Password must be at most 10 characters',
    ],
];

$v = new LValidator($_GET + $_POST, $rules, $overrride_messages);
$results = $v->validate();

var_dump($results);

