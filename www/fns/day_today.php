<?php

function day_today () {
    include_once __DIR__.'/time_today.php';
    return time_today() / (60 * 60 * 24);
}
