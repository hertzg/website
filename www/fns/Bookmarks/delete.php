<?php

namespace Bookmarks;

function delete ($mysqli, $id) {
    $mysqli->query("delete from bookmarks where idbookmarks = $id");
}
