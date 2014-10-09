<?php

function get_client_address () {

//    // uncomment when using the site behind a reverse proxy
//    return array_pop(explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']));

    return $_SERVER['REMOTE_ADDR'];

}
