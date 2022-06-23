<?php
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
