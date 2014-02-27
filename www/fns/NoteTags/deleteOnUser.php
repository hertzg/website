<?php

namespace NoteTags;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from notetags where idusers = $idusers");
}
