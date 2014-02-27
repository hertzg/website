<?php

namespace Channels;

function delete ($mysqli, $id) {
    $mysqli->query("delete from channels where idchannels = $id");
}
