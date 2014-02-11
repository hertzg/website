<?php

namespace Bookmarks;

function delete ($mysqli, $id) {
    mysqli_query($mysqli, "delete from bookmarks where idbookmarks = $id");
}
