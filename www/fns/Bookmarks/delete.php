<?php

namespace Bookmarks;

function delete ($mysqli, $id) {
    $mysqli->query("delete from bookmarks where id_bookmarks = $id");
}
