<?php

function get_client_address () {

//    // uncomment when using the site behind a reverse proxy
//    $addresses = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
//    return array_pop($addresses);

    return $_SERVER['REMOTE_ADDR'];

}
