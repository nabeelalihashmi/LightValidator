<?php
/*

$rules = [
    'username' => [
        'required',
        'alphanumeric',
        'minlen' => 3,
        'maxlen' => 10
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
        'email' => 'Email must be valid',
    ],
    'password' => [
        'required' => 'Password is required',
        'min' => 'Password must be at least 6 characters',
        'max' => 'Password must be at most 10 characters',
    ],
];*/

namespace IconicCodes\LightValidator;

abstract class LValidatorBase {

    protected $input;
    protected $rules;
    protected $override_messages = [];


    function __construct(array $input, array $rules, $override_messages = []) {
        $this->input = $input;
        $this->rules = $rules;
        $this->override_messages = $override_messages;
    }


    function validate() {
        $errors = [];
        foreach ($this->rules as $key => $rules) {
            foreach ($rules as $rule => $value) {
                if (is_string($rule)) {
                    $method = $rule;
                    $params = [$key, $value];
                    $internal_type = 0;
                } else {
                    $method = $value;
                    $params = [$key];
                    $internal_type = 1;
                }
                if (!$this->$method(...$params)) {
                    $errors[$key] = $internal_type == 0 ? $this->getErrorMessage($key, $rule) : $this->getErrorMessage($key, $method);
                    if ($rule == 'required') break;
                }
            }
        }
        return empty($errors) ? true : $errors;
    }

    function getErrorMessage($key, $rule) {
        return (isset($this->override_messages[$key][$rule])) ?
                $this->override_messages[$key][$rule] :
                $this->getDefaultErrorMessage($key, $rule);
    }

    function getDefaultErrorMessage($key, $rule) {
        return $key . ' is failed to validate with rule ' . $rule;
    }
}
