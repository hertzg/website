<?php

namespace Users\Contacts\Received;

function import ($mysqli, $user, $receivedContact, $insertApiKey = null) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $user, $receivedContact, $insertApiKey);

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedContact);

    $photo_id = $receivedContact->photo_id;
    if ($photo_id) {
        include_once __DIR__.'/../../../ContactPhotos/delete.php';
        \ContactPhotos\delete($mysqli, $photo_id);
    }

    return $id;

}
