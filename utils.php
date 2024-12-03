<?php

if (!function_exists('verify_empty')) {
    function verify_empty($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('verify_inputs')) {
    function verify_inputs($data)
    {
        if (verify_empty($data)) {
            setcookie('message', 'Please fill in all fields', time() + 5);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}