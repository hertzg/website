<?php

function get_sender_engine () {
    $key = 'b17d0947478e84b97a5f9f7e67b36c1c88238588f82b1c3baf70380d70cada58';
    include_once __DIR__.'/../classes/Engine.php';
    return new Engine($key);
}
