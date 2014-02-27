<?php

namespace Channels;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from channels where idusers = $idusers");
}
