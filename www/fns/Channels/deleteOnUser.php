<?php

namespace Channels;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from channels where idusers = $idusers");
}
