<?php

namespace ContactTags;

function deleteOnContact ($mysqli, $idcontacts) {
    mysqli_query(
        $mysqli,
        "delete from contacttags where idcontacts = $idcontacts"
    );
}
