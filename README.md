![LightValidator](./docs/header.png)

# LightValidator

Fast and easy to use validator for PHP. This is esily extensible.

## Features

    * Fast
    * Easy
    * Lightweight
    * Supports custom messages


## Installtion
```
composer require nabeelalihashmi/LightValidator
```

## Basic Usage

LValidator requirs 3 arguments, the first is array you want to validate, the second is the rules and the third is the overriding messages.

If overriding messages is not provided, the default messages will be used.

`validate` method returns true if validation is successful and array of errors if validation fails.

```

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
```

## Rules

Rules are array. Each rule is an array with key as the field name and value as the rule. The rule can be a string or a key value pair.

```
'username' => [
        'required',
        'alphanumeric',
        'min' => 3,
        'max' => 10
]

```

## Overriding Messages

An overriding message is an array of messages. The key is the rule name and the value is the message.When a rule fails, the message will be used.

## Available validations in package

* required($key) 
* min($key, $value) 
* max($key, $value) 
* email($key) 
* url($key) 
* integer($key) 
* float($key) 
* boolean($key) 
* alpha($key) 
* alphanumeric($key) 
* numeric($key) 
* regex($key, $value) 
* equal($key, $value) 
* different($key, $value) 
* contains($key, $value) 
* starts_with($key, $value) 
* ends_with($key, $value) 
* length($key, $value) 
* min_length($key, $value) 
* max_length($key, $value) 
* in($key, $value) 
* not_in($key, $value) 
* ip($key) 
* mac_address($key) 
* date_format($key, $value) 
* boolean_string($key) 
* is_valid_person_name($key) 
* is_valid_person_name_with_space($key) 
* date_between($key, $value) 

## Extending

You can add your own rules by adding rule handler. A rule handler is a funcion with two arguments, the first is the key and the second is the value. The function should return true if the value is valid and false if the value is invalid. The second argument is the optional.

```
public function islessthan10($key) {
    return intval($key) < 10;
}
```
public function islessthanVal($key, $val) {
    return intval($key) < intval($val);
}

```

------

## License

LightValidator is released under permissive licese with following conditions:

* It cannot be used to create adult apps.
* It cannot be used to gambling apps.
* It cannot be used to create apps having hate speech.

### MIT License

Copyright 2022 Nabeel Ali | IconicCodes.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

