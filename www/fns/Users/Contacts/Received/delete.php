<?php

namespace Users\Contacts\Received;

function delete ($mysqli, $receivedContact) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedContact);

    include_once __DIR__.'/../../DeletedItems/addReceivedContact.php';
    \Users\DeletedItems\addReceivedContact($mysqli, $receivedContact);

}
