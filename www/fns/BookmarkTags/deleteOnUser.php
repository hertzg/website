<?php

namespace BookmarkTags;

function deleteOnUser ($mysqli, $id_users) {
    $mysqli->query("delete from bookmark_tags where id_users = $id_users");
}
