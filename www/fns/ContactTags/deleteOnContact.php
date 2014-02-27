<?php

namespace ContactTags;

function deleteOnContact ($mysqli, $idcontacts) {
    $mysqli->query("delete from contacttags where idcontacts = $idcontacts");
}
