<?php

namespace Users\Files;

function indexPreviewableInFolder ($mysqli, $user, $parent_id) {

    if (!$user->num_files) return [];

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Files/Committed/indexPreviewableInUserFolder.php";
    return \Files\Committed\indexPreviewableInUserFolder(
        $mysqli, $user->id_users, $parent_id);

}
