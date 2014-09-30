<?php

function time_today () {
    include_once __DIR__.'/daytime.php';
    return daytime(time());
}
