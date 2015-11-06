<?php

function parse_username_address ($raw_username, &$username, &$address) {
    if (preg_match('/^(.+?)@(.+)$/', $raw_username, $match)) {
        $username = $match[1];
        $address = $match[2];
    } else {
        $username = $raw_username;
        $address = null;
    }
}
