<?php

namespace ApiCall;

function requireClientRevision () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($client_revision) = request_strings('client_revision');

    $client_revision = (int)$client_revision;

    include_once "$fnsDir/get_client_revision.php";
    if ($client_revision !== get_client_revision()) {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        \ErrorJson\badRequest('"RELOAD"');
    }

}
