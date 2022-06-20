<?php

namespace IconicCodes\LightValidator;

class LValidator extends LValidatorBase {

    public function required($key) {
        return isset($this->input[$key]) && $this->input[$key] != '';
    }

    public function min($key, $value) {
        return strlen($this->input[$key]) >= $value;
    }

    public function max($key, $value) {
        return strlen($this->input[$key]) <= $value;
    }

    public function email($key) {
        return filter_var($this->input[$key], FILTER_VALIDATE_EMAIL);
    }

    public function url($key) {
        return filter_var($this->input[$key], FILTER_VALIDATE_URL);
    }

    public function integer($key) {
        return filter_var($this->input[$key], FILTER_VALIDATE_INT);
    }

    public function float($key) {
        return filter_var($this->input[$key], FILTER_VALIDATE_FLOAT);
    }

    public function boolean($key) {
        return filter_var($this->input[$key], FILTER_VALIDATE_BOOLEAN);
    }

    public function alpha($key) {
        return ctype_alpha($this->input[$key]);
    }

    public function alphanumeric($key) {
        return ctype_alnum($this->input[$key]);
    }

    public function numeric($key) {
        return ctype_digit($this->input[$key]);
    }

    public function regex($key, $value) {
        return preg_match($value, $this->input[$key]);
    }

    public function equal($key, $value) {
        return $this->input[$key] == $value;
    }

    public function different($key, $value) {
        return $this->input[$key] != $value;
    }

    public function contains($key, $value) {
        return strpos($this->input[$key], $value) !== false;
    }

    public function starts_with($key, $value) {
        return strpos($this->input[$key], $value) === 0;
    }

    public function ends_with($key, $value) {
        return strpos($this->input[$key], $value) === (strlen($this->input[$key]) - strlen($value));
    }

    public function length($key, $value) {
        return strlen($this->input[$key]) == $value;
    }

    public function min_length($key, $value) {
        return strlen($this->input[$key]) >= $value;
    }

    public function max_length($key, $value) {
        return strlen($this->input[$key]) <= $value;
    }

    public function in($key, $value) {
        return in_array($this->input[$key], $value);
    }

    public function not_in($key, $value) {
        return !in_array($this->input[$key], $value);
    }

    public function ip($key) {
        return filter_var($this->input[$key], FILTER_VALIDATE_IP);
    }

    public function mac_address($key) {
        return filter_var($this->input[$key], FILTER_VALIDATE_MAC);
    }

    public function date_format($key, $value) {
        return date($value, strtotime($this->input[$key])) == $this->input[$key];
    }

    public function boolean_string($key) {
        return in_array($this->input[$key], ['true', 'false']);
    }

    public function is_valid_person_name($key) {
        return preg_match('/^[a-zA-Z ]+$/', $this->input[$key]);
    }

    public function is_valid_person_name_with_space($key) {
        return preg_match('/^[a-zA-Z ]+$/', $this->input[$key]);
    }

    public function date_between($key, $value) {
        $value = explode(',', $value);
        $date = date('Y-m-d', strtotime($this->input[$key]));
        return $date >= $value[0] && $date <= $value[1];
    }
}
