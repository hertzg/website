<?php

namespace Folders;

function rename ($mysqli, $idusers, $idfolders, $foldername) {
    $foldername = mysqli_real_escape_string($mysqli, $foldername);
    mysqli_query(
        $mysqli,
        "update folders set foldername = '$foldername'"
        ." where idusers = $idusers and idfolders = $idfolders"
    );
}
