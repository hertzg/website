<?php

namespace Users\Contacts\Received;

function import ($mysqli, $user, $receivedContact) {

    include_once __DIR__.'/importCopy.php';
    $id = importCopy($mysqli, $user, $receivedContact);

    include_once __DIR__.'/delete.php';
    delete($mysqli, $receivedContact);

    return $id;

}
