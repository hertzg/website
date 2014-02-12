<?php

namespace Bookmarks;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from bookmarks where idusers = $idusers");
}
