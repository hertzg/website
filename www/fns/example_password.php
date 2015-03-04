<?php

function example_password ($length) {

    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digit = '0123456789';
    $symbol = "!@#$%^&*()_+|[];',./{}:\"<>?";

    $full_charset = str_repeat($lowercase, 3).str_repeat($uppercase, 3)
        .str_repeat($digit, 4).str_repeat($symbol, 2);

    $password = str_shuffle($full_charset);
    $password = substr($password, 0, mt_rand($length - 1, $length + 1));
    return $password;

}
