<?php

namespace ContactTags;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query(
        $mysqli,
        "delete from contacttags where idusers = $idusers"
    );
}
