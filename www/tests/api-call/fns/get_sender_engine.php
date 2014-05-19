<?php

function get_sender_engine () {
    $api_key = '85e35f1bba845b05e33ef3ee2f990eed1a43158fa48049e6ffe74234f222731e';
    include_once __DIR__.'/../classes/Engine.php';
    return new Engine($api_key);
}
