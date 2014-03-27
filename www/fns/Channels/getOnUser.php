<?php

namespace Channels;

function getOnUser ($mysqli, $idusers, $id) {
    $sql = 'select * from channels'
        ." where idusers = $idusers and idchannels = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
