<?php

namespace ContactTags;

function deleteOnContact ($mysqli, $idcontacts) {
    $mysqli->query("delete from contact_tags where idcontacts = $idcontacts");
}
