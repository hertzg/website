<?php

namespace Bookmarks;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from bookmarks where idusers = $idusers");
}
