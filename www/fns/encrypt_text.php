<?php

function encrypt_text ($text) {
    return preg_replace_callback('/(\S)(\S+)(\s|$)/u', function ($match) {
        $asterisks = preg_replace('/./u', '*', $match[2]);
        return "$match[1]$asterisks$match[3]";
    }, $text);
}
