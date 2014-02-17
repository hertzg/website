<?php

namespace Channels;

function delete ($mysqli, $id) {
    mysqli_query($mysqli, "delete from channels where idchannels = $id");
}
