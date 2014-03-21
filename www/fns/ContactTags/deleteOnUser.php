<?php

namespace ContactTags;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from contact_tags where idusers = $idusers");
}
