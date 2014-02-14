<?php

namespace BookmarkTags;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from bookmarktags where idusers = $idusers");
}
