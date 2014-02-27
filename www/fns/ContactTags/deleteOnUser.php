<?php

namespace ContactTags;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from contacttags where idusers = $idusers");
}
