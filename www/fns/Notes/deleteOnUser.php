<?php

namespace Notes;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from notes where idusers = $idusers");
}
