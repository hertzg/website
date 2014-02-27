<?php

namespace BookmarkTags;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from bookmarktags where idusers = $idusers");
}
