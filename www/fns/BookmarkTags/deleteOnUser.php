<?php

namespace BookmarkTags;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from bookmark_tags where idusers = $idusers");
}
