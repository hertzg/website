<?php

namespace Channels;

function index ($mysqli, $idusers) {

    $sql = "select * from channels where idusers = $idusers";
    include_once __DIR__.'/../mysqli_query_object.php';
    $channels = mysqli_query_object($mysqli, $sql);

    usort($channels, function ($a, $b) {
        return strcasecmp($a->channelname, $b->channelname);
    });

    return $channels;

}
