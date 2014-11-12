<?php

function parse_expire_time (&$expires, &$expire_time) {

    if ($expires === 'never') return;

    $days = abs((int)$expires);
    $expires = (string)$days;
    $expire_time = time() + $days * 24 * 60 * 60;

}
